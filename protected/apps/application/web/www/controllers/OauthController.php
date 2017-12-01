<?php
/**
 * @category OauthController
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/8/14 02:15
 * @since
 */

namespace application\web\www\controllers;

use common\core\base\BaseController;
use common\core\base\controller\ActionsTrait;

class OauthController extends BaseController
{
    use ActionsTrait;
    public $enableCsrfValidation=false;
}
