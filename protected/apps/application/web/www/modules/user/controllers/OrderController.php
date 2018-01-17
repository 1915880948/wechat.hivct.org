<?php
namespace application\web\www\modules\user\controllers;
use application\web\www\modules\user\components\UserBaseController;
use common\core\base\controller\ActionKeywordsTrait;

class OrderController extends UserBaseController
{
    public $enableCsrfValidation = false;
    use ActionKeywordsTrait;
}