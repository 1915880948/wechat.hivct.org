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
use qiqi\helper\MessageHelper;

class IndexAction extends AdminBaseAction
{
    public function run($name = '')
    {
        if( !$this->userinfo['is_admin'] ){
            return MessageHelper::success('对不起，您没有权限！');
        }

        if($name){
            $query = SurveyList::find()
                               ->andWhere(['like', 'name', $name]);
        } else{
            $query = SurveyList::find();
        }
        $query->with('events');
        $provider = DataProviderHelper::create($query, 20);
        $provider->setSort(['defaultOrder' => ["id" => SORT_DESC]]);


        return $this->render(compact('provider'));
    }
}
