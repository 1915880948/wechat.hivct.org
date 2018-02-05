<?php
namespace application\web\admin\modules\upcheck\controllers;
use application\web\admin\modules\upcheck\components\UpCheckBaseController;
use common\core\base\controller\ActionsTrait;

class SiteController extends UpCheckBaseController {
    public $enableCsrfValidation = false;
    use ActionsTrait;

}