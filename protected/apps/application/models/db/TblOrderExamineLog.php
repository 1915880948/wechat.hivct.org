<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%order_examine_log}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $order_examine
 * @property string $order_examine_user
 * @property string $created_at
 */
class TblOrderExamineLog extends \application\common\db\ApplicationActiveRecord
{
     const ID = 'id';
     const ORDER_ID = 'order_id';
     const ORDER_EXAMINE = 'order_examine';
     const ORDER_EXAMINE_USER = 'order_examine_user';
     const CREATED_AT = 'created_at';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_examine_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'order_examine', 'order_examine_user'], 'required'],
            [['order_id', 'order_examine'], 'integer'],
            [['created_at'], 'safe'],
            [['order_examine_user'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'order_examine' => 'Order Examine',
            'order_examine_user' => 'Order Examine User',
            'created_at' => 'Created At',
        ];
    }
}
