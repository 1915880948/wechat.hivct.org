<?php
/**
 * @category PayAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 26/11/2017 01:05
 * @since
 */

namespace application\web\www\modules\user\controllers\recv;

use application\models\base\Logistics;
use application\models\base\Reagent;
use application\models\base\UserEvent;
use application\web\www\components\WwwBaseAction;
use qiqi\helper\CryptHelper;
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
        $payinfo = CryptHelper::authcode(Json::encode([
            'trade_type'   => 'JSAPI',
            'body'         => "互联网+艾滋病快速自检试剂发放",
            'detail'       => join(",", $details),
            'out_trade_no' => $tradeno,
            // 'total_fee'    => $totalPrice, //目前是0
            'total_fee'    => 1, //目前是1分钱
            'openid'       => $this->account->openid,
            'notify_url'   => Url::to(['/oauth/notify'], true),
            'logistcis'    => $logistcisInfo !== null ? $logistcisInfo->attributes : [],
            'uid'          => $this->account->uid,
            'goods_list'   => Json::encode($products),
            'source_type'  => 'survey',
            'source_uuid'  => $eventId
        ]), 'ENCODE', env('WECHAT_APP_KEY'));
        // echo "<pre>";
        // print_r([
        //     'trade_type'   => 'JSAPI',
        //     'body'         => "互联网+艾滋病快速自检试剂发放",
        //     'detail'       => join(",", $details),
        //     'out_trade_no' => $tradeno,
        //     'total_fee'    => $totalPrice, //目前是0
        //     'openid'       => $this->account->openid,
        //     'notify_url'   => Url::to(['/oauth/notify'], true),
        //     'logistcis'    => $logistcisInfo !== null ? $logistcisInfo->attributes : [],
        //     'uid'          => $this->account->uid,
        //     'goods_list'   => Json::encode($products),
        //     'source_type'  => 'survey',
        //     'source_uuid'  => $eventId
        // ]);
        // echo "</pre>";
        return $this->render(compact('products', 'logistcisInfo', 'totalPrice', 'payinfo'));
    }
}
