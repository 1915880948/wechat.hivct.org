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
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\DataProviderHelper;

class DetailAction extends AdminBaseAction
{
    public function run($uuid)
    {
        $data = SurveyList::find()->andWhere(['uuid'=>$uuid])->asArray()->one();
        $order_data = OrderList::find()->andWhere(['uuid'=>$uuid])->asArray()->one();
        return $this->render(compact('data','order_data'));
    }
}
