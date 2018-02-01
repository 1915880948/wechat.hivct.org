<?php
/**
 * @category SaveAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 24/11/2017 19:01
 * @since
 */

namespace application\web\www\modules\user\controllers\recv;

use application\models\base\UserAddress;
use application\models\base\UserEvent;
use application\web\www\components\WwwBaseAction;
use common\core\base\Schema;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class SaveAction extends WwwBaseAction
{
    public $method = 'post';
    public $responseType = 'json';

    public function run()
    {
        $post = $this->request->post();

        $products = ArrayHelper::getValue($post, 'product');
        $logistics = ArrayHelper::getValue($post, 'logistics');

        $event = new UserEvent();
        if(!$logistics){
            $event->addError('uuid', '请选择发货地');
        }
        //存储临时商品
        $event->order_temporary = Json::encode([
            'products'  => $products,
            'logistics' => $logistics
        ]);
        //收件人
        $consignee = ArrayHelper::getValue($post, 'name');
        if(!$consignee){
            $event->addError('uuid', '收件人不能为空');
        }
        // $consignee = ArrayHelper::getValue($post,'consignee');
        $mobile = ArrayHelper::getValue($post, 'mobile');
        if(!$mobile){
            $event->addError('uuid', '收件人手机不能为空');
        }
        $city = ArrayHelper::getValue($post, 'recv_province');
        if(!$city){
            $event->addError('uuid', '收件人所在城市不能为空');
        }
        // $city_name = ArrayHelper::getValue($post, 'recv_province_name');
        $city_code = ArrayHelper::getValue($post, 'recv_province_code');
        $address = ArrayHelper::getValue($post, 'address');
        if(!$address){
            $event->addError('uuid', '收件人地址不能为空');
        }
        $memo = ArrayHelper::getValue($post, 'memo');
        $sign_date = ArrayHelper::getValue($post, 'sign_date');
        if(!$sign_date){
            $event->addError('uuid', '请选择申请日期');
        }
        $address_default = ArrayHelper::getValue($post, 'default_address', 0);

        /**
         * 这里有好几步，一步步来
         */
        if($event->validate(null, false)){
            $trans = \Yii::$app->db->beginTransaction();
            //先存储地区
            $addressUuid = ArrayHelper::getValue($post, 'address_uuid');
            $addressInfo = UserAddress::findByUuid($addressUuid);
            if(!$addressInfo){
                $addressInfo = new UserAddress();
            }
            $addressInfo->setAttributes([
                'uid'        => $this->account->uid,
                'realname'   => $consignee,
                'mobile'     => $mobile,
                'city'       => $city,
                'city_code'  => $city_code,
                // 'city_name'  => $city_name,
                'address'    => $address,
                'is_default' => (int) $address_default
            ]);

            $hasDefaultAddress = UserAddress::hasDefaultAddress($this->account->uid);

            if($addressInfo->save()){
                $event->user_address_uuid = $addressInfo->uuid;
                $event->event_memo = $memo;
                $event->uid = $this->account->uid;
                if($hasDefaultAddress && $address_default){
                    UserAddress::removeDefaultAddress($this->account->uid, $addressInfo->uuid);
                }

                if($event->save()){
                    $trans->commit();
                    return Schema::SuccessNotify('登记成功', ['event_uuid' => $event->uuid]);
                }
            }
            $trans->rollBack();
        }

        return Schema::FailureNotify('添加失败', ['items' => array_values($event->getFirstErrors())]);
    }
}
