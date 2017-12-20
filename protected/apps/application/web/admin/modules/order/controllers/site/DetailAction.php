<?php
namespace application\web\admin\modules\order\controllers\site;

use application\models\base\OrderDetail;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\DataProviderHelper;

class DetailAction extends AdminBaseAction{
    public function run( $uuid ){
        $query = OrderDetail::find()
                    ->andWhere(['order_uuid'=>$uuid]);
        $provider = DataProviderHelper::create( $query );

        return $this->render(compact('provider'));
    }
}