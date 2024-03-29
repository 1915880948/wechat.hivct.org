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
use application\models\base\RelationReagentLogistics;
use application\models\base\SurveyList;
use application\models\base\UserAddress;
use application\models\base\UserEvent;
use application\web\www\components\WwwBaseAction;
use yii\helpers\Json;
use yii\helpers\Url;

class IndexAction extends WwwBaseAction
{
    /**
     * 每个人一个月只能申请一次，通过微信和手机号判断，只要微信或手机其中一个申请过，就只能一个月后再申请。
     *
     * @param int    $use_address
     * @param string $event_type
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function run($use_address = 0, $event_type = '')
    {
        return $this->controller->redirect('http://v2.survey.hivct.com');
        $survey = (new UserEvent)->getUserLastMonthSurvey($this->account['id']);


        /**
         * check is applied
         */

        $model = new Reagent();
        $reagents = Reagent::all();
        $products = [];
        foreach($reagents as $reagent){
            $products[$reagent['type']][] = $reagent;
        }
        $relations = RelationReagentLogistics::find()->all();
        $rel = [];
        foreach($relations as $relation){
            $rel[$relation['reagent_id']][] = $relation['logistics_id'];
        }
        $alllogistics = Logistics::getInstance()
                                 ->getAllActivateLogistics();
        $logistics = [];
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

        return $this->render(compact('products', 'model', 'logistics', 'targetUrl', 'use_address', 'hasDefaultAddress', 'address','event_type','rel','survey'));
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
