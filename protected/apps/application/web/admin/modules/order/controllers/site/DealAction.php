<?php
namespace application\web\admin\modules\order\controllers\site;

use application\models\base\OrderList;
use application\web\admin\components\AdminBaseAction;

class DealAction extends AdminBaseAction{
    public function run(){
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
    }
}