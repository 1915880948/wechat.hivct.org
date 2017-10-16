<?php
/**
 * @category WwwUser
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/15 12:39
 * @since
 */

namespace application\web\www;

use application\models\base\Users;
use Overtrue\Socialite\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\IdentityInterface;

/**
 * Class WwwUser
 * @package application\web\www
 */
class WwwUser extends Users implements IdentityInterface
{
    public static function findIdentity($id)
    {
        return static::find()
                     ->andWhere(['uid' => $id])
                     ->one();
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()
                     ->andWhere(['openid' => $token])
                     ->one();
    }

    public function getId()
    {
        return $this->uid;
    }

    public function getAuthKey()
    {
        return $this->openid;
    }

    public function validateAuthKey($authKey)
    {
        return $this->openid == $authKey;
    }

    /**
     * @param User $weUser
     * @return Users
     */
    public static function createByWechat(User $weUser, $userDetail = null)
    {
        $model = new static;
        $original = $weUser->getOriginal();
        $weAttr = $weUser->getAttributes();
        $model->openid = $weUser->getId();
        $model->unionid = ArrayHelper::getValue($original, 'unionid', $weUser->getId());
        $model->headimgurl = $weUser->getAvatar();
        $model->gender = ArrayHelper::getValue($original, 'sex', '');
        $model->nickname = $weUser->getNickname();
        $model->realname = $weUser->getName();
        $model->country = ArrayHelper::getValue($weAttr, 'country', '');
        $model->province = ArrayHelper::getValue($weAttr, 'province', '');
        $model->city = ArrayHelper::getValue($weAttr, 'city', '');
        $model->is_subscribe = $userDetail->subscribe ?? 0; //-1表示没有获取过用户信息
        $model->tags = Json::encode($userDetail->tagid_list ?? []);
        $model->save();
        return $model;
    }
}
