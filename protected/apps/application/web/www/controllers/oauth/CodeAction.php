<?php
/**
 * @category CodeAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 20/11/2017 19:29
 * @since
 */

namespace application\web\www\controllers\oauth;

use application\models\base\Users;
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

        // dd([$member, User::isVip($openId)]);

        if($member && Users::isVip($openId)){
            \Yii::$app->user->login($member);
            GSession::set('is_user_clickout', 0);
            GSession::set('login_failed', 0);
            return $this->controller->redirect(['/site/index']);
        }
        GSession::set('login_failed', 1);
        return $this->controller->redirect(['site/login']);
    }
}
