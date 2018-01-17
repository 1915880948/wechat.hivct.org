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

            $imageArr  = explode(',',trim($postData['images'],','));
            foreach ( $imageArr as $k=>$v ){
                $imageModel = new PayImage();
                $imageModel->user_id = $this->account['uid'];
                $imageModel->order_uuid = $postData['order_uuid'];
                $imageModel->image = $v;
                $imageModel->created_at = date('Y-m-d H:i:s');
                $imageModel->save();
            }
            return ['code'=>200];
        }
        return $this->render(compact(''));
    }
}