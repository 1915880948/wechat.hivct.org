<?php

namespace application\models\base;

use application\models\db\TblUserAddress;

/**
 * This is the model class for tableClass "TblUserAddress".
 * className UserAddress
 * @package application\models\base
 */
class UserAddress extends TblUserAddress
{
    /**
     * @param $userId
     * @return UserAddress|array|null|\yii\db\ActiveRecord
     */
    public static function getDefaultAddress($userId)
    {
        return self::find()
                   ->andWhere(['uid' => $userId])
                   ->andWhere(['is_default' => 1])
                   ->one();
    }

    /**
     * @param $userId
     * @return int|string
     */
    public static function hasDefaultAddress($userId)
    {
        return self::find()
                   ->andWhere(['uid' => $userId])
                   ->andWhere(['is_default' => 1])
                   ->count();
    }

    public static function removeDefaultAddress($userId, $addressUuid)
    {
        return self::updateAll(['is_default' => 0], [
            'and',
            ['uid' => $userId],
            ['!=', 'uuid', $addressUuid]
        ]);
    }

    /**
     * @param $addressUuid
     * @return array|\common\core\db\base\QActiveRecord|null|\yii\db\ActiveRecord|static
     */
    public static function getAddressInfo($addressUuid)
    {
        return self::findByUuid($addressUuid);
    }
}
