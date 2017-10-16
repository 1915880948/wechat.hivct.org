<?php

namespace application\models\base;

use application\models\db\TblUsers;
use EasyWeChat\Foundation\Application;
use qiqi\helper\log\FileLogHelper;
use wechat\Weixin;
use yii\helpers\Json;

/**
 * This is the model class for tableClass "TblUsers".
 * className Users
 * @package application\models\base
 */
class Users extends TblUsers
{
    public function getTags()
    {
        if(!$this->tags || ((time() - strtotime($this->updated_at)) > env('WECHAT_USER_TAGS_UPDATE_TIME'))){
            FileLogHelper::xlog('dolog');
            $this->updateTags();
        }
        if(!$this->tags){
            $this->tags = '[]';
        }
        return Json::decode($this->tags);
    }

    /**
     * @param Application|null $app
     * @return mixed
     */
    public function updateTags(Application $app = null)
    {
        if(!$app){
            $app = Weixin::getApp();
        }
        if(!$this->is_subscribe){//重走订阅
            FileLogHelper::xlog(['re do', $this->attributes], 'subscribe');
            $sub = $this->checkSubscribe();
            if(!$sub){
                $this->tags = '[]';
                return;
            }
        }

        try{
            $this->tags = Json::encode($app->user_tag->userTags($this->openid));
            $this->save();
        } catch(\Exception $e){
            $this->tags = '[]';
        }
        return;
    }

    protected function checkSubscribe()
    {
        $app = Weixin::getApp();
        if(time() - $this->subscribe_time > 43200){
            FileLogHelper::xlog('getuser');
            $user = $app->user->get($this->openid);
            FileLogHelper::xlog($user);
            $this->is_subscribe = $user->get('subscribe');
            $this->subscribe_time = $user->get('subscribe_time');
        }
        return $this->is_subscribe;
    }
}
