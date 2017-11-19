<?php
/**
 * @category AdminUser
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/3 00:29
 * @since
 */

namespace application\web\admin;

use application\models\base\Admins;
use application\models\base\manage\Manager;
use qiqi\helper\ip\IpHelper;
use yii\base\Security;
use yii\web\IdentityInterface;

include __DIR__ . "/functions.php";

/**
 * Class AdminUser
 * @package application\web\admin
 * @property mixed $authKey
 * @property mixed $id
 * @property null  $regip
 */
class AdminUser extends Admins implements IdentityInterface
{
    /**
     * @param $name
     * @return AdminUser|array|null|\yii\db\ActiveRecord
     */
    public static function findByUserName($name)
    {
        return static::find()
                     ->andWhere(['account' => $name])
                     ->one();
    }

    public function getId()
    {
        return $this->aid;
    }

    public static function findIdentity($id)
    {
        return static::findByPk($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findByUsername($token);
    }

    public function getAuthKey()
    {
        return $this->id;
    }

    public function validateAuthKey($authKey)
    {
        return $this->id == $authKey;
    }

    public function validatePasswordHash($plainPassword, $password = null)
    {
        if($password == null){
            $password = $this->password;
        }
        return \Yii::$app->getSecurity()->validatePassword($plainPassword,$password);
        // return $this->encodePassword($plainPassword) == $password;
    }

    public function validatePassword($plainPassword, $password = null)
    {
        if($password == null){
            $password = $this->password;
        }
        return $plainPassword == $password;
    }

    public function encodePassword($plainPassword)
    {
        //return md5($plainPassword);
    }

    public function getRegip()
    {
        if(!$this->login_ip){
            $this->login_ip = IpHelper::getRealIP();
        }
        return $this->login_ip;
    }

    public function setRegip($regip = null)
    {
        $this->login_ip = $regip;
    }
}
