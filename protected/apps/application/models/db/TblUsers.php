<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property integer $uid
 * @property string $openid
 * @property string $nickname
 * @property string $realname
 * @property integer $gender
 * @property string $birthdate
 * @property string $nation
 * @property string $province
 * @property string $city
 * @property string $country
 * @property string $headimgurl
 * @property integer $age
 * @property string $email
 * @property string $qq
 * @property string $telephone
 * @property integer $add_time
 * @property integer $upd_time
 */
class TblUsers extends \application\common\db\ApplicationActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gender', 'age', 'add_time', 'upd_time'], 'integer'],
            [['openid', 'nickname', 'realname', 'headimgurl', 'email'], 'string', 'max' => 255],
            [['birthdate', 'nation'], 'string', 'max' => 50],
            [['province', 'city', 'country'], 'string', 'max' => 200],
            [['qq'], 'string', 'max' => 11],
            [['telephone'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'openid' => '微信openid',
            'nickname' => '微信昵称',
            'realname' => '真实姓名',
            'gender' => '1：男，2：女',
            'birthdate' => 'Birthdate',
            'nation' => '民族',
            'province' => '用户在微信个人资料填写的省份',
            'city' => '普通用户在微信个人资料填写的城市',
            'country' => '用户在微信个人资料填写的国家，如中国为CN',
            'headimgurl' => '用户微信头像',
            'age' => '年龄',
            'email' => '邮箱',
            'qq' => 'QQ',
            'telephone' => '手机号码',
            'add_time' => '添加时间',
            'upd_time' => '最后更新时间',
        ];
    }
}
