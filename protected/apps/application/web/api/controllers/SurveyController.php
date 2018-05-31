<?php
/**
 * @category SurveyController
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2018/5/14 22:27
 * @since
 */

namespace application\web\api\controllers;

use application\web\api\components\ApiBaseController;
use qiqi\core\base\controller\ActionsTrait;

class SurveyController extends ApiBaseController
{
    use ActionsTrait;
    public $enableCsrfValidation = false;
}
