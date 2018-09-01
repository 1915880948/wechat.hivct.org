<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%order_detail}}".
 *
 * @property integer $id
 * @property string $uuid
 * @property string $order_uuid
 * @property string $goods_uuid
 * @property string $goods_title
 * @property string $goods_price
 * @property string $order_time
 * @property integer $is_shipped
 * @property string $ship_type
 * @property string $ship_code
 * @property string $ship_time
 * @property string $created_at
 * @property string $updated_at
 */
class TblOrderDetail extends \application\common\db\ApplicationActiveRecord
{
     const ID = 'id';
     const UUID = 'uuid';
     const ORDER_UUID = 'order_uuid';
     const GOODS_UUID = 'goods_uuid';
     const GOODS_TITLE = 'goods_title';
     const GOODS_PRICE = 'goods_price';
     const ORDER_TIME = 'order_time';
     const IS_SHIPPED = 'is_shipped';
     const SHIP_TYPE = 'ship_type';
     const SHIP_CODE = 'ship_code';
     const SHIP_TIME = 'ship_time';
     const CREATED_AT = 'created_at';
     const UPDATED_AT = 'updated_at';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goods_price'], 'number'],
            [['order_time', 'ship_time', 'created_at', 'updated_at'], 'safe'],
            [['is_shipped'], 'integer'],
            [['uuid', 'order_uuid', 'goods_uuid'], 'string', 'max' => 36],
            [['goods_title', 'ship_type', 'ship_code'], 'string', 'max' => 50],
            [['uuid'], 'unique']
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
            'order_uuid' => 'Order Uuid',
            'goods_uuid' => 'Goods Uuid',
            'goods_title' => 'Goods Title',
            'goods_price' => 'Goods Price',
            'order_time' => 'Order Time',
            'is_shipped' => 'Is Shipped',
            'ship_type' => 'Ship Type',
            'ship_code' => 'Ship Code',
            'ship_time' => 'Ship Time',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
