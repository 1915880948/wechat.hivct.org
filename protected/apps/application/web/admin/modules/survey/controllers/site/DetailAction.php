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
use qiqi\helper\DataProviderHelper;

class DetailAction extends AdminBaseAction
{
    public function run($uuid)
    {
        $express = Express::find()->andWhere(['status'=>1])->asArray()->all();
        $data = SurveyList::find()->andWhere(['uuid'=>$uuid])->asArray()->one();
        $order_data = OrderList::find()
            ->from(OrderList::tableName().' as ol')
            ->leftJoin(UserEvent::tableName().' as ue','ol.source_uuid=ue.uuid')
            ->leftJoin(SurveyList::tableName().' as sl','ue.event_type_uuid=sl.uuid')
            ->andWhere(['sl.uuid'=>$uuid])
            ->asArray()
            ->one();
        $ship = array_column($express,'name','id');
//print_r( $order_data );die;
        return $this->render(compact('ship','data','order_data'));
    }
}
