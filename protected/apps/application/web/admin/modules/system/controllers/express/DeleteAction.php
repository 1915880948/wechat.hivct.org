<?php
/**
 * @category DeleteAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 28/11/2017 16:35
 * @since
 */

namespace application\web\admin\modules\system\controllers\express;

use application\models\base\Express;
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
        $logi = Express::findByPk($this->request->post('id'));
        if($logi){
            $logi->delete();
        }
        return MessageHelper::success('删除成功', ['/system/express']);
    }
}
