<?php
namespace application\web\www\modules\user\controllers\order;
use application\models\base\OrderDetail;
use application\models\base\OrderList;
use application\web\www\components\WwwBaseAction;

class PaybackAction extends WwwBaseAction{
    public function run(){
        if( \Yii::$app->request->isPost ){
            \Yii::$app->response->format = 'json';
            $postData = \Yii::$app->request->post();
            if( $postData['method'] == 'list' ){
                $orderList = OrderList::find()
                    ->andWhere(['uid'=>$this->account['uid'],'pay_status'=>1,'is_up_result'=>0])
                    ->andWhere(['>','created_at',date("Y-m-d H:i:s",time()-86400*30)])
                    ->asArray()
                    ->all();
                return $orderList;
            }
            if( $postData['method'] == 'payback' ){
               $orderModel = OrderList::find()
                    ->andWhere(['uuid'=>$postData['order_uuid']])
                    ->one();
                $orderModel->order_status = OrderList::ORDER_STATUS_APPLY_FOR_REFUND;
                $orderModel->alipay = $postData['alipay'];
                $orderModel->is_up_result = 1;
                $orderModel->order_updated_at = date('Y-m-d H:i:s');
                if( $orderModel->save() ){
                    return ['code'=>200];
                }
            }
        }

        return $this->render(compact(''));
    }
}