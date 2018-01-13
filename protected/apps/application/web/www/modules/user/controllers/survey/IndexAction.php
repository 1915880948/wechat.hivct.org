<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 25/11/2017 15:18
 * @since
 */

namespace application\web\www\modules\user\controllers\survey;

use application\models\base\SurveyList;
use application\models\base\UserEvent;
use application\web\www\components\WwwBaseAction;

/**
 * 我的调研列表
 * Class IndexAction
 * @package application\web\www\modules\user\controllers\survey
 */
class IndexAction extends WwwBaseAction
{
    public $select = "  survey.uuid,
                        survey.name,
                        survey.create_time,
                        event.event_type_uuid,
                        event.event_type_step_total,
                        event.event_type_step_current";
    public function run()
    {
        $provider = SurveyList::find()
            ->select( $this->select )
            ->from( SurveyList::tableName().' as survey ')
            ->innerJoin(UserEvent::tableName().' as event ','survey.uuid=event.event_type_uuid')
            ->andWhere(['survey.uid'=>$this->account['uid']])
            ->orderBy(['survey.id'=>SORT_DESC])
            ->asArray()
            ->all();

        return $this->render(compact('provider'));
    }
}
