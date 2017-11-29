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
    /**
     * @param $datas
     */
    public static function create($datas)
    {
        $model = new self;
        $model->uid = $datas['uid'];
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

    public function updateWechatPaymentInfo($transactionId, $status)
    {
        $this->wx_transaction_id = $transactionId;
        $this->pay_status = $status;
        $this->save();
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
}
