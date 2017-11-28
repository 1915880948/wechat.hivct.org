<?php

namespace application\models\base;

use application\models\db\TblRelationReagentLogistics;

/**
 * This is the model class for tableClass "TblRelationReagentLogistics".
 * className RelationReagentLogistics
 * @package application\models\base
 */
class RelationReagentLogistics extends TblRelationReagentLogistics
{
    /**
     * @param $reagentId
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getLogisticsByReagentId($reagentId)
    {
        return self::find()
                   ->andWhere(['reagent_id' => $reagentId])
                   ->indexBy('logistics_id')
                   ->asArray()
                   ->all();
    }

    /**
     * @param $reagentId
     * @param $logisticsId
     * @return RelationReagentLogistics
     */
    public static function create($reagentId, $logisticsId)
    {
        $model = new self;
        $model->reagent_id = $reagentId;
        $model->logistics_id = $logisticsId;
        $model->save();
        return $model;
    }
}
