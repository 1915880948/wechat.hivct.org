<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 20/11/2017 19:28
 * @since
 */

namespace application\web\www\controllers\oauth;

use application\web\www\components\WwwBaseAction;
use qiqi\helper\log\FileLogHelper;
use yii\helpers\Url;

class IndexAction extends WwwBaseAction
{
    public function run()
    {
        FileLogHelper::xlog(['second', $this->account], 'oauth');
        if(!$this->account){
            return $this->controller->redirect(env('WECHAT_OPEN_URL')."/oauth/redirect?url=" . Url::to(['/oauth/code'], true));
        }
        return $this->controller->redirect(['/site/index']);
    }
}
