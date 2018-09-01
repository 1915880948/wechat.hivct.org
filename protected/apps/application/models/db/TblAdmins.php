<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%admins}}".
 *
 * @property integer $aid
 * @property string $account
 * @property string $password
 * @property string $nickname
 * @property integer $login_time
 * @property string $login_ip
 * @property integer $is_super
 * @property integer $logistic_id
 * @property integer $is_admin
 */
class TblAdmins extends \application\common\db\ApplicationActiveRecord
{
     const AID = 'aid';
     const ACCOUNT = 'account';
     const PASSWORD = 'password';
     const NICKNAME = 'nickname';
     const LOGIN_TIME = 'login_time';
     const LOGIN_IP = 'login_ip';
     const IS_SUPER = 'is_super';
     const LOGISTIC_ID = 'logistic_id';
     const IS_ADMIN = 'is_admin';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admins}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login_time', 'is_super', 'logistic_id', 'is_admin'], 'integer'],
            [['logistic_id'], 'required'],
            [['account', 'nickname'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 255],
            [['login_ip'], 'string', 'max' => 50],
            [['account'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aid' => 'Aid',
            'account' => '账号',
            'password' => '密码',
            'nickname' => '昵称',
            'login_time' => '最后登录时间',
            'login_ip' => '最后登录IP',
            'is_super' => 'Is Super',
            'logistic_id' => '发货地管理员',
            'is_admin' => '是否admin ：1:是。0:不是（默认）',
        ];
    }
}
