<?php
/**
 * @category SurveyTrait
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 26/11/2017 00:18
 * @since
 */

namespace application\web\www\components\suvey;

use application\models\base\SurveyList;
use application\models\base\UserEvent;
use yii\helpers\Url;

trait SurveyTrait
{
    /**
     * @param $eventId
     * @return SurveyList|array|\common\core\db\base\QActiveRecord|null|\yii\db\ActiveRecord
     */
    public function getSurvey($eventId)
    {
        $userId = $this->account->uid;
        $userEvent = UserEvent::findByUuid($eventId);
        if($userEvent['uid'] != $userId){//不是自己的主题
            return $this->controller->redirect(['/site/error', 'msg' => '对不起。该调研不是您自己的']);
        }
        $survey = null;
        if($userEvent['event_type'] != ''){
            if($userEvent['event_type'] != 'survey'){
                return $this->controller->redirect(['/site/error', 'msg' => '对不起，本次活动的类型不是调研']);
            }
            $survey = SurveyList::findByUuid($userEvent['event_type_uuid']);
        }
        if(!$survey){
            $survey = new SurveyList();
        }
        return $survey;
    }

    public function getSurveyUrl($eventId, $step)
    {
        $survey = SurveyList::getInstance();
        $maxStep = max(array_keys($survey->getStepNames()));
        $nextUrl = $survey->getStepUrl($step + 1, $eventId);
        // echo $survey->getStepName($step);
        if($step == $maxStep){//最后一关了
            $nextUrl = ['/user/recv/pay', 'eventId' => $eventId];
        }

        return [
            'current' => Url::current(),
            'next'    => $nextUrl,
            'post'    => ['/survey/save', 'type' => $survey->getStepName($step)]
        ];
    }
}
