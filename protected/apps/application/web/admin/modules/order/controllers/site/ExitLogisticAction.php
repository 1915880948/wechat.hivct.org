<?php
namespace application\web\admin\modules\order\controllers\site;

use application\models\base\OrderList;
use application\web\admin\components\AdminBaseAction;

class ExitLogisticAction extends AdminBaseAction{
    public $method = 'post';
    public $responseType = 'json';
    public function run(){
        $postData = $this->request->post();
        $model = OrderList::find()
            ->andWhere(['uuid'=>$postData['uuid']])
            ->one();
        $model->logistic_id = $postData['logistic_id'];
        if( $model->save() ){
            return ['code'=>200,'message'=>'success'];
        }
        return ['code'=>500,'message'=>$model->getErrors()];

    }
}