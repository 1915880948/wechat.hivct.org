<?php
namespace application\web\admin\modules\order\controllers\site;
use application\models\base\OrderList;
use application\models\base\PayImage;
use application\web\admin\components\AdminBaseAction;

class ApplyDealAction extends AdminBaseAction
{
    public function run($uid='',$uuid ='')
    {
        // 异步审核
        if( \Yii::$app->request->isPost){
            \Yii::$app->response->format = 'json';
            $postData = \Yii::$app->request->post();
            $order = OrderList::find()->andWhere(['uuid'=>$postData['uuid']])->one();
            $order->is_to_examine = $postData['is_to_examine'];
            $order->examine_reason = $postData['examine_reason'];
            $order->to_examine_admin = $this->userinfo['account'];
            if( $order->save() ){
                return ['code'=>200,'message'=>'examine success!!'];
            }
            return ['code'=>500,'error'=>$order->getErrors()];
        }
        $images = PayImage::find()
            ->andWhere(['user_id'=>$uid,'order_uuid'=>$uuid])
            ->asArray()
            ->all();
        $orderData = OrderList::find()->andWhere(['uuid'=>$uuid])->asArray()->one();

        return $this->render(compact( 'images','orderData'));
    }
}
