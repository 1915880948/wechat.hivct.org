<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 19/11/2017 00:00
 * @since
 */

namespace application\web\admin\modules\survey\controllers\site;

use application\models\base\SurveyList;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\DataProviderHelper;

class IndexAction extends AdminBaseAction
{
    public function run()
    {
        $model = new SurveyList();
        $query = $model::find();
//            ->orderBy(['created_at'=>SORT_DESC]);
        $provider = DataProviderHelper::create($query,5);

        return $this->render(compact('model','provider'));
    }
}
