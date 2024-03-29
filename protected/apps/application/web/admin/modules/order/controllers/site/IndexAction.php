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

class IndexAction extends AdminBaseAction
{
    public function run($logistic_id = '-99', $ship_uuid = '-99', $pay_status = '1', $order_status = '-99', $adis_result = '-99', $syphilis_result = '-99', $hepatitis_b_result = '-99', $hepatitis_c_result = '-99', $ship_code = '', $wx_transaction_id = '', $address_contact = '', $address_mobile = '', $up = -99)
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
            $logistic_id = $this->userinfo['logistic_id'];
        }

        $conditions = [
            'logistic_id'        => $logistic_id,
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
        if($up != -99){//申请退款并且审核通过
            $query = $query->andWhere(['order_stauts' => OrderList::ORDER_STATUS_APPLY_FOR_REFUND])
                           ->andWhere(['is_to_examine' => 1]);
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

        $checkArr = [
            '-99' => '全部',
            '1'   => '阴性',
            '2'   => '阳性',
            '3'   => '检测失败'
        ];

        $dealArr = [
//            OrderList::ORDER_STATUS_PAID                  => '已支付',
//            OrderList::ORDER_STATUS_SHIP                  => '已发货',
//            OrderList::ORDER_STATUS_SHIP_USER_RECEIVED    => '已收货',
            OrderList::ORDER_STATUS_APPLY_FOR_REFUND,
            OrderList::ORDER_STATUS_REFUND_REVIEW,
            OrderList::ORDER_STATUS_REFUND_REVIEW_SUCCESS,
            OrderList::ORDER_STATUS_REFUND_REVIEW_FAILED,
            OrderList::ORDER_STATUS_REFUND_PROCESS,
            OrderList::ORDER_STATUS_REFUND_FINISHED,
        ];

        return $this->render(compact('dealArr', 'checkArr','payArr', 'logArr', 'expressArr', 'ship', 'provider', 'conditions', 'logistics','logistic_id','pay_status'));
    }
}
