<?php

namespace application\web\admin\modules\order\controllers\site;

use application\models\base\OrderList;
use application\models\base\OrderMemoLog;
use application\models\base\User;
use application\web\admin\components\AdminBaseAction;

class MemoAction extends AdminBaseAction
{
    public $method = 'post';
    public $responseType = 'json';

    public function run()
    {
        $postData = \Yii::$app->request->post();
        $order = OrderList::find()
            ->andWhere(['uuid' => $postData['uuid']])
            ->one();
        $order->order_updated_at = date("Y-m-d H:i:s");
        $order->memo = $postData['memo'];

        $memo = new OrderMemoLog();
        $memo->order_uuid = $postData['uuid'];
        $memo->admin_id = $this->userinfo['aid'];
        $memo->admin_account = $this->userinfo['account'];
        $memo->datetime = date("Y-m-d H:i:s");
        $memo->memo_history = $postData['memo'];
        if ($order->save() && $memo->save() ) {
            return ['code' => 200];
        } else {
            return ['code' => 500, 'order-error' => $order->getErrors(),'memo-error' =>$memo->getErrors()];
        }
    }
}