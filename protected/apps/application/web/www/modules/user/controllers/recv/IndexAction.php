<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 22/11/2017 00:01
 * @since
 */

namespace application\web\www\modules\user\controllers\recv;

use application\models\base\Logistics;
use application\models\base\Reagent;
use application\web\www\components\WwwBaseAction;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

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
        $alllogistics=Logistics::getInstance()->getAllActivateLogistics();
        foreach($alllogistics as $v){
            $logistics[] = [
                'title'=>$v['title'],
                'value'=>$v['id']
            ];
        }
        $logistics = Json::encode($logistics);
        return $this->render(compact('products','model','logistics'));
    }
}
