<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%user_event}}".
 *
 * @property integer $id
 * @property string $uuid
 * @property integer $uid
 * @property string $event_type
 * @property string $event_type_uuid
 * @property integer $event_type_step_total
 * @property integer $event_type_step_current
 * @property string $event_memo
 * @property string $order_temporary
 * @property string $order_uuid
 * @property integer $order_is_paid
 * @property integer $order_is_shipped
 * @property string $user_address_uuid
 * @property string $created_at
 * @property string $updated_at
 */
class TblUserEvent extends \application\common\db\ApplicationActiveRecord
{
     const ID = 'id';
     const UUID = 'uuid';
     const UID = 'uid';
     const EVENT_TYPE = 'event_type';
     const EVENT_TYPE_UUID = 'event_type_uuid';
     const EVENT_TYPE_STEP_TOTAL = 'event_type_step_total';
     const EVENT_TYPE_STEP_CURRENT = 'event_type_step_current';
     const EVENT_MEMO = 'event_memo';
     const ORDER_TEMPORARY = 'order_temporary';
     const ORDER_UUID = 'order_uuid';
     const ORDER_IS_PAID = 'order_is_paid';
     const ORDER_IS_SHIPPED = 'order_is_shipped';
     const USER_ADDRESS_UUID = 'user_address_uuid';
     const CREATED_AT = 'created_at';
     const UPDATED_AT = 'updated_at';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_event}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'event_type_step_total', 'event_type_step_current', 'order_is_paid', 'order_is_shipped'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['uuid', 'event_type_uuid', 'order_uuid', 'user_address_uuid'], 'string', 'max' => 36],
            [['event_type'], 'string', 'max' => 20],
            [['event_memo'], 'string', 'max' => 100],
            [['order_temporary'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'Uuid',
            'uid' => 'Uid',
            'event_type' => '参与的活动类型：如survey/xxxx',
            'event_type_uuid' => 'Event Type Uuid',
            'event_type_step_total' => '参与活动的步骤',
            'event_type_step_current' => '当前步骤，用于确认是否已完成',
            'event_memo' => '备注，这个同时会写到订单的备住里',
            'order_temporary' => '订单暂存。如果最后选择支付了。就处理掉。否则就存在这里。供后续查看用户的选择',
            'order_uuid' => '参与活动时是否购物。购物的UUID',
            'order_is_paid' => '是否支付',
            'order_is_shipped' => 'Order Is Shipped',
            'user_address_uuid' => 'User Address Uuid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
