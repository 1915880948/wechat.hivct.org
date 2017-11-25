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

class CommonUUIDBehavior extends AttributeBehavior
{
    use SafeAttributeBehavior;
    public $createdByAttribute = 'uuid';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if(empty($this->attributes)){
            $this->attributes = [
                BaseActiveRecord::EVENT_BEFORE_INSERT => [$this->createdByAttribute],
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
            return Uuid::uuid1()->toString();
        }

        return parent::getValue($event);
    }
}
