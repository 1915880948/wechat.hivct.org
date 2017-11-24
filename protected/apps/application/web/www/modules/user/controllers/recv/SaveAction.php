<?php
/**
 * @category SaveAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 24/11/2017 19:01
 * @since
 */

namespace application\web\www\modules\user\controllers\recv;

use application\web\www\components\WwwBaseAction;
use common\core\base\Schema;

class SaveAction extends WwwBaseAction
{
    public $method = 'post';
    public $responseType = 'json';

    public function run()
    {
        $post = $this->request->post();



        return Schema::FailureNotify('添加失败', ['items' => '姿势 不对']);
    }
}
