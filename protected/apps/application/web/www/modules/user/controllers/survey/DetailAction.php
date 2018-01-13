<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 25/11/2017 15:18
 * @since
 */

namespace application\web\www\modules\user\controllers\survey;

use application\models\base\SurveyList;
use application\web\www\components\WwwBaseAction;
use qiqi\helper\MessageHelper;

class DetailAction extends WwwBaseAction
{
    public function run($uuid)
    {
        $data = SurveyList::find()
            ->andWhere(['uuid'=>$uuid])
            ->asArray()
            ->one();
        if(!$uuid){
            return MessageHelper::error('参数错误！');
        }
        return $this->render(compact('data'));
    }
}
