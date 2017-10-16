<?php
/**
 * @category QGroup
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/10/15 09:09
 * @since
 */

namespace common\core\db\base;

trait QGroup
{
    /**
     * 有点象indexBy，但不是
     * @param $models
     * @param $field
     * @return array
     */
    public function group($models, $field)
    {
        $result = [];
        foreach($models as $model){
            $result[$field][] = $model;
        }
        return $result;
    }
}
