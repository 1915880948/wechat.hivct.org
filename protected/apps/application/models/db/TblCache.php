<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%cache}}".
 *
 * @property string $key
 * @property string $value
 * @property integer $expire_time
 */
class TblCache extends \application\common\db\ApplicationActiveRecord
{
     const KEY = 'key';
     const VALUE = 'value';
     const EXPIRE_TIME = 'expire_time';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cache}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['value'], 'string'],
            [['expire_time'], 'integer'],
            [['key'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => '键',
            'value' => '值',
            'expire_time' => 'Expire Time',
        ];
    }
}
