<?php

namespace application\models\base;

use application\models\db\TblReagent;
use qiqi\core\db\base\QSearchInstance;

/**
 * This is the model class for tableClass "TblReagent".
 * className Reagent
 * @package application\models\base
 */
class Reagent extends TblReagent
{
    use QSearchInstance;
    const TYPE_FREE = 'free';
    const TYPE_GIFT = 'gift';
    const TYPE_CHARGE = 'charge';

    /**
     * 返回所有的ReAgent
     * @return array|\yii\db\ActiveRecord[]|Reagent[]
     */
    public static function getFrontAll()
    {
        return self::find()
                   ->andWhere(['status' => 1])
                   ->all();
    }

    public static function all()
    {
        return self::find()
                   ->all();
    }
}
