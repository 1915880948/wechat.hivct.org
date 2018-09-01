<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%order_memo_log}}".
 *
 * @property integer $id
 * @property string $order_uuid
 * @property integer $admin_id
 * @property string $admin_account
 * @property string $datetime
 * @property string $memo_history
 */
class TblOrderMemoLog extends \application\common\db\ApplicationActiveRecord
{
     const ID = 'id';
     const ORDER_UUID = 'order_uuid';
     const ADMIN_ID = 'admin_id';
     const ADMIN_ACCOUNT = 'admin_account';
     const DATETIME = 'datetime';
     const MEMO_HISTORY = 'memo_history';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_memo_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['admin_id'], 'integer'],
            [['datetime'], 'safe'],
            [['memo_history'], 'string'],
            [['order_uuid'], 'string', 'max' => 36],
            [['admin_account'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_uuid' => 'Order Uuid',
            'admin_id' => '备注人id',
            'admin_account' => '备注人账号',
            'datetime' => 'Datetime',
            'memo_history' => 'Memo History',
        ];
    }
}
