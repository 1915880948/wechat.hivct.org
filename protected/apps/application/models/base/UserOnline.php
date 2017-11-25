<?php

namespace application\models\base;

use application\models\db\TblUserOnline;

/**
 * This is the model class for tableClass "TblUserOnline".
 * className UserOnline
 * @package application\models\base
 */
class UserOnline extends TblUserOnline
{
    /**
     * 更新状态
     * @param User $account
     */
    public static function updateStatus(User $account)
    {
        $info = self::find()
                    ->andWhere(['openid' => $account->openid])
                    ->one();
        if(!$info){
            $info = new self;
            $info->openid = $account->openid;
        }
        $info->token = md5($account->openid . $_SERVER['REQUEST_TIME']);
        $info->verify_code = '';
        $info->verify_time = $_SERVER['REQUEST_TIME'];
        $info->save();
    }
}
