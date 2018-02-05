<?php
namespace application\web\admin\modules\upcheck\controllers\site;

use application\models\base\UpCheckResult;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\MessageHelper;

class DeleteAction extends AdminBaseAction{
    public $method = 'post';
    public function run(){
        $logi = UpCheckResult::findByPk($this->request->post('id'));
        if($logi){
            $logi->delete();
        }
        return MessageHelper::success('删除成功', ['/upcheck/site']);

    }
}