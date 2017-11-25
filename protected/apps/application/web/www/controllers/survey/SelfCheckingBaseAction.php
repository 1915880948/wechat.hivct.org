<?php
/**
 * @category SelfCheckingBaseAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/10/15 08:22
 * @since
 */

namespace application\web\www\controllers\survey;

use application\web\www\components\suvey\SurveyTrait;
use application\web\www\components\WwwBaseAction;

class SelfCheckingBaseAction extends WwwBaseAction
{
    use SurveyTrait;

    /**
     * 简单的表单
     * @param     $eventId
     * @return string
     */
    public function run($eventId)
    {
        $survey = $this->getSurvey($eventId);
        $step = $survey->getStepByName($this->id);
        $surveyUrl = $this->getSurveyUrl($eventId, $step);

        return $this->render(compact('model', 'survey', 'surveyUrl'));
    }
}
