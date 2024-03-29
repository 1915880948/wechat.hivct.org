<?php

namespace application\models\base;

use application\models\db\TblOrderPayLog;
use qiqi\helper\ip\IpHelper;
use qiqi\helper\log\FileLogHelper;

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
        $m = new self;
        $m->device_info = $device;
        $m->trade_type = 1;
        $m->bank_type = $payInfo['bank_type'];
        $m->out_trade_no = $payInfo['out_trade_no'];
        $m->transaction_id = $payInfo['transaction_id'];
        $m->cash_fee = round($payInfo['cash_fee'] / 100, 2);
        $m->total_fee = round($payInfo['total_fee'] / 100, 2);
        $m->result_code = $payInfo['result_code'];
        $m->time_end = $payInfo['time_end'];
        $m->client_ip = IpHelper::getRealIP();
        $m->save();
        if($m->hasErrors()){
            FileLogHelper::xlog(['error' => $m->getErrors()], 'db/save');
        }
    }
}
