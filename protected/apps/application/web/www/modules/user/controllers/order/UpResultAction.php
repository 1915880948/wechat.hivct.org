<?php

namespace application\web\www\modules\user\controllers\order;

use application\models\base\OrderDetail;
use application\models\base\OrderList;
use application\web\www\components\WwwBaseAction;

class UpResultAction extends WwwBaseAction
{
    public function run($uuid = '')
    {
        $orderData = OrderList::find()
            ->andWhere(['uuid' => $uuid])
            ->asArray()
            ->one();
        $detailData = OrderDetail::find()
            ->andWhere(['order_uuid' => $uuid])
            ->asArray()
            ->all();
        $orderList = OrderList::getLastMonthOrder($this->account['uid']);
//        dd($orderList);
        return $this->render(compact('orderData', 'detailData', 'orderList'));
    }
}
