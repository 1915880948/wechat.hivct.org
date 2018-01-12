<?php
namespace application\web\www\modules\user\controllers\order;
use application\models\base\OrderList;
use application\web\www\components\WwwBaseAction;

class IndexAction extends WwwBaseAction{
    public function run(){
        if(\Yii::$app->request->isPost){
            \Yii::$app->response->format = 'json';
            $uuid = \Yii::$app->request->post('uuid');
            $model= OrderList::find()
                ->andWhere(['uuid'=>$uuid])
                ->one();
            $model->order_status = OrderList::ORDER_STATUS_SHIP_USER_RECEIVED;
            if( $model->save() ){
                return ['code'=>200];
            }
        }
        $orderList  = OrderList::find()
            ->andWhere(['uid'=>$this->account['uid'],'pay_status'=>1])
            ->orderBy(['id'=>SORT_DESC])
            ->asArray()
            ->all();
        return $this->render(compact('orderList'));
    }
}