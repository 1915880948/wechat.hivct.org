<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 21/11/2017 23:01
 * @since
 */

namespace application\web\admin\modules\order\controllers\site;

use application\models\base\Express;
use application\models\base\Logistics;
use application\models\base\OrderList;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\DataProviderHelper;
use qiqi\traits\Render;

class IndexAction extends AdminBaseAction
{
    public function run($logistics_id='-99',$ship_uuid='-99',$pay_status='-99',$order_status='-99',$ship_code ='', $wx_transaction_id='' )
    {
        $logistics = Logistics::find()->andWhere(['status'=>1])->asArray()->all();
        $express = Express::find()->andWhere(['status'=>1])->asArray()->all();
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
        $provider = DataProviderHelper::create($query, 20);
        $provider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);


        $expressArr = ['-99'=>'全部'];
        $ship = [];
        foreach ( $express as $key=>$v ){
            $ship[$v['id']] = $v['name'];
            $expressArr[$v['id']] = $v['name'];
        }

        $logArr = ['-99'=>'全部'];
        foreach ( $logistics as $k=>$v){
            $logArr[$v['id']] = $v['title'];
        }

        $payArr = [
            '-99' => '全部',
            '0'   => '待支付',
            '1'   => '已支付',
            '-1'  => '支付失败'
        ];

        return $this->render(compact('payArr','logArr','expressArr','ship','provider'));
    }
}
