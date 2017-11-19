<?php

namespace application\models\base;

use application\models\db\TblUsers;
use EasyWeChat\Foundation\Application;
use Overtrue\Socialite\User;
use qiqi\helper\log\FileLogHelper;
use wechat\Weixin;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * This is the model class for tableClass "TblUsers".
 * className Users
 * @package application\models\base
 */
class Users extends TblUsers
{
    /**
     * @param User $weUser
     * @return Users
     */
    public static function createByWechat(User $weUser, $userDetail = null)
    {
        $model = new static;
        $original = $weUser->getOriginal();
        $weAttr = $weUser->getAttributes();
        $model->openid = $weUser->getId();
        $model->unionid = ArrayHelper::getValue($original, 'unionid', $weUser->getId());
        $model->headimgurl = $weUser->getAvatar();
        $model->gender = ArrayHelper::getValue($original, 'sex', '');
        $model->nickname = $weUser->getNickname();
        $model->realname = $weUser->getName();
        $model->country = ArrayHelper::getValue($weAttr, 'country', '');
        $model->province = ArrayHelper::getValue($weAttr, 'province', '');
        $model->city = ArrayHelper::getValue($weAttr, 'city', '');
        $model->is_subscribe = $userDetail->subscribe ?? 0; //-1表示没有获取过用户信息
        $model->tags = Json::encode($userDetail->tagid_list ?? []);
        $model->save();
        return $model;
    }

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

    public function updateByWechat(User $user, Users $wUser)
    {
        $original = $user->getOriginal();
        $weAttr = $user->getAttributes();
        $wUser->headimgurl = $user->getAvatar();
        $wUser->gender = ArrayHelper::getValue($original, 'sex', '');
        $wUser->nickname = $user->getNickname();
        $wUser->realname = $user->getName();
        $wUser->country = ArrayHelper::getValue($weAttr, 'country', '');
        $wUser->province = ArrayHelper::getValue($weAttr, 'province', '');
        $wUser->city = ArrayHelper::getValue($weAttr, 'city', '');
        $wUser->is_subscribe = $userDetail->subscribe ?? 0; //-1表示没有获取过用户信息
        $wUser->save();
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
