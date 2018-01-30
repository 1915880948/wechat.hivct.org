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

            if( trim($postData['password'],' ') ) {
                $hash = \Yii::$app->getSecurity()->generatePasswordHash( trim($postData['password'],' '));
                $user->password = $hash;
            }
            $user->nickname = $postData['nickname'];
            if( isset($postData['logistic_id'])){
                $user->logistic_id = $postData['logistic_id'];
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
