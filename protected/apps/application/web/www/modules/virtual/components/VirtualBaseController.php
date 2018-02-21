<?php
/**
 * @category VirtualBaseController
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/9/3 23:35
 * @since
 */

namespace application\web\www\modules\virtual\components;

use application\models\service\AccountService;
use application\web\admin\components\AdminBaseController;
use common\core\session\GSession;
use yii\web\HttpException;

class VirtualBaseController extends AdminBaseController
{
    public function init()
    {
        if(1 == \Yii::$app->getUser()
                          ->getIdentity()
                          ->getId()){
            GSession::set('user', \Yii::$app->getUser()
                                            ->getIdentity());
        }
        $u = GSession::get('user');
        if(!$u || 1 != $u['uid']){
            throw new HttpException(403, '无权限');
        }

        parent::init();
    }
}
