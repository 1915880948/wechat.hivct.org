<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%system_menu}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $action
 * @property integer $pid
 * @property string $icon
 * @property integer $ordinal
 * @property integer $status
 * @property integer $is_power
 */
class TblSystemMenu extends \application\common\db\ApplicationActiveRecord
{
     const ID = 'id';
     const NAME = 'name';
     const ACTION = 'action';
     const PID = 'pid';
     const ICON = 'icon';
     const ORDINAL = 'ordinal';
     const STATUS = 'status';
     const IS_POWER = 'is_power';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%system_menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'ordinal', 'status', 'is_power'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['action'], 'string', 'max' => 50],
            [['icon'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '菜单名称',
            'action' => '菜单链接',
            'pid' => '上级ID',
            'icon' => 'Icon',
            'ordinal' => '排序',
            'status' => '状态,是否禁用',
            'is_power' => '是否有权限：1是（默认），0:否',
        ];
    }
}
