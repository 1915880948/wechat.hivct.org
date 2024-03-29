<?php
/**
 * @category SubmitOrderAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 29/11/2017 10:48
 * @since
 */

namespace application\web\www\modules\user\controllers\recv;

use application\models\base\OrderList;
use application\web\www\components\WwwBaseAction;
use common\core\base\Schema;
use qiqi\helper\CryptHelper;
use qiqi\helper\log\FileLogHelper;
use qiqi\helper\MessageHelper;
use yii\helpers\Json;

class SubmitOrder2Action extends WwwBaseAction
{
    public $method = 'post';
    public $responseType = 'json';

    public function run()
    {

        $order = OrderList::findByUuid($this->request->post('uuid',$this->request->post('order_uuid')));
        if($order['uid'] != $this->account['uid']){
            return Schema::FailureNotify('对不起，您提交的订单不是由您自己创建的');
        }
        // $payinfo = $this->request->post('payinfo');
        // try{
        //     $postdata = Json::decode(CryptHelper::authcode($payinfo, 'DECODE', env('WECHAT_APP_KEY')));
        // } catch(\Exception $e){
        //     FileLogHelper::xlog($e->getMessage(), 'payment');
        // } finally{
        //     if(!$postdata){
        //         $postdata = [
        //             'uid' => -1
        //         ];
        //     }
        // }
        //
        // if($postdata['uid'] != $this->account['uid']){
        //     return Schema::FailureNotify('对不起，您提交的订单不是由您自己创建的');
        // }

//        if($order = OrderList::findBySource($postdata['source_type'], $postdata['source_uuid'])){
//            // return Schema::FailureNotify('订单已成功提交，请不要重复提交');
//            // return MessageHelper::error('订单已成功提交，请不要重复提交');
//
//        }else{
//            $order = OrderList::create($postdata);
//        }



//        if($postdata['total_fee'] <= 0){//代表全是免费的，直接入库
            $order->updatePayZeroStatus();
//            return MessageHelper::error('订单提交成功');
//            // return MessageHelper::success('订单提交成功', [gHomeUrl()]);
//        }
        return Schema::SuccessNotify('提交成功');
        //开始接入支付
        // $sHtml = "<form id='payForm' name='payForm' action='" . env('WECHAT_PAY_URL') . "' method='post'>";
        // $sHtml .= "<input type='hidden' name='json_payinfo' value='{$payinfo}' /></form>";
        // $sHtml = $sHtml . "<script>document.forms['payForm'].submit();</script>";
        // return $sHtml;
    }
}
