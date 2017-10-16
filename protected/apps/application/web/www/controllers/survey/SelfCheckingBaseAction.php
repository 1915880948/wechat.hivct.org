<?php
/**
 * @category SelfCheckingBaseAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/10/15 08:22
 * @since
 */

namespace application\web\www\controllers\survey;

use application\web\www\components\WwwBaseAction;

class SelfCheckingBaseAction extends WwwBaseAction
{
    /**
     * 简单的表单
     * @return string
     */
    public function run()
    {
        return $this->render([]);
    }
}
