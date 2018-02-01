<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 19/11/2017 00:00
 * @since
 */

namespace application\web\admin\modules\survey\controllers\site;

use application\models\base\OrderList;
use application\models\base\SurveyList;
use application\models\base\UserEvent;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\DataProviderHelper;

class IndexAction extends AdminBaseAction
{
    public function run($name = '')
    {
        $query = SurveyList::find();
        if( !$this->userinfo['is_admin'] ){
            $query = $query->leftJoin(UserEvent::tableName(),UserEvent::tableName().'.event_type_uuid='.SurveyList::tableName().'.uuid')
                ->leftJoin(OrderList::tableName(),OrderList::tableName().'.uuid='.UserEvent::tableName().'.order_uuid')
                ->andWhere([OrderList::tableName().'.logistic_id'=>$this->userinfo['logistic_id']]);
        }
        if($name){
            $query = $query->andWhere(['like', 'name', $name]);
        }
        $query->with('events');
        $provider = DataProviderHelper::create($query, 20);
        $provider->setSort(['defaultOrder' => ["id" => SORT_DESC]]);


        return $this->render(compact('provider'));
    }
}
