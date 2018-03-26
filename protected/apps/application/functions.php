<?php
/**
 * @category ${NAME}
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/8/14 00:31
 * @since
 */

use application\models\base\OrderList;
use common\core\session\GSession;
use qiqi\helper\WechatHelper;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\Url;
use wechat\Weixin;
/**
 * @param $url
 * @return bool|string
 */
function gStatic($url)
{
    $url = ltrim($url, '/');
    return Yii::getAlias("@webstatic/{$url}");
}

function gHasError()
{
    return \Yii::$app->getSession()
                     ->hasFlash('error');
}

function gJsonEncode($data, $options = 320)
{
    return Json::encode($data, $options);
}

function gJsonDecode($data)
{
    return Json::decode($data);
}

function gGetError()
{
    return GSession::getDbError();
}

function gSession()
{
    return Yii::createObject(GSession::class);
}

function gArrayHelper()
{
    return Yii::createObject(ArrayHelper::class);
}

/**
 * @param      $url
 * @param bool $schema
 * @return string
 */
function gUrl($url, $schema = false)
{
    $url = "/" . Url::to($url);
    return Url::to($url, $schema);
}

/**
 * 返回全局首页
 * @return string
 */
function gHomeUrl()
{
    return '/site/index';
}

function gOrderStatus($id)
{
    $orderStatus = [
        OrderList::ORDER_STATUS_WAIT_FOR_PAY          => '未处理',
        OrderList::ORDER_STATUS_CANCEL                => '处理中',
        OrderList::ORDER_STATUS_PAID                  => '已支付',
        OrderList::ORDER_STATUS_SHIP                  => '已发货',
        OrderList::ORDER_STATUS_SHIP_USER_RECEIVED    => '已收货',
        OrderList::ORDER_STATUS_SHIP_USER_NOT_EXISTS  => '用户不存在',
        OrderList::ORDER_STATUS_SHIP_FINISHED         => '发货完成',
        OrderList::ORDER_STATUS_APPLY_FOR_REFUND      => '申请退款',
        OrderList::ORDER_STATUS_REFUND_REVIEW         => '退款审核',
        OrderList::ORDER_STATUS_REFUND_REVIEW_SUCCESS => '退款成功',
        OrderList::ORDER_STATUS_REFUND_REVIEW_FAILED  => '退款失败',
        OrderList::ORDER_STATUS_REFUND_PROCESS        => '退款处理中',
        OrderList::ORDER_STATUS_REFUND_FINISHED       => '退款完成',
        OrderList::ORDER_STATUS_FINISHED              => '订单完成'
    ];
    return ArrayHelper::getValue($orderStatus, $id, '--');
}

function gPayStatus($id)
{
    $payStatus = [
        OrderList::PAY_STATUS_FAILED  => '支付失败',
        OrderList::PAY_STATUS_DEFAULT => '待支付',
        OrderList::PAY_STATUS_SUCCESS => '已支付'
    ];
    return ArrayHelper::getValue($payStatus, $id);
}

/**
 * @return \EasyWeChat\Js\Js
 */
function jssdk()
{
    return WechatHelper::getApp()->js;
}

function gFormatPayTime($time){
    if(!$time || strlen($time )!=14){
        return "";
    }
    $y = substr($time,0,4);
    $other = str_split(substr($time,4),2);
    $times = ArrayHelper::merge((array)$y,$other);
    return vsprintf("%s-%s-%s %s:%s:%s",$times);
}

function gSendMessage($to_user,$template_id,$url,$content){
    $weixin = Weixin::getApp();
    $weixin->template_message->send([
        'touser' => $to_user,
        'template_id' => $template_id,
        'url' => $url,
        'data' => $content,
    ]);
}

function gCheckResult($result){
    if( $result == 0){
        return '未检测';
    }
    if( $result == 1){
        return '阴性';
    }
    if( $result == 2){
        return '阳性';
    }
    if( $result == 3){
        return '检测失败';
    }
}
