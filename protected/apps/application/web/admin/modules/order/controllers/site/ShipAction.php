<?php

namespace application\web\admin\modules\order\controllers\site;

use application\common\base\OpenIds;
use application\models\base\Express;
use application\models\base\OrderList;
use application\models\base\User;
use application\web\admin\components\AdminBaseAction;
use EasyWeChat\Core\Exceptions\InvalidArgumentException;
use qiqi\helper\log\FileLogHelper;
use wechat\TplMessage;

class ShipAction extends AdminBaseAction
{
    const SHIP_SEND = 'SHIP::send';

    public function run()
    {
        // \Yii::$app->session->open();
        // $sess->set(self::SHIP_SEND, time());
        if(\Yii::$app->request->isPost){
            \Yii::$app->response->format = 'json';
            $uuid = \Yii::$app->request->post('uuid');
            $back_url = \Yii::$app->request->post('back_url');
            $ship_id = \Yii::$app->request->post('ship_id');
            $ship_code = \Yii::$app->request->post('ship_code');

            $order = OrderList::find()
                              ->andWhere(['uuid' => $uuid])
                              ->one();
            if($order['logistic_id'] !== $this->userinfo['logistic_id'] && !$this->userinfo['is_admin']){
                return ['code' => 5000, 'error' => '您不是该发货地的管理员'];
            }
            $express = Express::find()
                              ->andWhere(['id' => $ship_id])
                              ->asArray()
                              ->one();
            if(!$express){
                $express = new Express();
                $express->name = $ship_id;
                $order->ship_name = $ship_id;
                $express->save();
                $expressId = Express::find()
                                    ->orderBy(['id' => SORT_DESC])
                                    ->asArray()
                                    ->one();
                $order->ship_uuid = $expressId['id'];
            } else{
                $order->ship_name = $express['name'];
                $order->ship_uuid = $ship_id;
                $order->ship_code = $ship_code;
            }
            //向用户发送一下
            $userId = $order['uid'];
            $userInfo = User::findByPk($userId);
            if($userInfo){
                try{
                    //同一时刻只发一条，半小时内
                    $tplMsg = TplMessage::getInstance();
                    $tplMsg->ship(OpenIds::getMomoOpenId(), $title = '您的订单已经发货', $express['name'], $code = $ship_code, $memo = "", $remark = "收到试纸后测试完成并上传图片，可以进行退款申请");
                    $tplMsg->ship(OpenIds::getGoukiOpenId(), $title = '您的订单已经发货', $express['name'], $code = $ship_code, $memo = "", $remark = "收到试纸后测试完成并上传图片，可以进行退款申请");
                    //发送给客户
                    $tplMsg->ship($userInfo['openid'], $title = '您的订单已经发货', $express['name'], $code = $ship_code, $memo = "", $remark = "收到试纸后测试完成并上传图片，审核完成后可以进行退款申请");
                    /*
                     * {{first.DATA}}
                     订单内容：{{keyword1.DATA}}
                     发货物流：{{keyword2.DATA}}
                     时间：{{keyword3.DATA}}
                     备注：{{keyword4.DATA}}
                     {{remark.DATA}}
                     */
                    // WechatHelper::getApp()->notice->send([
                    //     'touser'      => 'oVP2NjryYmAJ7_K6auO5gFdpVr6Q',// $userInfo['openid'],
                    //     'template_id' => 'DcwX2k69pf08WiBl5Zfa-Tsd6pit3NDhKhIgaIc01Ds',
                    //     'url'         => '',
                    //     'data'        => [
                    //         'first'    => '您的订单已经发货',
                    //         'keyword1' => "您的订单已经由{$express['name']}进行发货",
                    //         'keyword2' => "物流单号：{$ship_code}",
                    //         'keyword3' => date("Y-m-d H:i"),
                    //         'keyword4' => '',
                    //         'remark'   => '',
                    //     ],s
                    // ]);

                } catch(InvalidArgumentException $e){

                } catch(\Exception $e){
                    FileLogHelper::xlog($e->getMessage(), 'wechat/template');
                }
            }
            $order->ship_status = 1;
            $order->order_status = OrderList::ORDER_STATUS_SHIP;
            if($order->save()){
                return ['code' => 200,];
            } else{
                return ['code' => 500, 'error' => join(",", $order->getFirstErrors())];
            }
        }
    }
}
