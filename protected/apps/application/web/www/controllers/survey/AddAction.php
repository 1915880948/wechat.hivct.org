<?php
/**
 * @category AddAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/10/22 21:19
 * @since
 */

namespace application\web\www\controllers\survey;

use application\web\www\components\WwwBaseAction;

class AddAction extends WwwBaseAction
{
    /**
     * 进这个页页，代表是一定要填表的
     * @return \yii\web\Response
     */
    public function run()
    {
        return $this->controller->redirect(['/survey/selfcheckingbase']);
    }
}
