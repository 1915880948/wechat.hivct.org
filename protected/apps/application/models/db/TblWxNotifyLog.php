<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%wx_notify_log}}".
 *
 * @property integer $id
 * @property string $data
 * @property integer $add_time
 */
class TblWxNotifyLog extends \application\common\db\ApplicationActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_notify_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['add_time'], 'integer'],
            [['data'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => '异步通知数据',
            'add_time' => '通知时间',
        ];
    }
}
