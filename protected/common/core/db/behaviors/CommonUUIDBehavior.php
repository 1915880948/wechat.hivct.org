<?php
/**
 * @category CommonUUIDBehavior
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 25/11/2017 10:00
 * @since
 */

namespace common\core\db\behaviors;

use Ramsey\Uuid\Uuid;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;

/**
 * 更样的的时候如果有值就不再覆盖
 * Class CommonUUIDBehavior
 * @package common\core\db\behaviors
 */
class CommonUUIDBehavior extends AttributeBehavior
{
    public $createdByAttribute = 'uuid';
    use UnSafeAttributeBehavior;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if(empty($this->attributes)){
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->createdByAttribute],
                BaseActiveRecord::EVENT_BEFORE_UPDATE => $this->createdByAttribute,
            ];
        }
    }

    /**
     * @inheritdoc
     *  自动生成36位的随机字符串
     */
    protected function getValue($event)
    {
        if($this->value === null){
            return Uuid::uuid1()
                       ->toString();
        }
        return parent::getValue($event);
    }
}
