<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/8/14 02:34
 * @since
 */

namespace application\web\www\controllers\survey;

use application\web\www\components\WwwBaseAction;

/**
 * 调研
 * Class IndexAction
 * @package application\web\www\controllers\survey
 */
class IndexAction extends WwwBaseAction
{
    public function run($step = 0)
    {
        // $file = "survey_index_{$step}";
        //
        // return $this->renderPage($file);

        return $this->controller->redirect(['/survey/selfcheckingbase']);
    }
}
