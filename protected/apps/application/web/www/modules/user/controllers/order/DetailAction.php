<?php
namespace application\web\www\modules\user\controllers\order;
use application\models\base\OrderDetail;
use application\models\base\OrderList;
use application\models\base\PayImage;
use application\web\www\components\WwwBaseAction;

class DetailAction extends WwwBaseAction{
    public function run($uuid=''){
        $orderData = OrderList::find()
            ->andWhere(['uuid'=>$uuid])
            ->asArray()
            ->one();
        $detailData = OrderDetail::find()
            ->andWhere(['order_uuid'=>$uuid])
            ->asArray()
            ->all();
        $images = PayImage::find()
            ->andWhere(['status'=>1,'order_uuid'=>$uuid])
            ->asArray()
            ->all();
        return $this->render(compact('orderData','detailData','images'));
    }
}