<?php
/**
 * @category TplMessage
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 02/03/2018 00:19
 * @since
 */

namespace wechat;

use EasyWeChat\Core\Exceptions\InvalidArgumentException;
use qiqi\helper\base\InstanceTrait;
use qiqi\helper\log\FileLogHelper;

class TplMessage
{
    use InstanceTrait;

    public function paid($to, $title, $price, $orderNo, $orderType, $desc)
    {
        $app = Weixin::getApp();
        $app->notice->send([
            'touser'      => $to,
            'template_id' => '1igZ8x8SLiUCm29xJqa4W5Jw16oQlIM-ZwUI5AcEhh4',
            'url'         => '',
            'data'        => [
                'first'    => $title,
                'keyword1' => $price,
                'keyword2' => $orderNo,
                'keyword3' => $orderType,
                'remark'   => $desc
            ],
        ]);
    }

    public function refund($to, $title, $orderNo, $price, $desc)
    {
        $app = Weixin::getApp();
        $app->notice->send([
            'touser'      => $to,
            'template_id' => 'UYM3134ZtGhMyjKAK8zSVm78hL3Fp-eFYMhPDF6yL4Y',
            'url'         => '',
            'data'        => [
                'first'    => $title,
                'keyword1' => $orderNo,
                'keyword2' => $price,
                'remark'   => $desc
            ]
        ]);
    }

    public function refundOver()
    {

    }

    public function ship($to , $title = '您的订单已经发货', $express, $code, $memo = '', $remark = '')
    {
        try{
            Weixin::getApp()->notice->send([
                'touser'      => $to,// $userInfo['openid'],
                'template_id' => 'DcwX2k69pf08WiBl5Zfa-Tsd6pit3NDhKhIgaIc01Ds',
                'url'         => '',
                'data'        => [
                    'first'    => $title,
                    'keyword1' => "您的订单已经由{$express}进行发货",
                    'keyword2' => "物流单号：{$code}",
                    'keyword3' => date("Y-m-d H:i"),
                    'keyword4' => '',
                    'remark'   => '',
                ],
            ]);
        } catch(InvalidArgumentException $e){
            FileLogHelper::xlog($e->getMessage(), 'wechat/template');
        }
    }
}
