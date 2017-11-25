<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%order_list}}".
 *
 * @property integer $id
 * @property string $uuid
 * @property integer $uid
 * @property string $info
 * @property string $description
 * @property string $memo
 * @property integer $total_price
 * @property string $wx_transaction_id
 * @property integer $pay_status
 * @property integer $order_status
 * @property integer $ship_status
 * @property string $ship_code
 * @property string $ship_uuid
 * @property string $created_at
 * @property string $updated_at
 */
class TblOrderList extends \application\common\db\ApplicationActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_list}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'total_price', 'pay_status', 'order_status', 'ship_status'], 'integer'],
            [['wx_transaction_id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['uuid', 'wx_transaction_id', 'ship_uuid'], 'string', 'max' => 36],
            [['info'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 250],
            [['memo'], 'string', 'max' => 100],
            [['ship_code'], 'string', 'max' => 30]
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
            'info' => '订单标题',
            'description' => '订单说明',
            'memo' => '订单备注',
            'total_price' => 'Total Price',
            'wx_transaction_id' => '微信订单号',
            'pay_status' => '支付状态，0待支付，1已支付，-1支付失败',
            'order_status' => '订单状态：0未处理，1处理中，2已发货，3已收货，11申请退款，12退款中，13退款完成，99已结束',
            'ship_status' => '配送状态',
            'ship_code' => '快递单号',
            'ship_uuid' => '快递公司UUID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
