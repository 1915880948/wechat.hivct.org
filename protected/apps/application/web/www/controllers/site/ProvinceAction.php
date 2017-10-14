<?php
/**
 * @category ProvinceAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/8/20 13:58
 * @since
 */

namespace application\web\www\controllers\site;

use application\web\www\components\WwwBaseAction;
use qiqi\helper\geo\ProvinceHelper;

class ProvinceAction extends WwwBaseAction
{
    public function run()
    {
        return ProvinceHelper::createRegionJs();
    }
}
