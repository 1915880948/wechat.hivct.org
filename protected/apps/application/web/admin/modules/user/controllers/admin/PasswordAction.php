<?php
/**
 * @category LoginAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 16/4/30 13:01
 * @since
 */
namespace application\web\admin\modules\user\controllers\admin;

use application\models\base\Logistics;
use application\web\admin\AdminUser;
use application\web\admin\components\AdminBaseAction;
use application\web\admin\models\AdminUserLoginForm;
use GuzzleHttp\Client;
use qiqi\helper\MessageHelper;

/**
 * Class LoginAction
 * @package admin\controllers\site
 */
class PasswordAction extends AdminBaseAction
{
    public function run()
    {
        $logistic = Logistics::find()
            ->andWhere(['status'=>1])
            ->asArray()
            ->all();

        if($this->request->getIsPost()) {
            $postData = $this->request->post();
            $user = AdminUser::findByPk($this->userinfo['aid']);

            $user->nickname = $postData['nickname'];
            if( isset($postData['logistic_id'])){
                $user->logistic_id = $postData['logistic_id'];
            }
            if( trim($postData['password'],' ') ) {
                $hash = \Yii::$app->getSecurity()->generatePasswordHash( trim($postData['password'],' '));
                if( !$user->validatePasswordHash($postData['password_old'], $user->password)){
                    return MessageHelper::show('提示信息','旧密码错误，请重新输入！');
                }
                $user->password = $hash;
                if( $user->save() ){
                    \Yii::$app->user->logout();
                    return MessageHelper::show('提示信息', '密码修改成功，请重新登录','/site/index');
                }
            }

            if($user->save()){
                return MessageHelper::success("编辑成功");
            }else{
                return $user->getErrors();
            }
        }

            return $this->render(compact('logistic'));
    }
}
