<?php
/**
 * @category SiteController
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 21/11/2017 23:00
 * @since
 */

namespace application\web\admin\modules\order\controllers;

use application\web\admin\modules\order\components\OrderBaseController;
use common\core\base\controller\ActionsTrait;

class SiteController extends OrderBaseController
{
    public $enableCsrfValidation = false;
    use ActionsTrait;
}
