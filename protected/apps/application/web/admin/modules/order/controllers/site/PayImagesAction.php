<?php
namespace application\web\admin\modules\order\controllers\site;

use application\models\base\PayImage;
use application\web\admin\components\AdminBaseAction;

class PayImagesAction extends AdminBaseAction
{
    public function run()
    {
        if( \Yii::$app->request->isPost){
            \Yii::$app->response->format = 'json';
            $postData = \Yii::$app->request->post();
            $imageArr = [];
            if (trim($postData['images']) ){
                $imageArr = explode(',', trim($postData['images'], ','));
            }
            foreach ( $imageArr as $k=>$v ){
                $model = new PayImage();
                $model->user_id = $postData['user_id'];
                $model->order_uuid = $postData['uuid'];
                $model->image = $v;
                $model->created_at = date('Y-m-d H:i:s',time());
                $model->save();
            }
            return ['code'=>200];
        }

        return $this->render(compact( ''));
    }
}
