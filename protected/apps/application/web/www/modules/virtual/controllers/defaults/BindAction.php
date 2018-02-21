<?php
/**
 * @category BindAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/9/3 23:36
 * @since
 */

namespace application\web\admin\modules\virtual\controllers\defaults;

use application\models\base\User;
use application\web\admin\components\AdminBaseAction;
use application\web\www\WwwUser;

class BindAction extends AdminBaseAction
{
    public function run($openid = '', $uid = null)
    {
        if(!$openid && $uid === null){
            return "Access Denied";
        }
        $member = null;
        if($openid){
            $member = WwwUser::findIdentityByAccessToken($openid);
        }
        if(intval($uid) >= 0){
            $uinfo = User::find()
                         ->andWhere(['user_id' => $uid])
                         ->one();
            if($uinfo){
                $member = WwwUser::findIdentityByAccessToken($uinfo['wxid']);
            }
        }
        if($member){
            \Yii::$app->getUser()
                      ->login($member);
            echo "Success", yLink('go', ['/site/index']);
        }
    }
}
