<?php
/**
 * @category PayCallbackAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 30/11/2017 11:38
 * @since
 */

namespace application\web\www\controllers\oauth;

use application\models\base\OrderList;
use application\web\www\components\WwwBaseAction;
use common\core\base\Schema;
use qiqi\helper\log\FileLogHelper;

class PayCallbackAction extends WwwBaseAction
{
    public $method = 'post';
    public $responseType = 'json';

    public function run()
    {
        FileLogHelper::xlog($this->request->post(),'oauth/payment');
        $outTradeNo = $this->request->post('out_trade_no');
        $payStatus = $this->request->post('pay_status');

        $orderList = OrderList::findByOurtradeNo($outTradeNo);
        if(!$orderList){
            return Schema::FailureNotify('订单不存在');
        }
        $status = OrderList::getValidStatus($payStatus);
        $orderList->updateOrderStatus($status);
        if(OrderList::ORDER_STATUS_PAID == $status){
            return Schema::SuccessNotify('更新订单成功');
        }
        return Schema::FailureNotify('更新失败');
    }
}
