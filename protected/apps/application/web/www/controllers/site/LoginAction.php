<?php
/**
 * @category LoginAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/6/10 09:07
 * @since
 */

namespace application\web\www\controllers\site;

use application\web\www\components\WwwBaseAction;
use wechat\Weixin;
use yii\helpers\Url;

/**
 * Class LoginAction
 * @package application\web\www\controllers\site
 */
class LoginAction extends WwwBaseAction
{
    /**
     * 自己跳到oauth去处理吧
     * @return $this|\yii\web\Response
     */
    public function run()
    {
        return $this->controller->redirect(['/oauth/index']);
        if(yUser()->getIsGuest()){
            $app = Weixin::getApp();
            $response = $app->oauth->scopes(['snsapi_userinfo'])
                                   ->redirect(Url::to(['site/callback', 'state' => base64_encode($this->request->getReferrer())], true));
            return $response->send();
        }
    }
}
