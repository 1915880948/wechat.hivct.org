<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%reagent}}".
 *
 * @property integer $id
 * @property string $uuid
 * @property string $name
 * @property string $subname
 * @property string $description
 * @property string $type
 * @property string $price
 * @property integer $status
 * @property integer $stock
 * @property string $comment
 * @property string $image
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
            [['type'], 'required'],
            [['price'], 'number'],
            [['status', 'stock'], 'integer'],
            [['uuid'], 'string', 'max' => 36],
            [['name'], 'string', 'max' => 30],
            [['subname'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 500],
            [['type'], 'string', 'max' => 10],
            [['comment'], 'string', 'max' => 255],
            [['image'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'Uuid',
            'name' => '试剂名称',
            'subname' => '附加名称',
            'description' => '说明',
            'type' => 'free/charge/gift',
            'price' => '价格',
            'status' => '0=删除，1=正常',
            'stock' => '库存，-1无限',
            'comment' => '备注',
            'image' => 'Image',
        ];
    }
}
