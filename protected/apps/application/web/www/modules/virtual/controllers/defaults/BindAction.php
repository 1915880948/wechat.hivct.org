<?php
/**
 * @category BindAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/9/3 23:36
 * @since
 */

namespace application\web\www\modules\virtual\controllers\defaults;

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
            $member = WwwUser::findByPk($uid);
        }
        if($member){
            \Yii::$app->getUser()
                      ->login($member);
            echo "Success", yLink('go', ['/site/index']);
            exit;
        }
        echo "Access Denied";
    }
}
