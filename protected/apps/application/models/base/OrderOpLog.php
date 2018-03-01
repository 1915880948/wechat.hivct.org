<?php

namespace application\models\base;

use application\models\db\TblOrderOpLog;

/**
 * This is the model class for tableClass "TblOrderOpLog".
 * className OrderOpLog
 * @package application\models\base
 */
class OrderOpLog extends TblOrderOpLog
{
    /**
     * @param $userId
     * @param $orderUuid
     * @param $statusOrigin
     * @param $statusNew
     */
    public static function addLog($userId, $orderUuid, $statusOrigin, $statusNew)
    {
        $m = new self();
        $m->user_id = $userId;
        $m->order_uuid = $orderUuid;
        $m->status_origin = $statusOrigin;
        $m->status_new = $statusNew;
        $m->save();
    }
}
