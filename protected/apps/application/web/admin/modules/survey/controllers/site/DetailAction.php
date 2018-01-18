<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 19/11/2017 00:00
 * @since
 */

namespace application\web\admin\modules\survey\controllers\site;

use application\models\base\Express;
use application\models\base\OrderList;
use application\models\base\SurveyList;
use application\models\base\UserEvent;
use application\web\admin\components\AdminBaseAction;

class DetailAction extends AdminBaseAction
{
    public function run($uuid)
    {
        $express = Express::find()->andWhere(['status'=>1])->asArray()->all();
        $data = SurveyList::find()->andWhere(['uuid'=>$uuid])->asArray()->one();



        $order_data = OrderList::find()
            ->from(OrderList::tableName().' as ol')
            ->leftJoin(SurveyList::tableName().' as sl','ol.source_uuid=sl.uuid')
            ->andWhere(['sl.uuid'=>$uuid])
            ->asArray()
            ->one();
        $eventInfo = UserEvent::find()
                              ->andWhere(['event_type' => 'survey'])
                              ->andWhere(['event_type_uuid' => $uuid])
                              ->one();
        if($eventInfo && $order_data){
            if(!$eventInfo['order_uuid'] && $order_data['uuid']){
                $eventInfo['order_uuid'] = $order_data['uuid'];
                $eventInfo['order_is_paid'] = $order_data['pay_status'];
                $eventInfo->save();
            }
        }

        $ship = array_column($express,'name','id');
        return $this->render(compact('ship','data','order_data'));
    }
}
