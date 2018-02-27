<?php
namespace application\web\admin\modules\order\controllers\site;

use application\models\base\OrderList;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\MessageHelper;

class DeleteAction extends AdminBaseAction{
    public $method = 'post';
    public function run(){
        $logi = OrderList::findByUuid($this->request->post('id'));
        if($logi){
            $logi->delete();
        }
        return MessageHelper::success('删除成功', ['/order/site']);

    }
}
