<?php
namespace application\web\www\modules\user\controllers\images;
use application\models\base\OrderList;
use application\models\base\PayImage;
use application\web\www\components\WwwBaseAction;

class IndexAction extends WwwBaseAction{
    public function run(){
        if( \Yii::$app->request->isPost ){
            \Yii::$app->response->format = 'json';
            $postData = \Yii::$app->request->post();

            $orderModel = OrderList::find()
                ->andWhere(['uuid'=>$postData['order_uuid']])
            ->one();

            $orderModel->order_status = OrderList::ORDER_STATUS_APPLY_FOR_REFUND;
            $orderModel->alipay = $postData['alipay'];
            $orderModel->order_updated_at = date('Y-m-d H:i:s');

            $imageArr  = explode(',',trim($postData['images'],','));
//            print_r( $imageArr ); die;
            foreach ( $imageArr as $k=>$v ){
                $imageModel = new PayImage();
                $imageModel->user_id = $this->account['uid'];
                $imageModel->order_uuid = $postData['order_uuid'];
                $imageModel->image = $v;
                $imageModel->alipay = $postData['alipay'];
                $imageModel->created_at = date('Y-m-d H:i:s');
                $imageModel->save();
            }
            if( $orderModel->save() ){
                return ['code'=>200];
            }
        }
        return $this->render(compact(''));
    }
}