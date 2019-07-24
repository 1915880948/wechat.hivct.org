<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/8/14 02:34
 * @since
 */

namespace application\web\www\controllers\survey;

use application\models\base\SurveyList;
use application\web\www\components\WwwBaseAction;

/**
 * 调研
 * Class IndexAction
 * @package application\web\www\controllers\survey
 */
class IndexAction extends WwwBaseAction
{
    public function run($eventId, $step = 0)
    {
        if(!$eventId){
            $this->controller->redirect(['/user/recv', 'type' => 'survey']);
        }

        $stepUrls = SurveyList::getInstance()->getStepUrl($step,$eventId);

        return $this->controller->redirect('http://v2.survey.hivct.com');
        return $this->controller->redirect($stepUrls);
    }
}
