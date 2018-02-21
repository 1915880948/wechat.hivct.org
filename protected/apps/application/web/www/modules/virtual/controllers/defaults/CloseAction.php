<?php
/**
 * @category CloseAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 21/02/2018 11:53
 * @since
 */

namespace application\web\www\modules\virtual\controllers\defaults;

use application\web\www\components\WwwBaseAction;
use application\web\www\WwwUser;
use common\core\session\GSession;

class CloseAction extends WwwBaseAction
{
    public function run()
    {
        GSession::set('debug',false);
        \Yii::$app->getUser()->login(WwwUser::findByPk(1));
        $this->controller->redirect(['/site/index']);
    }
}
