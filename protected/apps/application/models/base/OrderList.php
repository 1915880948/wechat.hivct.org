<?php

namespace application\models\base;

use application\models\db\TblOrderList;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for tableClass "TblOrderList".
 * className OrderList
 * @package application\models\base
 */
class OrderList extends TblOrderList
{
    const PAY_STATUS_FAILED = -1;
    const PAY_STATUS_DEFAULT = 0;
    const PAY_STATUS_SUCCESS = 1;
    const ORDER_STATUS_WAIT_FOR_PAY = 0;
    const ORDER_STATUS_CANCEL = 1; //该字段可能无效，可以用来审核。目前无效
    const ORDER_STATUS_PAID = 2;
    const ORDER_STATUS_SHIP = 21;
    const ORDER_STATUS_SHIP_USER_RECEIVED = 22;
    const ORDER_STATUS_SHIP_USER_NOT_EXISTS = 23;
    const ORDER_STATUS_SHIP_FINISHED = 29;
    const ORDER_STATUS_APPLY_FOR_REFUND = 11;
    const ORDER_STATUS_REFUND_REVIEW = 12;
    const ORDER_STATUS_REFUND_REVIEW_SUCCESS = 13;
    const ORDER_STATUS_REFUND_REVIEW_FAILED = 14;
    const ORDER_STATUS_REFUND_PROCESS = 18;
    const ORDER_STATUS_REFUND_FINISHED = 19;
    const ORDER_STATUS_FINISHED = 99;
    /** 未知状态 */
    const UNKNOWN_STATUS = 100;
    /**
     * @var array 支付状态
     */
    public static $payStatus = [
        self::PAY_STATUS_FAILED,
        self::PAY_STATUS_DEFAULT,
        self::PAY_STATUS_SUCCESS,
    ];
    public static $orderStatus = [
        self::ORDER_STATUS_WAIT_FOR_PAY,
        self::ORDER_STATUS_CANCEL,
        self::ORDER_STATUS_PAID,
        self::ORDER_STATUS_FINISHED,
    ];
    /**
     * 派送状态
     * @var array
     */
    public static $shipStatus = [
        self::ORDER_STATUS_SHIP,
        self::ORDER_STATUS_SHIP_USER_RECEIVED,
        self::ORDER_STATUS_SHIP_USER_NOT_EXISTS,
        self::ORDER_STATUS_SHIP_FINISHED,
    ];
    /**
     * @var array 退款状态
     */
    public static $refundStatus = [
        self::ORDER_STATUS_APPLY_FOR_REFUND,
        self::ORDER_STATUS_REFUND_REVIEW,
        self::ORDER_STATUS_REFUND_REVIEW_SUCCESS,
        self::ORDER_STATUS_REFUND_REVIEW_FAILED,
        self::ORDER_STATUS_REFUND_PROCESS,
        self::ORDER_STATUS_REFUND_FINISHED
    ];

    /**
     * @param $datas
     */
    public static function create($datas)
    {
        $model = new self;
        $model->uid = $datas['uid'];
        $model->out_trade_no = $datas['out_trade_no'];
        $model->info = $datas['body'];
        $model->description = $datas['detail'];
        $model->memo = '';
        $model->total_price = $datas['total_fee'];
        $model->wx_transaction_id = '';
        $model->source_type = $datas['source_type'];
        $model->source_uuid = $datas['source_uuid'];
        $model->save();
        return $model;
    }

    public static function createOrderDetail($orderUuid, $goodsLists)
    {
        if(!is_array($goodsLists)){
            return false;
        }

        $results = [];
        foreach($goodsLists as $goodsList){
            $detail = [
                'order_uuid'  => $orderUuid,
                'goods_uuid'  => $goodsList['uuid'],
                'goods_title' => $goodsList['name'],
                'goods_price' => $goodsList['price'],
                'order_time'  => date("Y-m-d H:i:s")
            ];
            $res = OrderDetail::create($detail);
            if($res->hasErrors()){
                $results = ArrayHelper::merge($results, $res->getErrors());
            }
        }
        return $results;
    }

    /**
     * @param $sourceType
     * @param $sourceUuid
     * @return OrderList|array|null|\yii\db\ActiveRecord
     */
    public static function findBySource($sourceType, $sourceUuid)
    {
        return self::find()
                   ->andWhere(['source_type' => $sourceType])
                   ->andWhere(['source_uuid' => $sourceUuid])
                   ->one();
    }

    /**
     * @param $outTradeNo
     * @return OrderList|array|null|\yii\db\ActiveRecord
     */
    public static function findByOurtradeNo($outTradeNo)
    {
        return self::find()
                   ->andWhere(['out_trade_no' => $outTradeNo])
                   ->one();
    }

    public static function getValidStatus($status)
    {
        if(in_array($status, self::$orderStatus)){
            return $status;
        }
        return self::UNKNOWN_STATUS;
    }

    /**
     * @param     $userId
     * @param int $payStatus
     * @param int $isUpResult
     * @return OrderList[]|array|\yii\db\ActiveRecord[]
     */
    public static function getLastMonthOrder($userId, $payStatus = 1, $isUpResult = 0)
    {
        return OrderList::find()
                        ->andWhere(['uid' => $userId, 'pay_status' => $payStatus, 'is_up_result' => $isUpResult])
                        ->andWhere(['>', 'created_at', date("Y-m-d H:i:s", time() - 86400 * 30)])
                        ->asArray()
                        ->all();
    }

    public function updatePayStatus($status)
    {
        $this->pay_status = $status;
        $this->save();
    }

    /**
     * @param $transactionId
     * @param $status
     */
    public function updateWechatPaymentInfo($transactionId, $status)
    {
        $this->wx_transaction_id = $transactionId;
        $this->pay_status = $status;
        $this->save();
    }

    public function updatePayZeroStatus()
    {
        $this->updatePayStatus(OrderList::PAY_STATUS_SUCCESS);
        $this->updateOrderStatus(OrderList::ORDER_STATUS_PAID);
    }

    public function updateOrderStatus($orderStatus)
    {
        $this->order_status = $orderStatus;
        $this->save();
    }

    public function updateShipInfo($shipinfo)
    {
        $this->ship_name = $shipinfo['name'];
        $this->ship_code = $shipinfo['code'];
        $this->ship_uuid = $shipinfo['uuid'];
        $this->save();
    }

    public function updateShipStatus($status)
    {
        $this->ship_status = $status;
        $this->save();
    }

    /**
     * 更新发货地
     * @param $logiticsId
     */
    public function updateLogitics($logiticsId)
    {
        $this->logistic_id = $logiticsId;
        $this->save();
    }

    /**
     * 更新地址信息
     * @param UserAddress $addressInfo
     */
    public function updateAddressInfo(UserAddress $addressInfo)
    {
        $this->address_uuid = $addressInfo->uuid;
        $this->address_contact = $addressInfo->realname;
        $this->address_mobile = $addressInfo->mobile;
        $this->address_detail = $addressInfo->address;
        $this->save();
    }
}
