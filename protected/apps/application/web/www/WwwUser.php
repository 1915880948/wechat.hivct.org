<?php
/**
 * @category WwwUser
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/15 12:39
 * @since
 */

namespace application\web\www;

use application\models\base\Users;
use Overtrue\Socialite\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\IdentityInterface;

/**
 * Class WwwUser
 * @package application\web\www
 * @property mixed $authKey
 * @property mixed $id
 */
class WwwUser extends Users implements IdentityInterface
{
    public static function findIdentity($id)
    {
        return static::find()
                     ->andWhere(['uid' => $id])
                     ->one();
    }

    /**
     * @param mixed $token
     * @param null  $type
     * @return WwwUser|array|null|\yii\db\ActiveRecord
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()
                     ->andWhere(['openid' => $token])
                     ->one();
    }

    public function getId()
    {
        return $this->uid;
    }

    public function getAuthKey()
    {
        return $this->openid;
    }

    public function validateAuthKey($authKey)
    {
        return $this->openid == $authKey;
    }

}
