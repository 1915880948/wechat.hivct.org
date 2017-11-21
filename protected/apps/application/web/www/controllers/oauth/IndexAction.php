<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 20/11/2017 19:28
 * @since
 */

namespace application\web\www\controllers\oauth;

use application\web\www\components\WwwBaseAction;
use yii\helpers\Url;

class IndexAction extends WwwBaseAction
{
    public function run()
    {
        if(\Yii::$app->getUser()
                     ->getIsGuest()){
            return $this->controller->redirect("http://hivct.open.nisinfo.com/oauth/redirect?url=" . Url::to(['/oauth/code'], true));
        }
        return $this->controller->redirect(['/site/index']);
    }
}
