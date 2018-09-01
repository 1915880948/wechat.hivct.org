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
 * @property string $created_at
 * @property string $updated_at
 */
class TblOrderPayLog extends \application\common\db\ApplicationActiveRecord
{
     const ID = 'id';
     const DEVICE_INFO = 'device_info';
     const TRADE_TYPE = 'trade_type';
     const BANK_TYPE = 'bank_type';
     const OUT_TRADE_NO = 'out_trade_no';
     const TRANSACTION_ID = 'transaction_id';
     const OUT_REFUND_NO = 'out_refund_no';
     const REFUND_ID = 'refund_id';
     const RESULT_CODE = 'result_code';
     const ERR_CODE = 'err_code';
     const ERR_CODE_DES = 'err_code_des';
     const TOTAL_FEE = 'total_fee';
     const CASH_FEE = 'cash_fee';
     const REFUND_FEE = 'refund_fee';
     const TIME_END = 'time_end';
     const CLIENT_IP = 'client_ip';
     const CREATED_AT = 'created_at';
     const UPDATED_AT = 'updated_at';
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
            [['trade_type'], 'integer'],
            [['out_trade_no', 'transaction_id'], 'required'],
            [['total_fee', 'cash_fee', 'refund_fee'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['device_info'], 'string', 'max' => 255],
            [['bank_type'], 'string', 'max' => 10],
            [['out_trade_no', 'transaction_id', 'out_refund_no', 'refund_id', 'result_code'], 'string', 'max' => 32],
            [['err_code', 'err_code_des'], 'string', 'max' => 50],
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
            'created_at' => '添加时间',
            'updated_at' => 'Updated At',
        ];
    }
}
