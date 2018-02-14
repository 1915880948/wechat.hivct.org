<?php

namespace application\web\admin\modules\upcheck\controllers\site;

use application\models\base\UpCheckResult;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\DataProviderHelper;

class IndexAction extends AdminBaseAction
{
    public function run($name = '', $phone = '', $email = '')
    {

        $query = UpCheckResult::find();
        if($name){
            $query = $query->andWhere(['like', 'name', $name]);
        }
        if($phone){
            $query = $query->andWhere(['like', 'phone', $phone]);
        }
        if($email){
            $query = $query->andWhere(['like', 'email', $email]);
        }
        $provider = DataProviderHelper::create($query, 20);
        $provider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);

        return $this->render(compact('provider'));
    }
}
