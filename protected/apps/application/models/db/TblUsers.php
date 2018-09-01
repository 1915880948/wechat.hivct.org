<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property integer $uid
 * @property string $openid
 * @property string $unionid
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
 * @property string $address
 * @property integer $is_updated
 * @property integer $is_subscribe
 * @property integer $subscribe_time
 * @property string $tags
 * @property string $created_at
 * @property string $updated_at
 */
class TblUsers extends \application\common\db\ApplicationActiveRecord
{
     const UID = 'uid';
     const OPENID = 'openid';
     const UNIONID = 'unionid';
     const NICKNAME = 'nickname';
     const REALNAME = 'realname';
     const GENDER = 'gender';
     const BIRTHDATE = 'birthdate';
     const NATION = 'nation';
     const PROVINCE = 'province';
     const CITY = 'city';
     const COUNTRY = 'country';
     const HEADIMGURL = 'headimgurl';
     const AGE = 'age';
     const EMAIL = 'email';
     const QQ = 'qq';
     const TELEPHONE = 'telephone';
     const ADDRESS = 'address';
     const IS_UPDATED = 'is_updated';
     const IS_SUBSCRIBE = 'is_subscribe';
     const SUBSCRIBE_TIME = 'subscribe_time';
     const TAGS = 'tags';
     const CREATED_AT = 'created_at';
     const UPDATED_AT = 'updated_at';
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
            [['gender', 'age', 'is_updated', 'is_subscribe', 'subscribe_time'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['openid', 'unionid', 'birthdate', 'nation'], 'string', 'max' => 50],
            [['nickname', 'realname', 'headimgurl', 'email', 'tags'], 'string', 'max' => 255],
            [['province', 'city', 'country'], 'string', 'max' => 200],
            [['qq'], 'string', 'max' => 11],
            [['telephone'], 'string', 'max' => 15],
            [['address'], 'string', 'max' => 100]
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
            'unionid' => 'Unionid',
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
            'address' => 'Address',
            'is_updated' => 'Is Updated',
            'is_subscribe' => 'Is Subscribe',
            'subscribe_time' => 'Subscribe Time',
            'tags' => 'Tags',
            'created_at' => '添加时间',
            'updated_at' => '最后更新时间',
        ];
    }
}
