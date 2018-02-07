<?php
/**
 * @category PayCallbackAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 30/11/2017 11:38
 * @since
 */

namespace application\web\www\controllers\oauth;

use application\models\base\OrderList;
use application\models\base\OrderPayLog;
use application\web\www\components\WwwBaseAction;
use common\core\base\Schema;
use qiqi\helper\log\FileLogHelper;
use yii\helpers\Json;

class PayCallbackAction extends WwwBaseAction
{
    public $method = 'post';
    public $responseType = 'json';

    public function run()
    {
        FileLogHelper::xlog($this->request->post(),'oauth/payment');
        $outTradeNo = $this->request->post('out_trade_no');
        $payStatus = $this->request->post('pay_status');
        $payinfo = Json::decode($this->request->post('pay_info','[]'));

        $orderList = OrderList::findByOurtradeNo($outTradeNo);
        if(!$orderList){
            return Schema::FailureNotify('订单不存在');
        }
        $status = OrderList::getValidStatus($payStatus);
        $orderList->updatePayStatus(OrderList::PAY_STATUS_SUCCESS);
        $orderList->updateOrderStatus($status);
        $orderList->updateOrderInfo($payinfo);
        if(OrderList::ORDER_STATUS_PAID == $status){

            OrderPayLog::log($payinfo);

            return Schema::SuccessNotify('更新订单成功');
        }
        return Schema::FailureNotify('更新失败');
    }
}
