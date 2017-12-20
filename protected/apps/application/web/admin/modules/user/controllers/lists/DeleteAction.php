<?php
/**
 * @category DeleteAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 28/11/2017 21:38
 * @since
 */

namespace application\web\admin\modules\user\controllers\lists;

use application\models\base\User;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\MessageHelper;

class DeleteAction extends AdminBaseAction
{
    public $method = 'post';

    public function run()
    {
        $logi = User::findByPk($this->request->post('id'));
        if($logi){
            $logi->delete();
        }
        return MessageHelper::success('删除成功', ['/user/lists']);
    }
}