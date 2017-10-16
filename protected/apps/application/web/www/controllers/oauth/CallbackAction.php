<?php
/**
 * @category CallbackAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/6/10 09:07
 * @since
 */

namespace application\web\www\controllers\oauth;

use application\models\base\UserOnline;
use application\web\www\components\WwwBaseAction;
use application\web\www\WwwUser;
use Overtrue\Socialite\User;
use qiqi\helper\log\FileLogHelper;
use wechat\Weixin;
use yii\helpers\ArrayHelper;

/**
 * Class CallbackAction
 * @package application\web\www\controllers\site
 */
class CallbackAction extends WwwBaseAction
{
    /**
     * @param        $code
     * @param string $state
     */
    public function run($code, $state = '')
    {
        $app = Weixin::getApp();
        try{
            /** @var User $user */
            $user = $app->oauth->user();
        } catch(\Exception $e){
            FileLogHelper::xlog($e->getMessage(), 'oauth');
            echo $e->getMessage();
            return;
        }

        $openId = $user->getId();
        $wUser = WwwUser::findIdentityByAccessToken($openId);
        $useDtail = $app->user->get($user->getId());
        if(!$wUser){
            /**
             * 这时候拿不到用户信息
             */
            $wUser = WwwUser::createByWechat($user, $useDtail);
            if($errors = $wUser->getErrors()){
                print_r($errors);
                return;
            }
        } else{
            if((time() - strtotime($wUser->updated_at)) > env('WECHAT_USER_TAGS_UPDATE_TIME')){//如果超过一天就更新吧
                $original = $user->getOriginal();
                $weAttr = $user->getAttributes();
                $wUser->avatar = $user->getAvatar();
                $wUser->gender = ArrayHelper::getValue($original, 'sex', '');
                $wUser->nickname = $user->getNickname();
                $wUser->name = $user->getName();
                $wUser->country = ArrayHelper::getValue($weAttr, 'country', '');
                $wUser->province = ArrayHelper::getValue($weAttr, 'province', '');
                $wUser->city = ArrayHelper::getValue($weAttr, 'city', '');
                $wUser->is_subscribe = $userDetail->subscribe ?? 0; //-1表示没有获取过用户信息
                $wUser->save();
            }
        }
        $loginStatus = \Yii::$app->getUser()
                                 ->login($wUser, 86400);
        if($loginStatus){
            //set online data
            UserOnline::updateStatus($wUser);
            $wUser->updateTags($app);
            return $this->controller->redirect(\Yii::$app->getUser()
                                                         ->getReturnUrl());
        }
        return "Login failed";
    }
}
