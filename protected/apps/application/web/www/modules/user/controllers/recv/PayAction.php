<?php
/**
 * @category PayAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 26/11/2017 01:05
 * @since
 */

namespace application\web\www\modules\user\controllers\recv;

use application\models\base\Logistics;
use application\models\base\OrderList;
use application\models\base\Reagent;
use application\models\base\UserAddress;
use application\models\base\UserEvent;
use application\web\www\components\WwwBaseAction;
use qiqi\helper\CryptHelper;
use qiqi\helper\log\FileLogHelper;
use qiqi\helper\MessageHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;

class PayAction extends WwwBaseAction
{
    /**
     * 对eventId进行支付
     * @param $eventId
     */
    public function run($eventId)
    {
        $eventInfo = UserEvent::findByUuid($eventId);
        if(!$eventInfo){
            return $this->controller->redirect(['/site/index']);
        }
        $orderTemporary = Json::decode($eventInfo->order_temporary);
        $products = $orderTemporary['products'];
        $logistcis = $orderTemporary['logistics'];
        $ids = [];
        $totalPrice = 0;
        foreach($products as $type => $product){
            if(is_string($product)){
                $pid[] = $product;
            } else{
                $pid = array_keys($product);
            }
            $ids = ArrayHelper::merge($ids, $pid);
        }

        $logistcisInfo = Logistics::findByPk($logistcis);
        $products = Reagent::getByOrder($ids);
        /**
         * .......
         */
        $details = [];
        foreach($products as $k => $product){
            $totalPrice += $product['price'];
            $details[] = $product['name'];
        }

        /**
         * $payinfo
         */
        $tradeno = "SUR" . date("Ymdhis") . str_pad($eventInfo['id'], 10, '0', STR_PAD_LEFT);
        $postdata = [
            'trade_type'   => 'JSAPI',
            'body'         => "互联网+艾滋病快速自检试剂发放",
            'detail'       => join(",", $details),
            'out_trade_no' => $tradeno,
            // 'total_fee'    => $totalPrice, //目前是0
            'total_fee'    => ($totalPrice+30)*100, //目前是1分钱
            'openid'       => $this->account->openid,
            'notify_url'   => Url::to(['/oauth/notify'], true),
            'logistcis'    => $logistcisInfo !== null ? $logistcisInfo->attributes : [],
            'uid'          => $this->account->uid,
            'goods_list'   => Json::encode($products),

            'source_type' => $eventInfo->event_type,
            'source_uuid' => $eventInfo->event_type_uuid
        ];
        $payinfo = CryptHelper::authcode(Json::encode($postdata), 'ENCODE', env('WECHAT_APP_KEY'));//
        if($order = OrderList::findBySource('survey', $eventId)){
            if($order->pay_status == OrderList::ORDER_STATUS_PAID){
                //...
            }
        } else{
            $order = OrderList::create($postdata);
            $order->updateLogitics($logistcis);
            /**
             * 补充地址信息
             */
            $addressInfo = UserAddress::findByUuid($eventInfo->user_address_uuid);
            $order->updateAddressInfo($addressInfo);
        }
        $trans = \Yii::$app->db->beginTransaction();
        if($order->hasErrors()){
            FileLogHelper::xlog(['order' => $postdata, 'order-error' => $order->getErrors()], 'payment/error');
            $trans->rollBack();
            // return Schema::FailureNotify('订单提交失败，请检查后重新提交，如多次失败，请联系管理员');
            return MessageHelper::error('订单提交失败，请检查后重新提交，如多次失败，请联系管理员');
        }


        $detailErrors = OrderList::createOrderDetail($order['uuid'], Json::decode($postdata['goods_list']));
        if($detailErrors){
            $trans->rollBack();
            FileLogHelper::xlog(['order' => $postdata, 'order-detail-error' => $detailErrors], 'payment/error');
            // return Schema::FailureNotify('订单提交失败，请检查后重新提交，如多次失败，请联系管理员');
            return MessageHelper::error('订单提交失败，请检查后重新提交，如多次失败，请联系管理员');
        }
        $trans->commit();
        return $this->render(compact('products', 'logistcisInfo', 'totalPrice', 'payinfo', 'order'));
    }
}
