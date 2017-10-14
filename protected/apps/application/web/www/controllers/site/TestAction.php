<?php
/**
 * @category TestAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/6/11 08:14
 * @since
 */

namespace application\web\www\controllers\site;

use application\web\www\components\WwwBaseAction;
use common\core\base\Schema;

/**
 * Class TestAction
 * @package application\web\www\controllers\site
 */
class TestAction extends WwwBaseAction
{
    public $responseType = 'json';

    public function run()
    {
        return Schema::SuccessNotify('success');
    }
}
