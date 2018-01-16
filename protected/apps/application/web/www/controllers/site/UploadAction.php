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
use Qiniu\Storage\UploadManager;

/**
 * Class UploadAction
 * @package application\web\www\controllers
 */
class UploadAction extends WwwBaseAction
{
    public function run()
    {
        $file = \Yii::$app->request->post('file');
        $up = new UploadManager();
        $auth = new Auth(env('QINIU_SecretKey'), env('QINIU_AccessKey'));
        $token = $auth->uploadToken(env('QINIU_BUCKET'));
//        $fileData = explode(':', $file);

//        print_r( base64_decode($file) ); die;
        $filePath = \Yii::getAlias('@root/app.sh');
        $key = basename($filePath,'app.sh');

        print_r( $_FILES['file']['name'] ); die;

        list($ret, $err) = $up->putFile($token, $key,  $filePath  );
        echo "\n====> putFile result: \n";
        if($err !== null){
            var_dump($err);
        } else{
            var_dump($ret);
            return['code'=>200];
        }
    }
}