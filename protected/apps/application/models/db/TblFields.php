<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%fields}}".
 *
 * @property integer $id
 * @property string $label
 * @property string $field
 * @property string $type
 * @property string $data
 * @property string $default_value
 * @property string $hint
 * @property integer $required
 * @property string $regex
 * @property integer $pid
 * @property integer $fm_id
 * @property integer $sort
 */
class TblFields extends \application\common\db\ApplicationActiveRecord
{
     const ID = 'id';
     const LABEL = 'label';
     const FIELD = 'field';
     const TYPE = 'type';
     const DATA = 'data';
     const DEFAULT_VALUE = 'default_value';
     const HINT = 'hint';
     const REQUIRED = 'required';
     const REGEX = 'regex';
     const PID = 'pid';
     const FM_ID = 'fm_id';
     const SORT = 'sort';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%fields}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data'], 'string'],
            [['required', 'pid', 'fm_id', 'sort'], 'integer'],
            [['label', 'field', 'type', 'default_value', 'hint', 'regex'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => '显示名称',
            'field' => '字段名',
            'type' => '输入框类型',
            'data' => '下拉框、单选框、复选框的数据，',
            'default_value' => '默认值',
            'hint' => '输入框提示信息',
            'required' => '是否必填：0=否，1=是',
            'regex' => '其他验证规则（正则表达式）',
            'pid' => '上级',
            'fm_id' => '[FK] forms.id',
            'sort' => '排序',
        ];
    }
}
