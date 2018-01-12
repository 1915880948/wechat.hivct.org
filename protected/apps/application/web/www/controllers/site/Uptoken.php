<?php
/**
 * @category UploadAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/6/9 13:23
 * @since
 */

namespace application\web\www\controllers\site;

use application\web\www\components\WwwBaseAction;
use Qiniu\Auth;

/**
 * Class UploadAction
 * @package application\web\www\controllers
 */
class Uptoken extends WwwBaseAction
{
    public function run(){
        \Yii::$app->response->format = 'json';
        $auth = new Auth(env('QINIU_AccessKey'), env('QINIU_SecretKey'));
        $token = $auth->uploadToken(env('QINIU_BUCKET'),null, 3600, []);
        return  $token;

    }
}
