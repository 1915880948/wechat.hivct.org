<?php

namespace application\web\admin\modules\order\controllers\site;

use application\models\base\OrderList;
use application\models\base\OrderOpLog;
use application\models\base\PayImage;
use application\web\admin\components\AdminBaseAction;

class DealAction extends AdminBaseAction
{
    public function run($uuid = '', $uid = '')
    {
        if(\Yii::$app->request->isPost){
            \Yii::$app->response->format = 'json';
            $postData = \Yii::$app->request->post();
            $addToLog = false;
            $order = OrderList::find()
                              ->andWhere(['uuid' => $postData['uuid']])
                              ->one();
            $orderStatusOrigin = $order->order_status;
            if($postData['method'] == 'deal_check'){
                $order->order_updated_at = date("Y-m-d H:i:s");
                $order->adis_result = $postData['adis_result'];
                $order->syphilis_result = $postData['syphilis_result'];
                $order->hepatitis_b_result = $postData['hepatitis_b_result'];
                $order->hepatitis_c_result = $postData['hepatitis_c_result'];
                $order->check_doctor = $postData['check_doctor'];
                $order->check_desc = $postData['check_desc'];
                $order->check_time = date('Y-m-d H:i:s', time());
            } elseif($postData['method'] == 'deal_status'){
                $addToLog = true;
                $order->order_status = $postData['order_status'];
            }
            if($order->save()){
                if($addToLog === true && $orderStatusOrigin != $order->order_status){
                    OrderOpLog::addLog($this->userinfo['id'], $postData['uuid'], $orderStatusOrigin, $order->order_status);
                }
                return ['code' => 200];
            } else{
                return ['code' => 500, 'error' => $order->getErrors()];
            }
        }

        //        if( !$this->userinfo['is_admin'] ){
        //            return MessageHelper::success('对不起，您没有权限！');
        //        }

        $images = PayImage::find()
                          ->andWhere(['user_id' => $uid, 'order_uuid' => $uuid])
                          ->asArray()
                          ->all();
        $orderData = OrderList::find()
                              ->andWhere(['uid' => $uid, 'uuid' => $uuid])
                              ->asArray()
                              ->one();
        $orderStatus = [
            OrderList::ORDER_STATUS_PAID                  => '重置为已支付状态',
            OrderList::ORDER_STATUS_APPLY_FOR_REFUND      => '申请退款',
            OrderList::ORDER_STATUS_REFUND_REVIEW         => '退款审核',
            OrderList::ORDER_STATUS_REFUND_REVIEW_SUCCESS => '退款成功',
            OrderList::ORDER_STATUS_REFUND_REVIEW_FAILED  => '退款失败',
            OrderList::ORDER_STATUS_REFUND_PROCESS        => '退款处理中',
            OrderList::ORDER_STATUS_REFUND_FINISHED       => '退款完成',
            OrderList::ORDER_STATUS_FINISHED              => '订单完成'
        ];
        return $this->render(compact('images', 'orderData', 'orderStatus'));
    }
}
