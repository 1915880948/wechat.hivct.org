<?php
namespace application\web\admin\modules\upcheck\controllers\site;
use application\models\base\UpCheckImages;
use application\models\base\UpCheckResult;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\MessageHelper;

class DetailAction extends AdminBaseAction{
    public function run($id='',$uid=''){
        if( !$this->userinfo['is_admin'] ){
            return MessageHelper::success('对不起，您没有权限！');
        }

        $checkData = UpCheckResult::find()
            ->andWhere(['id'=>$id])
            ->asArray()
            ->one();
        $images = UpCheckImages::find()
            ->andWhere(['uid'=>$uid,'up_check_result_id'=>$id])
            ->orderBy(['id'=>SORT_DESC])
            ->asArray()
            ->all();

        return $this->render(compact('checkData','images'));
    }
}

