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
    public function run($logistics_id = '-99', $ship_uuid = '-99', $pay_status = '1', $order_status = '-99', $adis_result = '-99', $syphilis_result = '-99', $hepatitis_b_result = '-99', $hepatitis_c_result = '-99', $ship_code = '', $wx_transaction_id = '', $address_contact = '', $address_mobile = '')
    {
        $logistics = Logistics::find()
                              ->andWhere(['status' => 1])
                              ->asArray()
                              ->all();
        $express = Express::find()
                          ->andWhere(['status' => 1])
                          ->asArray()
                          ->all();
        $query = OrderList::find();

        if(!$this->userinfo['is_admin']){
            $logistics_id = $this->userinfo['logistic_id'];
        }

        $conditions = [
            'logistics_id'       => $logistics_id,
            'ship_uuid'          => $ship_uuid,
            'pay_status'         => $pay_status,
            'order_status'       => $order_status,
            'adis_result'        => $adis_result,
            'syphilis_result'    => $syphilis_result,
            'hepatitis_b_result' => $hepatitis_b_result,
            'hepatitis_c_result' => $hepatitis_c_result
        ];
        foreach($conditions as $condition => $val){
            if($val != '-99'){
                $query = $query->andWhere([$condition => $val]);
            }
        }

        if($ship_code){
            $query = $query->andWhere(['like', 'ship_code', $ship_code]);
        }
        if($wx_transaction_id){
            $query = $query->andWhere(['like', 'wx_transaction_id', $wx_transaction_id]);
        }
        if($address_contact){
            $query = $query->andWhere(['like', 'address_contact', $address_contact]);
        }
        if($address_mobile){
            $query = $query->andWhere(['like', 'address_mobile', $address_mobile]);
        }
        $provider = DataProviderHelper::create($query, 20);
        $provider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);

        $expressArr = ['-99' => '全部'];
        $ship = [];
        foreach($express as $key => $v){
            $ship[$v['id']] = $v['name'];
            $expressArr[$v['id']] = $v['name'];
        }

        $logArr = ['-99' => '全部'];
        foreach($logistics as $k => $v){
            $logArr[$v['id']] = $v['title'];
        }
        $payArr = [
            '-99'                         => '全部',
            OrderList::PAY_STATUS_FAILED  => '支付失败',
            OrderList::PAY_STATUS_DEFAULT => '待支付',
            OrderList::PAY_STATUS_SUCCESS => '已支付'
        ];

        $dealArr = [
            OrderList::ORDER_STATUS_APPLY_FOR_REFUND,
            OrderList::ORDER_STATUS_REFUND_REVIEW,
            OrderList::ORDER_STATUS_REFUND_REVIEW_SUCCESS,
            OrderList::ORDER_STATUS_REFUND_REVIEW_FAILED,
            OrderList::ORDER_STATUS_REFUND_PROCESS,
            OrderList::ORDER_STATUS_REFUND_FINISHED,
        ];

        return $this->render(compact('dealArr', 'payArr', 'logArr', 'expressArr', 'ship', 'provider','conditions'));
    }
}
