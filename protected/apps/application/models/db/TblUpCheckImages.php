<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%up_check_images}}".
 *
 * @property integer $id
 * @property integer $uid
 * @property integer $up_check_result_id
 * @property string $image
 * @property integer $status
 * @property string $created_at
 */
class TblUpCheckImages extends \application\common\db\ApplicationActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%up_check_images}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'up_check_result_id', 'status'], 'integer'],
            [['up_check_result_id'], 'required'],
            [['created_at'], 'safe'],
            [['image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'up_check_result_id' => 'Up Check Result ID',
            'image' => 'Image',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
