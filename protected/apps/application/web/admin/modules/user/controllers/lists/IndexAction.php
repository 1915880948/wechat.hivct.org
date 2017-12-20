<?php
namespace application\web\admin\modules\user\controllers\lists;

use application\models\base\User;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\DataProviderHelper;

class IndexAction extends AdminBaseAction{
    public function run()
    {
        $query = User::find()
            ->orderBy(['created_at'=>SORT_DESC]);
        $provider = DataProviderHelper::create($query,1);

        return $this->render(compact('provider'));
    }
}