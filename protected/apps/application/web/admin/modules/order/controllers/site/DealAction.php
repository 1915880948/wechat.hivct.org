<?php
namespace application\web\admin\modules\order\controllers\site;

use application\models\base\OrderList;
use application\models\base\PayImage;
use application\web\admin\components\AdminBaseAction;

class DealAction extends AdminBaseAction{
    public function run($uuid=''){
        if( \Yii::$app->request->isPost){
            \Yii::$app->response->format = 'json';
            $uuid      = \Yii::$app->request->post('uuid');
            $back_url  = \Yii::$app->request->post('back_url');
            $order_status = \Yii::$app->request->post('order_status');

            $order = OrderList::find()
                ->andWhere(['uuid'=>$uuid])
                ->one();
            $order->order_updated_at = date("Y-m-d H:i:s");
            $order->order_status = $order_status;
            if( $order->save() ){
                return ['code'=>200];
            }
        }

        $images = PayImage::find()
            ->andWhere(['order_uuid'=>$uuid])
            ->asArray()
            ->all();
        $orderData = OrderList::find()
            ->andWhere(['uuid'=>$uuid])
            ->asArray()
            ->one();
        $orderStatus = [
            OrderList::ORDER_STATUS_APPLY_FOR_REFUND => '申请退款',
            OrderList::ORDER_STATUS_REFUND_REVIEW => '退款审核',
            OrderList::ORDER_STATUS_REFUND_REVIEW_SUCCESS => '退款成功',
            OrderList::ORDER_STATUS_REFUND_REVIEW_FAILED => '退款失败',
            OrderList::ORDER_STATUS_REFUND_PROCESS => '退款处理中',
            OrderList::ORDER_STATUS_REFUND_FINISHED => '退款完成',
            OrderList::ORDER_STATUS_FINISHED => '订单完成'
        ];
        return $this->render(compact('images','orderData','orderStatus'));
    }
}