<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%forms}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $add_time
 * @property integer $upd_time
 */
class TblForms extends \application\common\db\ApplicationActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%forms}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'add_time', 'upd_time'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '表单名称',
            'status' => '0=删除，1=正常，2=禁用',
            'add_time' => 'Add Time',
            'upd_time' => 'Upd Time',
        ];
    }
}
