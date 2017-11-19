<?php
/**
 * @category ErrorAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/10/14 14:32
 * @since
 */

namespace application\web\admin\controllers\site;

use application\web\admin\components\AdminBaseAction;
use qiqi\helper\log\FileLogHelper;
use Yii;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * Class ErrorAction
 * @package application\web\admin\controllers\site
 * @see \yii\web\ErrorAction
 */
class ErrorAction extends AdminBaseAction
{
    public function run()
    {
        if(($exception = Yii::$app->getErrorHandler()->exception) === null){
            $exception = new NotFoundHttpException(Yii::t('yii', 'Page not found.'));
        }
        if($previous = $exception->getPrevious()){
            $exception = $previous;
        }
        FileLogHelper::xlog([$this->request->getReferrer(), $exception->getTraceAsString()], 'error');
        $url = Url::to(['/site/index']);
        $time = 3;
        return $this->render(compact('exception', 'url', 'time'));
    }
}
