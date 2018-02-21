<?php

namespace application\web\www\modules\user\controllers\order;

use application\models\base\OrderList;
use application\web\www\components\WwwBaseAction;
use common\core\session\GSession;

class UpResultAction extends WwwBaseAction
{
    public function run($uuid = '')
    {
        if(GSession::get('debug') == true){
            echo "<pre>";
            print_r($this->account);
            echo "</pre>";
        }
        $orderList = OrderList::getLastMonthOrder($this->account['uid']);

        return $this->render(compact('orderData', 'detailData', 'orderList'));
    }
}
