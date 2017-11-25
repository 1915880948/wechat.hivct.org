<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%order_pay_log}}".
 *
 * @property integer $id
 * @property string $device_info
 * @property integer $trade_type
 * @property string $bank_type
 * @property string $out_trade_no
 * @property string $transaction_id
 * @property string $out_refund_no
 * @property string $refund_id
 * @property string $result_code
 * @property string $err_code
 * @property string $err_code_des
 * @property string $total_fee
 * @property string $cash_fee
 * @property string $refund_fee
 * @property string $time_end
 * @property string $client_ip
 * @property integer $add_time
 */
class TblOrderPayLog extends \application\common\db\ApplicationActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_pay_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['trade_type', 'add_time'], 'integer'],
            [['out_trade_no', 'transaction_id'], 'required'],
            [['total_fee', 'cash_fee', 'refund_fee'], 'number'],
            [['device_info', 'bank_type', 'err_code', 'err_code_des'], 'string', 'max' => 255],
            [['out_trade_no', 'transaction_id', 'out_refund_no', 'refund_id', 'result_code'], 'string', 'max' => 32],
            [['time_end', 'client_ip'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'device_info' => 'Device Info',
            'trade_type' => '交易类型，1=付款，2=退款',
            'bank_type' => '付款银行',
            'out_trade_no' => '商户内部订单号 [FK: orders.out_trade_no]',
            'transaction_id' => '微信支付订单号',
            'out_refund_no' => '商户内部退款单号',
            'refund_id' => '微信退款单号',
            'result_code' => '处理结果',
            'err_code' => 'Err Code',
            'err_code_des' => 'Err Code Des',
            'total_fee' => '订单金额',
            'cash_fee' => '现金支付金额',
            'refund_fee' => '申请退款金额',
            'time_end' => '完成时间',
            'client_ip' => '操作终端IP',
            'add_time' => '添加时间',
        ];
    }
}
