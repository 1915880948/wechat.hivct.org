<?php
namespace application\web\admin\modules\order\controllers\site;

use application\models\base\Express;
use application\models\base\Logistics;
use application\models\base\OrderDetail;
use application\models\base\OrderList;
use application\models\base\OrderMemoLog;
use application\models\base\SurveyList;
use application\models\base\User;
use application\models\base\UserAddress;
use application\models\base\UserEvent;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\DataProviderHelper;

class DetailAction extends AdminBaseAction{
    public function run( $uuid,$uid ){
        $express = Express::find()->andWhere(['status'=>1])->asArray()->all();
        $query = OrderDetail::find()
                    ->andWhere(['order_uuid'=>$uuid]);
        $provider = DataProviderHelper::create( $query );
        $memoQuery = OrderMemoLog::find()
            ->andWhere(['order_uuid'=>$uuid])
            ->orderBy(['id'=>SORT_DESC]);
        $memoProvider = DataProviderHelper::create( $memoQuery );
        $order_data = OrderList::find()
                    ->andWhere(['uuid'=>$uuid])
                    ->one();
        $userdata = User::find()->andWhere(['uid'=>$uid])->asArray()->one();
        $ship = array_column($express,'name','id');

        $logisticsInfo = $address = [];
        if($order_data['logistic_id']>0){
            $logisticsInfo = Logistics::getLogisitcsInfo($order_data['logistic_id']);
        }
        if($order_data['address_uuid']){
            $address = UserAddress::getAddressInfo($order_data['address_uuid']);
        }
        $eventInfo = UserEvent::find()->andWhere(['order_uuid'=>$uuid])->one();
        $survey = [];
        if($eventInfo && $eventInfo->event_type == 'survey'){
            $survey = SurveyList::findByUuid($eventInfo->event_type_uuid);
        }

        return $this->render(compact('ship','userdata','provider','memoProvider','order_data','logisticsInfo','address','survey'));
    }
}
