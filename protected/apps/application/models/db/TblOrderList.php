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
 * @property string $pay_time
 * @property string $order_updated_at
 * @property string $ship_name
 * @property string $ship_code
 * @property string $ship_uuid
 * @property integer $ship_status
 * @property string $created_at
 * @property string $updated_at
 * @property string $source_type
 * @property string $source_uuid
 * @property integer $logistic_id
 * @property string $address_uuid
 * @property string $address_contact
 * @property string $address_mobile
 * @property string $address_detail
 * @property string $alipay
 * @property integer $is_up_result
 * @property integer $adis_result
 * @property integer $adis_is_confirm
 * @property string $adis_confirm_time
 * @property integer $adis_is_cure
 * @property string $adis_cure_time
 * @property integer $syphilis_result
 * @property integer $syphilis_is_confirm
 * @property string $syphilis_confirm_time
 * @property integer $syphilis_is_cure
 * @property string $syphilis_cure_time
 * @property integer $hepatitis_b_result
 * @property integer $hepatitis_b_is_confirm
 * @property string $hepatitis_b_confirm_time
 * @property integer $hepatitis_b_is_cure
 * @property string $hepatitis_b_cure_time
 * @property integer $hepatitis_c_result
 * @property integer $hepatitis_c_is_confirm
 * @property string $hepatitis_c_confirm_time
 * @property integer $hepatitis_c_is_cure
 * @property string $hepatitis_c_cure_time
 * @property string $check_doctor
 * @property string $check_desc
 * @property string $check_time
 * @property integer $is_to_examine
 * @property string $to_examine_admin
 * @property string $examine_reason
 */
class TblOrderList extends \application\common\db\ApplicationActiveRecord
{
     const ID = 'id';
     const UUID = 'uuid';
     const OUT_TRADE_NO = 'out_trade_no';
     const UID = 'uid';
     const INFO = 'info';
     const DESCRIPTION = 'description';
     const MEMO = 'memo';
     const TOTAL_PRICE = 'total_price';
     const WX_TRANSACTION_ID = 'wx_transaction_id';
     const PAY_STATUS = 'pay_status';
     const ORDER_STATUS = 'order_status';
     const PAY_TIME = 'pay_time';
     const ORDER_UPDATED_AT = 'order_updated_at';
     const SHIP_NAME = 'ship_name';
     const SHIP_CODE = 'ship_code';
     const SHIP_UUID = 'ship_uuid';
     const SHIP_STATUS = 'ship_status';
     const CREATED_AT = 'created_at';
     const UPDATED_AT = 'updated_at';
     const SOURCE_TYPE = 'source_type';
     const SOURCE_UUID = 'source_uuid';
     const LOGISTIC_ID = 'logistic_id';
     const ADDRESS_UUID = 'address_uuid';
     const ADDRESS_CONTACT = 'address_contact';
     const ADDRESS_MOBILE = 'address_mobile';
     const ADDRESS_DETAIL = 'address_detail';
     const ALIPAY = 'alipay';
     const IS_UP_RESULT = 'is_up_result';
     const ADIS_RESULT = 'adis_result';
     const ADIS_IS_CONFIRM = 'adis_is_confirm';
     const ADIS_CONFIRM_TIME = 'adis_confirm_time';
     const ADIS_IS_CURE = 'adis_is_cure';
     const ADIS_CURE_TIME = 'adis_cure_time';
     const SYPHILIS_RESULT = 'syphilis_result';
     const SYPHILIS_IS_CONFIRM = 'syphilis_is_confirm';
     const SYPHILIS_CONFIRM_TIME = 'syphilis_confirm_time';
     const SYPHILIS_IS_CURE = 'syphilis_is_cure';
     const SYPHILIS_CURE_TIME = 'syphilis_cure_time';
     const HEPATITIS_B_RESULT = 'hepatitis_b_result';
     const HEPATITIS_B_IS_CONFIRM = 'hepatitis_b_is_confirm';
     const HEPATITIS_B_CONFIRM_TIME = 'hepatitis_b_confirm_time';
     const HEPATITIS_B_IS_CURE = 'hepatitis_b_is_cure';
     const HEPATITIS_B_CURE_TIME = 'hepatitis_b_cure_time';
     const HEPATITIS_C_RESULT = 'hepatitis_c_result';
     const HEPATITIS_C_IS_CONFIRM = 'hepatitis_c_is_confirm';
     const HEPATITIS_C_CONFIRM_TIME = 'hepatitis_c_confirm_time';
     const HEPATITIS_C_IS_CURE = 'hepatitis_c_is_cure';
     const HEPATITIS_C_CURE_TIME = 'hepatitis_c_cure_time';
     const CHECK_DOCTOR = 'check_doctor';
     const CHECK_DESC = 'check_desc';
     const CHECK_TIME = 'check_time';
     const IS_TO_EXAMINE = 'is_to_examine';
     const TO_EXAMINE_ADMIN = 'to_examine_admin';
     const EXAMINE_REASON = 'examine_reason';
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
            [['uid', 'pay_status', 'order_status', 'ship_status', 'logistic_id', 'is_up_result', 'adis_result', 'adis_is_confirm', 'adis_is_cure', 'syphilis_result', 'syphilis_is_confirm', 'syphilis_is_cure', 'hepatitis_b_result', 'hepatitis_b_is_confirm', 'hepatitis_b_is_cure', 'hepatitis_c_result', 'hepatitis_c_is_confirm', 'hepatitis_c_is_cure', 'is_to_examine'], 'integer'],
            [['total_price'], 'number'],
            [['order_updated_at', 'created_at', 'updated_at', 'adis_confirm_time', 'adis_cure_time', 'syphilis_confirm_time', 'syphilis_cure_time', 'hepatitis_b_confirm_time', 'hepatitis_b_cure_time', 'hepatitis_c_confirm_time', 'hepatitis_c_cure_time', 'check_time'], 'safe'],
            [['uuid', 'out_trade_no', 'wx_transaction_id', 'ship_uuid', 'source_uuid', 'address_uuid'], 'string', 'max' => 36],
            [['info', 'address_contact', 'alipay'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 250],
            [['memo', 'examine_reason'], 'string', 'max' => 100],
            [['pay_time'], 'string', 'max' => 14],
            [['ship_name', 'address_mobile'], 'string', 'max' => 20],
            [['ship_code', 'check_doctor', 'to_examine_admin'], 'string', 'max' => 30],
            [['source_type'], 'string', 'max' => 10],
            [['address_detail'], 'string', 'max' => 200],
            [['check_desc'], 'string', 'max' => 255],
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
            'order_status' => '订单状态：0未处理，1处理中，2已支付，21已发货，22已收货，23用户不存在，29发货完成，11申请退款，12退款审核，13退款成功，14退款失败，18退款处理中，19退款完成，99订单完成，100未知状态',
            'pay_time' => '支付时间',
            'order_updated_at' => '订单更新时间',
            'ship_name' => '快递名称',
            'ship_code' => '快递单号',
            'ship_uuid' => '快递公司UUID',
            'ship_status' => '配送状态: 1:已发货',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'source_type' => '来源',
            'source_uuid' => '来源ID',
            'logistic_id' => '发货地ID',
            'address_uuid' => 'Address Uuid',
            'address_contact' => 'Address Contact',
            'address_mobile' => 'Address Mobile',
            'address_detail' => 'Address Detail',
            'alipay' => '支付宝 和pay_images的支付宝一致',
            'is_up_result' => '是否上传自检结果：1:是，0:否',
            'adis_result' => '艾滋病检测结果:0:未检测，1阴性，2：阳性，3：检测失败',
            'adis_is_confirm' => '是否确证：1:是。0:否',
            'adis_confirm_time' => 'Adis Confirm Time',
            'adis_is_cure' => '是否治疗：1：是，0：否',
            'adis_cure_time' => 'Adis Cure Time',
            'syphilis_result' => '梅毒检测结果: 0:未检测，1阴性，2：阳性，3：检测失败',
            'syphilis_is_confirm' => '是否确证：1:是。0:否',
            'syphilis_confirm_time' => 'Syphilis Confirm Time',
            'syphilis_is_cure' => '是否治疗：1：是，0：否',
            'syphilis_cure_time' => 'Syphilis Cure Time',
            'hepatitis_b_result' => '乙肝检测结果: 0:未检测，1阴性，2：阳性，3：检测失败',
            'hepatitis_b_is_confirm' => '是否确证：1:是。0:否',
            'hepatitis_b_confirm_time' => 'Hepatitis B Confirm Time',
            'hepatitis_b_is_cure' => '是否治疗：1：是，0：否',
            'hepatitis_b_cure_time' => 'Hepatitis B Cure Time',
            'hepatitis_c_result' => '丙肝检测结果: 0:未检测，1阴性，2：阳性，3：检测失败',
            'hepatitis_c_is_confirm' => '是否确证：1:是。0:否',
            'hepatitis_c_confirm_time' => 'Hepatitis C Confirm Time',
            'hepatitis_c_is_cure' => '是否治疗：1：是，0：否',
            'hepatitis_c_cure_time' => 'Hepatitis C Cure Time',
            'check_doctor' => '检测医师',
            'check_desc' => '检测描述',
            'check_time' => '检测时间',
            'is_to_examine' => '审核状态：0：未审核 1：通过，2：未通过',
            'to_examine_admin' => '审核人',
            'examine_reason' => '审核未通过原因',
        ];
    }
}
