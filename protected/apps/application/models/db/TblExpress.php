<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%express}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $address
 * @property integer $status
 * @property string $created_at
 */
class TblExpress extends \application\common\db\ApplicationActiveRecord
{
     const ID = 'id';
     const NAME = 'name';
     const PHONE = 'phone';
     const ADDRESS = 'address';
     const STATUS = 'status';
     const CREATED_AT = 'created_at';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%express}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 30],
            [['address'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'address' => 'Address',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
