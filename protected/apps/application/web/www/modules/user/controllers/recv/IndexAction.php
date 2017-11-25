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
use application\models\base\UserAddress;
use application\web\www\components\WwwBaseAction;
use yii\helpers\Json;
use yii\helpers\Url;

class IndexAction extends WwwBaseAction
{
    public function run($use_address = 0, $event_type = '')
    {
        $model = new Reagent();
        $reagents = Reagent::all();
        $products = [];
        foreach($reagents as $reagent){
            $products[$reagent['type']][] = $reagent;
        }
        $alllogistics = Logistics::getInstance()
                                 ->getAllActivateLogistics();
        foreach($alllogistics as $v){
            $logistics[] = [
                'title' => $v['title'],
                'value' => $v['id']
            ];
        }
        $logistics = Json::encode($logistics);
        $hasDefaultAddress = UserAddress::hasDefaultAddress($this->account->uid);
        $address = new UserAddress();
        if($use_address && $hasDefaultAddress){
            $address = UserAddress::getDefaultAddress($this->account->uid);
        }

        $targetUrl = $this->getTargetUrl($event_type);

        return $this->render(compact('products', 'model', 'logistics', 'targetUrl', 'use_address', 'hasDefaultAddress', 'address','event_type'));
    }

    protected function getTargetUrl($type)
    {
        switch($type){
            case "survey":
            default:
                $url = Url::to(['/survey'], true);
                break;
        }
        return $url;
    }
}
