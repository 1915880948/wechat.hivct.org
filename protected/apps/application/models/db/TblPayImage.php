<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%pay_image}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $order_uuid
 * @property string $image
 * @property string $alipay
 * @property integer $status
 * @property string $created_at
 */
class TblPayImage extends \application\common\db\ApplicationActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%pay_image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['order_uuid', 'image'], 'string', 'max' => 255],
            [['alipay'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'order_uuid' => '订单ID',
            'image' => '上传图片',
            'alipay' => '支付宝',
            'status' => '状态：1正常，0:删除',
            'created_at' => 'Created At',
        ];
    }
}
