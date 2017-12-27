<?php
/**
 * @category DeleteAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 28/11/2017 21:38
 * @since
 */

namespace application\web\admin\modules\user\controllers\lists;

use application\models\base\UserAddress;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\DataProviderHelper;

class AddressAction extends AdminBaseAction
{
    public function run($uid)
    {
        $query = UserAddress::find()
            ->andWhere(['uid'=>$uid]);
        $provider = DataProviderHelper::create($query);
        return $this->render(compact('provider'));
    }
}