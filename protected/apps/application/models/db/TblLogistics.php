<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%logistics}}".
 *
 * @property integer $id
 * @property string $sign_name
 * @property string $title
 * @property integer $status
 * @property string $created_at
 */
class TblLogistics extends \application\common\db\ApplicationActiveRecord
{
     const ID = 'id';
     const SIGN_NAME = 'sign_name';
     const TITLE = 'title';
     const STATUS = 'status';
     const CREATED_AT = 'created_at';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%logistics}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['created_at'], 'safe'],
            [['sign_name'], 'string', 'max' => 20],
            [['title'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sign_name' => '英文名',
            'title' => '店名',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
