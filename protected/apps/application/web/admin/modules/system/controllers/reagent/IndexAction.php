<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 21/11/2017 14:50
 * @since
 */

namespace application\web\admin\modules\system\controllers\reagent;

use application\models\base\Reagent;
use application\web\admin\components\AdminBaseAction;
use qiqi\core\db\base\QSearchInstance;

class IndexAction extends AdminBaseAction
{
    public function run()
    {
        $reagents = Reagent::getInstance();

        return $this->render(compact('reagents'));
    }
}
