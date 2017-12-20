<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 21/11/2017 23:01
 * @since
 */

namespace application\web\admin\modules\order\controllers\site;

use application\models\base\OrderList;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\DataProviderHelper;
use qiqi\traits\Render;

class IndexAction extends AdminBaseAction
{
    public function run(){
        $query = OrderList::find();
        $provider = DataProviderHelper::create($query,3);

        return $this->render(compact('provider'));
    }
//    use Render;
}
