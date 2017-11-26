<?php
/**
 * @category LogoutAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 26/11/2017 10:46
 * @since
 */

namespace application\web\www\controllers\site;

use application\web\www\components\WwwBaseAction;

class LogoutAction extends WwwBaseAction
{
    public function run()
    {
        $d= \Yii::$app->getUser()->logout();
        dd($d);
        return $this->controller->redirect(['/site/index']);
    }
}
