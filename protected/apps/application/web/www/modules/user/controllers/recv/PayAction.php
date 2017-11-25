<?php
/**
 * @category PayAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 26/11/2017 01:05
 * @since
 */

namespace application\web\www\modules\user\controllers\recv;

use application\models\base\UserEvent;
use application\web\www\components\WwwBaseAction;
use yii\helpers\Json;

class PayAction extends WwwBaseAction
{
    /**
     * 对eventId进行支付
     * @param $eventId
     */
    public function run($eventId)
    {
        $eventInfo = UserEvent::findByUuid($eventId);
        if(!$eventInfo){
            echo 111;
        }
        $products = Json::decode($eventInfo->order_temporary);
        echo "<pre>";
        print_r($products);
        echo "</pre>";
    }
}
