<?php
/**
 * @category SelfCheckingDrugAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/10/16 00:40
 * @since
 */

namespace application\web\www\controllers\survey;

use application\web\www\components\suvey\SurveyTrait;
use application\web\www\components\WwwBaseAction;
use yii\helpers\Url;

class SelfCheckingDrugAction extends WwwBaseAction
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

        // return $this->controller->redirect(Url::to($surveyUrl['next']));
        return $this->render(compact('model', 'survey', 'surveyUrl'));
    }
}
