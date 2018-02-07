<?php

namespace application\web\admin\modules\user\controllers\lists;

use application\models\base\User;
use application\models\base\UserAddress;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\DataProviderHelper;

class DetailAction extends AdminBaseAction
{
    public function run($uid)
    {
        $data = User::find()
            ->andWhere(['uid'=>$uid])
            ->asArray()
            ->one();
        $query = UserAddress::find()
            ->andWhere(['uid'=>$uid]);
        $provider = DataProviderHelper::create($query);
        return $this->render(compact('data','provider'));
    }
}