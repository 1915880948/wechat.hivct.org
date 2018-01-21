<?php
namespace application\web\admin\modules\order\controllers\site;

use application\models\base\Express;
use application\models\base\Logistics;
use application\models\base\OrderDetail;
use application\models\base\OrderList;
use application\models\base\User;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\DataProviderHelper;

class DetailAction extends AdminBaseAction{
    public function run( $uuid,$uid ){
        $express = Express::find()->andWhere(['status'=>1])->asArray()->all();
        $query = OrderDetail::find()
                    ->andWhere(['order_uuid'=>$uuid]);
        $provider = DataProviderHelper::create( $query );

        $order_data = OrderList::find()
                    ->andWhere(['uuid'=>$uuid])
                    ->one();
        $userdata = User::find()->andWhere(['uid'=>$uid])->asArray()->one();
        $ship = array_column($express,'name','id');

        $logisticsInfo = [];
        if($order_data['logistic_id']>0){
            $logisticsInfo = Logistics::getLogisitcsInfo($order_data['logistic_id']);
        }
        return $this->render(compact('ship','userdata','provider','order_data','logisticsInfo'));
    }
}
