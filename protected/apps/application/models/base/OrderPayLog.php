<?php

namespace application\models\base;

use application\models\db\TblOrderPayLog;
use qiqi\helper\ip\IpHelper;

/**
 * This is the model class for tableClass "TblOrderPayLog".
 * className OrderPayLog
 * @package application\models\base
 */
class OrderPayLog extends TblOrderPayLog
{
    /**
     * {"appid":"wx6ae2594ba50776b1","bank_type":"CFT","cash_fee":"3000","fee_type":"CNY","is_subscribe":"Y",
     * "mch_id":"1290330301","nonce_str":"5a792015377d0","openid":"oVP2NjnrQlCDCYEM1uveeFg13kdU",
     * "out_trade_no":"SUR201802061124540000000087","result_code":"SUCCESS",
     * "return_code":"SUCCESS","sign":"9899F502AD0EDB940BA06DE52834DDD7",
     * "time_end":"20180206112521",
     * "total_fee":"3000","trade_type":"JSAPI","transaction_id":"4200000079201802068015847775"}
     * @param $payInfo
     */
    public static function log($payInfo, $device = 'wechat')
    {
        /**
         * @property string  $out_trade_no
         * @property string  $transaction_id
         * @property string  $out_refund_no
         * @property string  $refund_id
         * @property string  $result_code
         * @property string  $err_code
         * @property string  $err_code_des
         * @property string  $total_fee
         * @property string  $cash_fee
         * @property string  $refund_fee
         * @property string  $time_end
         * @property string  $client_ip
         * @property integer $add_time
         */
        $m = new self;
        $m->device_info = $device;
        $m->trade_type = $payInfo['trade_type'];
        $m->bank_type = $payInfo['bank_type'];
        $m->out_trade_no = $payInfo['out_trade_no'];
        $m->transaction_id = $payInfo['transaction_id'];
        $m->cash_fee = $payInfo['cash_fee'];
        $m->total_fee = $payInfo['total_fee'];
        $m->result_code = $payInfo['result_code'];
        $m->time_end = $payInfo['time_end'];
        $m->client_ip = IpHelper::getRealIP();
        $m->add_time = $_SERVER['REQUEST_TIME'];
        $m->save();
    }
}
