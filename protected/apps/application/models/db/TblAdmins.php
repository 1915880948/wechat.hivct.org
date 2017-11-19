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
 */
class TblAdmins extends \application\common\db\ApplicationActiveRecord
{
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
            [['login_time', 'is_super'], 'integer'],
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
        ];
    }
}
