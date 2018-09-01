<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property integer $uid
 * @property string $uuid
 * @property string $realname
 * @property string $mobile
 * @property string $city
 * @property string $city_code
 * @property string $avatar
 * @property string $website
 */
class TblUserProfile extends \application\common\db\ApplicationActiveRecord
{
     const UID = 'uid';
     const UUID = 'uuid';
     const REALNAME = 'realname';
     const MOBILE = 'mobile';
     const CITY = 'city';
     const CITY_CODE = 'city_code';
     const AVATAR = 'avatar';
     const WEBSITE = 'website';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'uuid'], 'required'],
            [['uid'], 'integer'],
            [['uuid'], 'string', 'max' => 36],
            [['realname'], 'string', 'max' => 50],
            [['mobile', 'city'], 'string', 'max' => 20],
            [['city_code'], 'string', 'max' => 6],
            [['avatar', 'website'], 'string', 'max' => 100],
            [['uuid'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'uuid' => 'Uuid',
            'realname' => 'Realname',
            'mobile' => 'Mobile',
            'city' => 'City',
            'city_code' => 'City Code',
            'avatar' => 'Avatar',
            'website' => 'Website',
        ];
    }
}
