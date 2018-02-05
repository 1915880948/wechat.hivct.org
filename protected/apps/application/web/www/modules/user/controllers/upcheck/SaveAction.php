<?php
namespace application\web\www\modules\user\controllers\upcheck;
use application\models\base\UpCheckImages;
use application\models\base\UpCheckResult;
use application\web\www\components\WwwBaseAction;

class SaveAction extends WwwBaseAction{
    public function run(){
        if( $this->request->getIsPost()){
            $postData = $this->request->post();
            \Yii::$app->response->format = 'json';
            $imageArr  = explode(',',trim($postData['images'],','));
            $model = new UpCheckResult();
            $model->uid = $this->account['uid'];
            $model->name = $postData['name'];
            $model->phone = $postData['phone'];
            $model->email = $postData['email'];
            $model->created_at = date('Y-m-d H:i:s');
            $model->save();
            $model = UpCheckResult::find()
                ->andWhere(['uid'=>$this->account['uid']])
                ->orderBy(['id'=>SORT_DESC])
                ->one();
            $tag = true ;
            foreach ( $imageArr as $k=>$v ){
                $modelImages = new UpCheckImages();
                $modelImages->up_check_result_id = $model['id'];
                $modelImages->uid = $this->account['uid'];
                $modelImages->image = $v;
                $modelImages->status = 1;
                $modelImages->created_at = date('Y-m-d H:i:s');
                if( !$modelImages->save() ){
                    $tag =false ;
                }
            }
            if( $tag ){
                return ['code'=>200,'message'=>'success'];
            }
            return ['code'=>500,'message'=>$model->getErrors()];
        }
        return  $this->render(compact(''));
    }
}
