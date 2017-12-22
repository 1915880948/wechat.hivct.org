<?php
namespace application\web\admin\modules\order\controllers\site;

use application\models\base\Express;
use application\models\base\OrderList;
use application\web\admin\components\AdminBaseAction;

class ShipAction extends AdminBaseAction{
    public function run(){
        if( \Yii::$app->request->isPost){
            \Yii::$app->response->format = 'json';
            $uuid      = \Yii::$app->request->post('uuid');
            $back_url  = \Yii::$app->request->post('back_url');
            $ship_id = \Yii::$app->request->post('ship_id');
            $ship_code = \Yii::$app->request->post('ship_code');

            $order = OrderList::find()
                ->andWhere(['uuid'=>$uuid])
                ->one();
            $express = Express::find()->andWhere(['id'=>$ship_id])->asArray()->one();
            $order->ship_name = $express['name'];
            $order->ship_code = $ship_code;
            $order->ship_uuid = $ship_id;
            $order->ship_status = 1;
            $order->order_status = 3;
            if( $order->save() ){
                return ['code'=>200];
            }
        }
    }
}