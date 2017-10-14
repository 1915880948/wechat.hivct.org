<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%reagent}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $price
 * @property integer $status
 * @property integer $stock
 * @property string $comment
 */
class TblReagent extends \application\common\db\ApplicationActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reagent}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['status', 'stock'], 'integer'],
            [['comment'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['comment'], 'string', 'max' => 255],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '试剂名称',
            'price' => '价格',
            'status' => '0=删除，1=正常',
            'stock' => '库存，-1无限',
            'comment' => '备注',
        ];
    }
}
