<?php

namespace application\web\www\modules\user\controllers\order;

use application\models\base\OrderList;
use application\web\www\components\WwwBaseAction;

class UpResultAction extends WwwBaseAction
{
    /**
     * 获取订单
     * @param string $uuid
     * @return string
     */
    public function run($uuid = '')
    {
        $orderList = OrderList::getLastMonthOrder($this->account['uid']);

        return $this->render(compact('orderData', 'detailData', 'orderList'));
    }
}
