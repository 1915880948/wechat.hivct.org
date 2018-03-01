<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%order_op_log}}".
 *
 * @property integer $id
 * @property string $order_uuid
 * @property integer $user_id
 * @property integer $status_origin
 * @property integer $status_new
 * @property string $created_at
 */
class TblOrderOpLog extends \application\common\db\ApplicationActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_op_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status_origin', 'status_new'], 'integer'],
            [['created_at'], 'safe'],
            [['order_uuid'], 'string', 'max' => 36]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_uuid' => 'Order Uuid',
            'user_id' => 'User ID',
            'status_origin' => 'Status Origin',
            'status_new' => 'Status New',
            'created_at' => 'Created At',
        ];
    }
}
