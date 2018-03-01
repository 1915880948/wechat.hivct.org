<?php

namespace application\models\base;

use application\models\db\TblAdmins;

/**
 * This is the model class for tableClass "TblAdmins".
 * className Admins
 * @package application\models\base
 */
class Admins extends TblAdmins
{
    public static function getAll()
    {
        return self::find()
                   ->asArray()
                   ->all();
    }

    public function isSuperAdmin()
    {
        return $this->is_super > 0;
    }
}
