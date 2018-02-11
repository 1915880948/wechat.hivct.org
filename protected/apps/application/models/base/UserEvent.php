<?php

namespace application\models\base;

use application\models\db\TblUserEvent;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for tableClass "TblUserEvent".
 * className UserEvent
 * @package application\models\base
 */
class UserEvent extends TblUserEvent
{
    /**
     * @inheritdoc
     * 用于特别标记这些字段的中文名
     */
    public function attributeLabels()
    {
        [
            'id'                      => 'ID',
            'uuid'                    => 'Uuid',
            'event_type'              => '参与的活动类型：如survey/xxxx',
            'event_type_uuid'         => 'Event Type Uuid',
            'event_type_step_total'   => '参与活动的步骤',
            'event_type_step_current' => '当前步骤，用于确认是否已完成',
            'event_memo'              => '备注，这个同时会写到订单的备住里',
            'order_temporary'         => '订单暂存。如果最后选择支付了。就处理掉。否则就存在这里。供后续查看用户的选择',
            'order_uuid'              => '参与活动时是否购物。购物的UUID',
            'order_is_paid'           => '是否支付',
            'order_is_shipped'        => 'Order Is Shipped',
            'user_address_uuid'       => 'User Address Uuid',
            'created_at'              => 'Created At',
            'updated_at'              => 'Updated At',
        ];
        return ArrayHelper::merge(parent::attributeLabels(), []);
    }

    /**
     * 获取用户是否在一个月内提交过这个问题
     * @param $userId
     * @return UserEvent|array|null|\yii\db\ActiveRecord
     */
    public function getUserLastMonthSurvey($userId)
    {
        return self::find()
                   ->andWhere(['uid' => $userId])
                   ->andWhere(['event_type' => 'survey'])
                   ->andWhere(['>', 'created_at', date('Y-m-d H:i:s', '-1 month')])
                   ->one();
    }
}
