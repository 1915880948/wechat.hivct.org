<?php
namespace application\web\admin\modules\upcheck\controllers\site;

use application\models\base\UpCheckResult;
use application\web\admin\components\AdminBaseAction;

class CheckAction extends AdminBaseAction{
    public function run(){
        if( \Yii::$app->request->isPost){
            \Yii::$app->response->format = 'json';
            $postData = \Yii::$app->request->post();
            $checkResult = UpCheckResult::find()
                ->andWhere(['id'=>$postData['id']])
                ->one();
            $checkResult->updated_at = date("Y-m-d H:i:s");
            $checkResult->adis_result = $postData['adis_result'];
            $checkResult->syphilis_result = $postData['syphilis_result'];
            $checkResult->hepatitis_b_result = $postData['hepatitis_b_result'];
            $checkResult->hepatitis_c_result = $postData['hepatitis_c_result'];
            $checkResult->check_doctor = $postData['check_doctor'];
            $checkResult->check_desc = $postData['check_desc'];
            if( $checkResult->save() ){
                return ['code'=>200];
            }else{
                return ['code'=>500,'error'=>$checkResult->getErrors()];
            }
        }
    }
}
