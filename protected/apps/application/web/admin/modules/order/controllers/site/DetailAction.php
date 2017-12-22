<?php
namespace application\web\admin\modules\order\controllers\site;

use application\models\base\Express;
use application\models\base\OrderDetail;
use application\models\base\OrderList;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\DataProviderHelper;

class DetailAction extends AdminBaseAction{
    public function run( $uuid ){
        $express = Express::find()->andWhere(['status'=>1])->asArray()->all();
        $query = OrderDetail::find()
                    ->andWhere(['order_uuid'=>$uuid]);
        $provider = DataProviderHelper::create( $query );

        $order_data = OrderList::find()
                    ->andWhere(['uuid'=>$uuid])
                    ->one();
        $ship = [];
        $ship = array_column($express,'name','id');
//        foreach ( $express as $k=>$v){
//            $ship[$v['id']] = $v['name'];
//        }
        return $this->render(compact('ship','provider','order_data'));
    }
}