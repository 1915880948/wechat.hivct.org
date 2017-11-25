<?php
/**
 * @category SelfCheckingFollowupAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/10/16 09:07
 * @since
 */

namespace application\web\www\controllers\survey;

use application\models\base\SurveyList;
use application\web\www\components\suvey\SurveyTrait;
use application\web\www\components\WwwBaseAction;

class SelfCheckingFollowupAction extends WwwBaseAction
{
    use SurveyTrait;

    /**
     * @param $eventId
     * @param $step
     * @return string
     */
    public function run($eventId, $step)
    {
        $survey = $this->getSurvey($eventId);
        $step = $survey->getStepByName($this->id);
        $surveyUrl = $this->getSurveyUrl($eventId, $step);

        return $this->render(compact('model', 'survey', 'surveyUrl'));
    }
}
