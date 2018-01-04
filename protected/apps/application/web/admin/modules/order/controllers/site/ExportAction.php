<?php
namespace application\web\admin\modules\order\controllers\site;
use application\models\base\OrderList;
use application\web\admin\components\AdminBaseAction;

class ExportAction extends AdminBaseAction{
    public function run($logistics_id='-99',$ship_uuid='-99',$pay_status='-99',$order_status='-99',$ship_code ='', $wx_transaction_id='' ){
        $query = OrderList::find();
        if( $logistics_id != '-99' ){
            $query = $query->andWhere(['logistic_id'=>$logistics_id]);
        }
        if( $ship_uuid != '-99' ){
            $query = $query->andWhere(['ship_uuid'=>$ship_uuid]);
        }
        if( $pay_status != '-99' ){
            $query = $query->andWhere(['pay_status'=>$pay_status]);
        }
        if( $order_status != '-99' ){
            $query = $query->andWhere(['order_status'=>$order_status]);
        }
        if( $ship_code ){
            $query = $query->andWhere(['like','ship_code', $ship_code]);
        }
        if( $wx_transaction_id ){
            $query = $query->andWhere(['like','wx_transaction_id', $wx_transaction_id]);
        }
        $listData = $query->orderBy(['id'=>SORT_DESC])->asArray()->all();
        dd( $listData);
    }
}