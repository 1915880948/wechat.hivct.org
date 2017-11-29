<?php

namespace application\models\base;

use application\models\db\TblOrderDetail;

/**
 * This is the model class for tableClass "TblOrderDetail".
 * className OrderDetail
 * @package application\models\base
 */
class OrderDetail extends TblOrderDetail
{
    /**
     * @param $detail
     * @return OrderDetail
     */
    public static function create($detail)
    {
        $model = new self();
        $model->order_uuid = $detail['order_uuid'];
        $model->goods_uuid = $detail['goods_uuid'];
        $model->goods_title = $detail['goods_title'];
        $model->goods_price = $detail['goods_price'];
        $model->order_time = $detail['order_time'];
        $model->save();
        return $model;
    }

    public function updateShipInfo($shipType, $shipCode, $shipTime)
    {
        $this->ship_type = $shipType;
        $this->ship_code = $shipCode;
        $this->ship_time = $shipTime;
        $this->save();
    }
}
