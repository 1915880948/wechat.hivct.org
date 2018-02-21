<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/9/3 23:36
 * @since
 */

namespace application\web\admin\modules\virtual\controllers\defaults;

use application\web\admin\components\AdminBaseAction;

class IndexAction extends AdminBaseAction
{
    public function run()
    {
        var_dump(\Yii::$app->getUser()
                           ->getId());
    }
}
