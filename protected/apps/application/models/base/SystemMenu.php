<?php

namespace application\models\base;

use application\models\db\TblSystemMenu;

/**
 * This is the model class for tableClass "TblSystemMenu".
 * className SystemMenu
 * @package application\models\base
 */
class SystemMenu extends TblSystemMenu
{
    /**
     * @param array $select
     * @return SystemMenu[]|array|\yii\db\ActiveRecord[]
     */
    public static function getFirstMenu($select = [])
    {
        $query = self::find()
                     ->andFilterWhere(['pid' => 0])
                     ->asArray();
        if($select){
            $query->select($select);
        }

        return $query->all();
    }
}
