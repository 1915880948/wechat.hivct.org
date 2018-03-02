<?php

namespace application\web\www\modules\user\controllers\images;

use application\models\base\OrderList;
use application\models\base\PayImage;
use application\web\www\components\WwwBaseAction;

class IndexAction extends WwwBaseAction
{
    public function run()
    {
        if(\Yii::$app->request->isPost){
            \Yii::$app->response->format = 'json';
            $postData = \Yii::$app->request->post();
            $orderModel = OrderList::find()
                                   ->andWhere(['uuid' => $postData['order_uuid']])
                                   ->one();
            $orderModel->is_up_result = 1;
            $imageArr = explode(',', trim($postData['images'], ','));
            $trans = \Yii::$app->db->beginTransaction();
            $erros = [];
            foreach($imageArr as $k => $v){
                $imageModel = new PayImage();
                $imageModel->user_id = $this->account['uid'];
                $imageModel->order_uuid = $postData['order_uuid'];
                $imageModel->image = $v;
                $imageModel->created_at = date('Y-m-d H:i:s');
                $imageModel->save();
                if($imageModel->hasErrors()){
                    $trans->rollBack();
                    $erros[] = $imageModel->getErrors();
                    break;
                }
            }
            if($orderModel->save()){
                $trans->commit();
                return ['code' => 200];
            }
            $trans->rollBack();
            return ['code' => 500, 'message' => [$orderModel->getErrors(), $erros]];
        }
        return $this->render(compact(''));
    }
}
