<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 22/11/2017 00:01
 * @since
 */

namespace application\web\www\modules\user\controllers\recv;

use application\models\base\Reagent;
use application\web\www\components\WwwBaseAction;

class IndexAction extends WwwBaseAction
{
    public function run()
    {
        $model = new Reagent();
        $reagents = Reagent::all();
        $products=[];
        foreach($reagents as $reagent){
            $products[$reagent['type']][] = $reagent;
        }
        return $this->render(compact('products','model'));
    }
}
