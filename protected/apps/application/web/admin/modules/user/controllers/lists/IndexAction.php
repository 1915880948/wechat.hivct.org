<?php
namespace application\web\admin\modules\user\controllers\lists;

use application\models\base\User;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\DataProviderHelper;

class IndexAction extends AdminBaseAction{
    public function run($realname='')
    {
        if( $realname ){
            $query = User::find()->andWhere(['or',
                ['like','realname',$realname],
                ['like','nickname',$realname]]);
        }else {
            $query = User::find();
        }
//        $sql = $query->createCommand()->getRawSql();
//        print_r( $sql );    die;
        $provider = DataProviderHelper::create($query);
        $provider->setSort(['defaultOrder'=>['uid'=>SORT_DESC]]);
        return $this->render(compact('provider'));
    }
}