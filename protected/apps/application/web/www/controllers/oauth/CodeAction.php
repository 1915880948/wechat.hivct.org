<?php
/**
 * @category CodeAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 20/11/2017 19:29
 * @since
 */

namespace application\web\www\controllers\oauth;

use application\web\www\components\WwwBaseAction;
use application\web\www\WwwUser;
use common\core\session\GSession;
use qiqi\helper\log\FileLogHelper;
use wechat\Weixin;

class CodeAction extends WwwBaseAction
{
    public function run($code)
    {
        $app = Weixin::getApp();
        try{
            /** @var \Overtrue\Socialite\User $user */
            $user = $app->oauth->user();
        } catch(\Exception $e){
            FileLogHelper::xlog($e->getMessage(), 'oauth');
            GSession::set('login_failed', 1);
            return $this->controller->redirect(['site/login']);
        }
        $openId = $user->getOriginal()['openid'];
        $member = WwwUser::findIdentityByAccessToken($openId);
        $useDtail = $app->user->get($user->getId());
        if(!$member){
            /**
             * 这时候拿不到用户信息
             */
            $member = WwwUser::createByWechat($user, $useDtail);
            if($errors = $member->getErrors()){
                print_r($errors);
                return;
            }
        } else{
            if((time() - strtotime($member->updated_at)) > env('WECHAT_USER_TAGS_UPDATE_TIME')){//如果超过一天就更新吧
                $member->updateByWechat($user, $member);
            }
        }
        $loginStatus = \Yii::$app->getUser()
                                 ->login($member, 86400);
        if($loginStatus){
            return $this->controller->redirect(['/site/index']);
        }
        return $this->controller->redirect(['/site/login']);
    }
}