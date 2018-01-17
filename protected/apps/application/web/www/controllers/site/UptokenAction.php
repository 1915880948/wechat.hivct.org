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
use yii\helpers\Json;

/**
 * Class UploadAction
 * @package application\web\www\controllers
 */
class UptokenAction extends WwwBaseAction
{
    public function run()
    {
        \Yii::$app->response->format = 'json';
//        print_r($_SERVER);
//        return [env('ASSET_VERSION'),env('QINIU_ACCESSKEY'), env('WECHAT_USER_TAGS_UPDATE_TIME')];
        $auth = new Auth(env('QINIU_APP_KEY'), env('QINIU_APP_SECRET'));

        $token = $auth->uploadToken(env('QINIU_BUCKET'),null,3600,['mimeLimit'=>'image/*']);
        return ['uptoken' => $token];

    }
}
