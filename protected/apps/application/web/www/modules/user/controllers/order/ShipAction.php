<?php
/**
 * @category ShipAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 14/01/2018 10:36
 * @since
 */

namespace application\web\www\modules\user\controllers\order;

use application\web\www\components\WwwBaseAction;

class ShipAction extends WwwBaseAction
{
    public function run()
    {
        $userId = $this->account['id'];


        return $this->render();
    }
}
