<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%relation_reagent_logistics}}".
 *
 * @property integer $id
 * @property string $uuid
 * @property integer $reagent_id
 * @property integer $logistics_id
 */
class TblRelationReagentLogistics extends \application\common\db\ApplicationActiveRecord
{
     const ID = 'id';
     const UUID = 'uuid';
     const REAGENT_ID = 'reagent_id';
     const LOGISTICS_ID = 'logistics_id';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%relation_reagent_logistics}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reagent_id', 'logistics_id'], 'required'],
            [['reagent_id', 'logistics_id'], 'integer'],
            [['uuid'], 'string', 'max' => 36],
            [['uuid'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'Uuid',
            'reagent_id' => 'Reagent ID',
            'logistics_id' => 'Logistics ID',
        ];
    }
}
