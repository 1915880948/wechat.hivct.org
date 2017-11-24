<?php
/**
 * @category SelfCheckingBaseAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/10/15 08:22
 * @since
 */

namespace application\web\www\controllers\survey;

use application\models\base\SurveyList;
use application\web\www\components\WwwBaseAction;

class SelfCheckingBaseAction extends WwwBaseAction
{
    /**
     * 简单的表单
     * @param int $id
     * @return string
     */
    public function run($id = 0)
    {
        if(!$model = SurveyList::findByPk($id)){
            $model = new SurveyList();
        }
        $userId = \Yii::$app->getUser()->identity->getId();

        $survey = $model->getSurveyByUserId( $userId );
//        print_r( ($survey) ); exit;
        return $this->render(compact('model','survey'));
    }
}
