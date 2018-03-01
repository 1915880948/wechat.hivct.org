<?php

namespace application\models\base;

use application\models\db\TblOrderOpLog;
use yii\db\ActiveRecord;

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

    /**
     * @param $uuid
     * @param $field
     * @return array|ActiveRecord[]
     */
    public static function findAllByUUID($uuid, $field)
    {
        return static::find()
                     ->orderBy(['created_at' => SORT_DESC])
                     ->andWhere([$field => $uuid])
                     ->asArray()
                     ->all();
    }
}
