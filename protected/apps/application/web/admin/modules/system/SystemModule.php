<?php
/**
 * @category UserModule
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/10/28 09:27
 * @since
 */

namespace application\web\admin\modules\system;

use application\web\admin\AdminUser;
use yii\base\Module;

class SystemModule extends Module
{
    public function init()
    {
        /** @var AdminUser $user */
        $user = \Yii::$app->getUser()
                          ->getIdentity();
        if(!$user->isSuperAdmin()){
            return \Yii::$app->createControllerByID('defaults')
                             ->redirect(['/site/index']);
        }
        parent::init();
    }
}
