<?php
/**
 * @category PayCallbackAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 30/11/2017 11:38
 * @since
 */

namespace application\web\www\controllers\oauth;

use application\models\base\Logistics;
use application\models\base\OrderList;
use application\models\base\OrderPayLog;
use application\web\www\components\WwwBaseAction;
use common\core\base\Schema;
use qiqi\helper\log\FileLogHelper;
use wechat\TplMessage;
use yii\helpers\Json;

class PayCallbackAction extends WwwBaseAction
{
    public $method = 'post';
    public $responseType = 'json';

    public function run()
    {
        FileLogHelper::xlog(['post' => $this->request->post()], 'oauth/payment');
        $outTradeNo = $this->request->post('out_trade_no');
        $payStatus = $this->request->post('pay_status');
        $payinfo = Json::decode($this->request->post('pay_info', '[]'));
        $orderList = OrderList::findByOurtradeNo($outTradeNo);
        if(!$orderList){
            return Schema::FailureNotify('订单不存在');
        }
        $logisticInfo = Logistics::findByPk($orderList['logistic_id']);
        $status = OrderList::getValidStatus($payStatus);
        $orderList->updatePayStatus(OrderList::PAY_STATUS_SUCCESS);
        $orderList->updateOrderStatus($status);
        $orderList->updateOrderInfo($payinfo);
        try{
            $openId = Logistics::getLogisticsOpenId($orderList['logistic_id']);
            $tmplInfo = [
                'title'         => '有订单支付',
                'title_unknown' => '有订单支付（没有该发货地对应的微信ID））',
                'fee'           => round($payinfo['total_fee'] / 100, 2) . "元",
                'trade_no'      => substr($payinfo['out_trade_no'], 3),
                'logistic'      => $logisticInfo['title'] ?? "未知发货点",
                'simple'        => sprintf("%s先生,%s****%s,%s****（更多信息请到后台查看）", mb_substr($orderList['address_contact'], 0, 1, 'UTF-8'), substr($orderList['address_mobile'], 0, 3), substr($orderList['address_mobile'], 8, 4), mb_substr($orderList['description'], 0, 5)),
                'detail'        => "{$orderList['address_contact']},{$orderList['address_mobile']},{$orderList['description']}"
            ];

            $tplmessage = TplMessage::getInstance();

            $tplmessage->paid($openId, $tmplInfo['title'], $tmplInfo['fee'], $tmplInfo['trade_no'], $tmplInfo['logistic'], $tmplInfo['simple']);
            if($openId == 'oVP2NjryYmAJ7_K6auO5gFdpVr6Q'){
                $tplmessage->paid('oVP2NjryYmAJ7_K6auO5gFdpVr6Q', $tmplInfo['title_unknown'], $tmplInfo['fee'], $tmplInfo['trade_no'], $tmplInfo['logistic'], $tmplInfo['detail']);
            }

            $tplmessage->paid('oVP2NjsmJtw0HQGI41wP9KJ9cW5Q', $openId == 'oVP2NjryYmAJ7_K6auO5gFdpVr6Q' ? $tmplInfo['title_unknown']
                : $tmplInfo['title'], $tmplInfo['fee'], $tmplInfo['trade_no'], $tmplInfo['logistic'], $tmplInfo['detail']);
        } catch(\Exception $e){
            FileLogHelper::xlog($e->getMessage(), 'oauth/payment');
        }

        if(OrderList::ORDER_STATUS_PAID == $status){
            OrderPayLog::log($payinfo);
            return Schema::SuccessNotify('更新订单成功');
        }
        return Schema::FailureNotify('更新失败');
    }
}
