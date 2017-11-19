<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 19/11/2017 00:00
 * @since
 */

namespace application\web\admin\modules\survey\controllers\site;

use application\common\db\ApplicationSearchActiveRecord;
use application\models\base\SurveyList;
use application\web\admin\components\AdminBaseAction;

class IndexAction extends AdminBaseAction
{
    public function run($district = null)
    {
        $search = new ApplicationSearchActiveRecord();
        $search->setModel(new SurveyList());
        $provider = $search->search([['district' => $district]]);

        return $this->render(compact('provider'));
    }
}
