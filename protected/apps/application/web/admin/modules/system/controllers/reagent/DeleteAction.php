<?php
/**
 * @category DeleteAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 28/11/2017 21:38
 * @since
 */

namespace application\web\admin\modules\system\controllers\reagent;

use application\models\base\Reagent;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\MessageHelper;

class DeleteAction extends AdminBaseAction
{
    public $method = 'post';

    /**
     * @return string
     */
    public function run()
    {
        $logi = Reagent::findByPk($this->request->post('id'));
        if($logi){
            $logi->delete();
        }
        return MessageHelper::success('删除成功', ['/system/logistics']);
    }
}
