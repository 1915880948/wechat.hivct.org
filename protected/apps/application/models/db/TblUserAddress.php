<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%user_address}}".
 *
 * @property integer $id
 * @property string $uuid
 * @property integer $uid
 * @property string $realname
 * @property string $mobile
 * @property string $city
 * @property string $city_code
 * @property string $address
 * @property string $created_at
 * @property integer $is_default
 */
class TblUserAddress extends \application\common\db\ApplicationActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_address}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['uid', 'is_default'], 'integer'],
            [['created_at'], 'safe'],
            [['uuid'], 'string', 'max' => 36],
            [['realname', 'city'], 'string', 'max' => 50],
            [['mobile'], 'string', 'max' => 20],
            [['city_code'], 'string', 'max' => 6],
            [['address'], 'string', 'max' => 255],
            [['uuid'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => '唯一ID',
            'uid' => 'Uid',
            'realname' => 'Realname',
            'mobile' => 'Mobile',
            'city' => 'City',
            'city_code' => 'City Code',
            'address' => 'Address',
            'created_at' => 'Created At',
            'is_default' => 'Is Default',
        ];
    }
}
