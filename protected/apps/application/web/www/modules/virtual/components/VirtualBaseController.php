<?php
/**
 * @category VirtualBaseController
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/9/3 23:35
 * @since
 */

namespace application\web\admin\modules\virtual\components;

use application\models\service\AccountService;
use application\web\admin\components\AdminBaseController;
use common\core\session\GSession;
use qiqi\helper\CookieHelper;

class VirtualBaseController extends AdminBaseController
{
    public function init()
    {
        if(1 == \Yii::$app->getUser()->getIdentity()->getId() ){
            GSession::set('user',\Yii::$app->getUser()->getIdentity());
        }
        $u = GSession::get('user');
        echo "<pre>";
        print_r($u);
        echo "</pre>";

        parent::init();
    }
}
