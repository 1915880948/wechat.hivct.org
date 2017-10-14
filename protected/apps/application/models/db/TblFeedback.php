<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%feedback}}".
 *
 * @property integer $id
 * @property integer $ord_id
 * @property string $raw_filename
 * @property string $filename
 * @property string $savepath
 * @property string $ext
 * @property integer $size
 */
class TblFeedback extends \application\common\db\ApplicationActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%feedback}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ord_id', 'size'], 'integer'],
            [['raw_filename', 'filename', 'savepath', 'ext'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ord_id' => '订单ID',
            'raw_filename' => '原始文件名',
            'filename' => '文件名',
            'savepath' => '文件保存路径',
            'ext' => '文件扩展',
            'size' => '文件大小',
        ];
    }
}
