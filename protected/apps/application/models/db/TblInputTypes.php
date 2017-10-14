<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%input_types}}".
 *
 * @property integer $id
 * @property string $type
 * @property string $comment
 */
class TblInputTypes extends \application\common\db\ApplicationActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%input_types}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'comment'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '普通类型',
            'comment' => '注释',
        ];
    }
}
