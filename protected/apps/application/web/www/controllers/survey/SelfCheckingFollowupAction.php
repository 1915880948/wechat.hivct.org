<?php
/**
 * @category SelfCheckingFollowupAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/10/16 09:07
 * @since
 */

namespace application\web\www\controllers\survey;

use application\models\base\SurveyList;
use application\web\www\components\WwwBaseAction;

class SelfCheckingFollowupAction extends WwwBaseAction
{
    /**
     * @param int $id
     * @return string
     */
    public function run($id = 0)
    {
        if(!$model = SurveyList::findByPk($id)){
            $model = new SurveyList();
        }
        return $this->render(compact('model'));
    }
}
