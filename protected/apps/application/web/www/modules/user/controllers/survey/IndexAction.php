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

/**
 * 我的调研列表
 * Class IndexAction
 * @package application\web\www\modules\user\controllers\survey
 */
class IndexAction extends WwwBaseAction
{
    public function run()
    {
        $provider = SurveyList::getInstance()->search();

        return $this->render(compact('provider'));
    }
}
