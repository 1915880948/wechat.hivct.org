<?php
/**
 * @category TemplateController
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 02/03/2018 00:26
 * @since
 */

namespace console\controllers;

use wechat\TplMessage;
use yii\console\Controller;

class TemplateController extends Controller
{
    public function actionSend()
    {
        // TplMessage::getInstance()
        //           ->paid($to = 'oVP2NjryYmAJ7_K6auO5gFdpVr6Q', $title = '支付成功', $price = '100.01', $orderNo = 12345, $orderType = '免密', $desc = '大额支付是很棒的');
        TplMessage::getInstance()
                  ->refund($to = 'oVP2NjryYmAJ7_K6auO5gFdpVr6Q', $title = 'XXX 申请退款', $orderNo = 12345, $price = '100.01', $desc = '申请退款通知');
    }
}
