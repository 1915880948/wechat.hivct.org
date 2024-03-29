<?php
/**
 * @category QActiveRecord
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 16/1/12 14:54
 * @since
 */

namespace common\core\db\base;

use yii\db\ActiveRecord;

/**
 * Class QActiveRecord
 * @package common\core\db\base
 */
class QActiveRecord extends ActiveRecord
{
    public static function findByPk($id)
    {
        $primaryKeys = self::primaryKey();
        $primaryKey = "";
        if($primaryKeys){
            $primaryKey = $primaryKeys[0];
        }

        return static::findOne([$primaryKey => $id]);
    }

    /**
     * @param $uuid
     * @return array|QActiveRecord|null|ActiveRecord|static
     */
    public static function findByUuid($uuid)
    {
        return static::find()
                     ->andWhere(['uuid' => $uuid])
                     ->one();
    }

    /**
     * @param $uuid
     * @param $field
     * @return array|ActiveRecord[]
     */
    public static function findAllByUUID($uuid, $field)
    {
        return static::find()
                     ->andWhere([$field => $uuid])
                     ->asArray()
                     ->all();
    }

    /**
     * 这里,如果需要记录更新时间和更新人,应该加上
     * @return array
     */
    public function behaviors()
    {
        return [];
    }

    public static function findOne($condition)
    {
        return static::findByCondition($condition)
                     ->limit(1)
                     ->one();
    }
}
