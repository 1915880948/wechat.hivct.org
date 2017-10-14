<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%answers}}".
 *
 * @property integer $id
 * @property string $order_no
 * @property string $refund_no
 * @property string $data
 * @property string $form_name
 * @property string $fee
 * @property string $postage
 * @property string $other_fee
 * @property integer $status
 * @property string $express
 * @property string $express_no
 * @property string $reject_apply_cause
 * @property string $feedback_fail_cause
 * @property integer $add_time
 * @property integer $upd_time
 * @property integer $uid
 * @property string $prepay_id
 */
class TblAnswers extends \application\common\db\ApplicationActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%answers}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data', 'upd_time'], 'required'],
            [['data'], 'string'],
            [['fee', 'postage', 'other_fee'], 'number'],
            [['status', 'add_time', 'upd_time', 'uid'], 'integer'],
            [['order_no', 'refund_no'], 'string', 'max' => 32],
            [['form_name', 'express', 'reject_apply_cause', 'feedback_fail_cause'], 'string', 'max' => 255],
            [['express_no'], 'string', 'max' => 200],
            [['prepay_id'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_no' => '订单号',
            'refund_no' => '退款单号',
            'data' => '表单 JSON数据',
            'form_name' => '表单名称',
            'fee' => '押金',
            'postage' => '邮费',
            'other_fee' => '其他费用',
            'status' => '订单状态， 0=删除/订单失效，5=未付款，7=付款失败，10=待审核，15=申请审核失败，20=通过申请，25=已反馈待审核，30=反馈审核失败，35=退款中，40=退款失败，45=转入代发，50=未确定，需要商户原退款单号重新发起，60=退款成功，100=已完成',
            'express' => '快递公司',
            'express_no' => '快递单号',
            'reject_apply_cause' => '拒绝申请原因',
            'feedback_fail_cause' => '反馈审核失败原因',
            'add_time' => 'Add Time',
            'upd_time' => 'Upd Time',
            'uid' => '对应用户ID',
            'prepay_id' => '微信预支付ID',
        ];
    }
}
