<?php
/**
 * @category CodeAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 20/11/2017 19:29
 * @since
 */

namespace application\web\www\controllers\oauth;

use application\web\www\WwwUser;
use qiqi\helper\log\FileLogHelper;
use wechat\Weixin;
use yii\base\Action;

class CodeAction extends Action
{
    public function run()
    {
        $app = Weixin::getApp();
        $oauth = $app->oauth;
        try{
            /** @var \Overtrue\Socialite\User $user */
            $user = $oauth->user();
        } catch(\Exception $e){
            FileLogHelper::xlog($e->getMessage(), 'oauth');
            return $this->controller->redirect(['site/login']);
        } finally{
            FileLogHelper::xlog($oauth, 'oauth');
        }
        $openId = $user->getOriginal()['openid'];
        FileLogHelper::xlog(['openid' => $openId], 'oauth');
        $member = WwwUser::findIdentityByAccessToken($openId);
        FileLogHelper::xlog(['member' => $member], 'oauth');
        // $userDetail = $app->user->get($user->getId());
        $userDetail = [];
        if(!$member){
            /**
             * 这时候拿不到用户信息
             */
            $member = WwwUser::createByWechat($user, $userDetail);
            if($errors = $member->getErrors()){
                FileLogHelper::xlog($errors, 'oauth-login');
                return $this->controller->redirect(['site/login']);
            }
            FileLogHelper::xlog('创建用户没有出错', 'oauth');
        }
        FileLogHelper::xlog(var_export(($member instanceof WwwUser), true), 'oauth');
        // else{
        //     if((time() - strtotime($member->updated_at)) > env('WECHAT_USER_TAGS_UPDATE_TIME')){//如果超过一天就更新吧
        //         $member->updateByWechat($user, $member);
        //     }
        // }

        $loginStatus = \Yii::$app->getUser()
                                 ->login($member, 86400);
        if($loginStatus){
            FileLogHelper::xlog('登录成功', 'oauth');
            FileLogHelper::xlog([
                'login' => \Yii::$app->getUser()
                                     ->getIdentity()
            ], 'oauth');
            //明明登录成功了。为什么还要死循环？
            return $this->controller->redirect(['/site/index']);
        }
        FileLogHelper::xlog(['loginstatus' => $loginStatus], 'oauth-login');
        exit("yyyy");
        return $this->controller->redirect(['/site/login']);
    }
}
