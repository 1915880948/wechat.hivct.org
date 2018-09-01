<?php
/**
 * @category ApplicationSearchActiveRecord
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/8 20:49
 * @since
 */

namespace application\common\db;

use common\core\db\base\QSearchInstance;
use yii\base\BaseObject;

/**
 * Class ApplicationSearchActiveRecord
 * @package application\common\db
 */
class ApplicationSearchActiveRecord extends BaseObject
{
    use QSearchInstance;
}
