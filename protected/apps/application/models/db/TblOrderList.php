<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%order_list}}".
 *
 * @property integer $id
 * @property string $uuid
 * @property string $out_trade_no
 * @property integer $uid
 * @property string $info
 * @property string $description
 * @property string $memo
 * @property string $total_price
 * @property string $wx_transaction_id
 * @property integer $pay_status
 * @property integer $order_status
 * @property string $order_updated_at
 * @property string $ship_name
 * @property string $ship_code
 * @property string $ship_uuid
 * @property integer $ship_status
 * @property string $created_at
 * @property string $updated_at
 * @property string $source_type
 * @property string $source_uuid
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
            [['out_trade_no'], 'required'],
            [['uid', 'pay_status', 'order_status', 'ship_status'], 'integer'],
            [['total_price'], 'number'],
            [['order_updated_at', 'created_at', 'updated_at'], 'safe'],
            [['uuid', 'out_trade_no', 'wx_transaction_id', 'ship_uuid', 'source_uuid'], 'string', 'max' => 36],
            [['info'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 250],
            [['memo'], 'string', 'max' => 100],
            [['ship_name'], 'string', 'max' => 20],
            [['ship_code'], 'string', 'max' => 30],
            [['source_type'], 'string', 'max' => 10],
            [['out_trade_no'], 'unique'],
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
            'uuid' => 'Uuid',
            'out_trade_no' => '内部流水号',
            'uid' => 'Uid',
            'info' => '订单标题',
            'description' => '订单说明',
            'memo' => '订单备注',
            'total_price' => 'Total Price',
            'wx_transaction_id' => '微信订单号',
            'pay_status' => '支付状态，0待支付，1已支付，-1支付失败',
            'order_status' => '订单状态：0未处理，1处理中，2已支付，3已发货，4已收货，11申请退款，12退款中，13退款完成，99已完成',
            'order_updated_at' => '订单更新时间',
            'ship_name' => 'Ship Name',
            'ship_code' => '快递单号',
            'ship_uuid' => '快递公司UUID',
            'ship_status' => '配送状态',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'source_type' => 'Source Type',
            'source_uuid' => 'Source Uuid',
        ];
    }
}
