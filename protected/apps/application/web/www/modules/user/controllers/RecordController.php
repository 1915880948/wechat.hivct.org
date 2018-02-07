<?php
namespace application\web\www\modules\user\controllers;
use application\web\www\modules\user\components\UserBaseController;
use common\core\base\controller\ActionsTrait;

class RecordController extends UserBaseController{
    public $enableCsrfValidation = false;
    use ActionsTrait;
}
