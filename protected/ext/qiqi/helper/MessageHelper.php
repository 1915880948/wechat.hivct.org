<?php
/**
 * @category MessageHelper
 * @author   gouki <gouki.xiao@gmail.com>
 * @created  11/21/14 23:39
 * @since
 */
namespace qiqi\helper;

use qiqi\helper\base\AppHelper;
use yii\base\Object;
use yii\helpers\ArrayHelper;

/**
 * Class MessageHelper
 * @package helper
 */
class MessageHelper extends Object
{
    static public $variables = [];

    static public function assign($key, $value)
    {
        self::$variables[$key] = $value;
    }

    static public function show($title, $message, $url = '', $time = 3)
    {
        return self::showmessage('success', $title, $message, $url, $time);
    }

    static public function errorShow($title, $message, $url = '', $time = 3)
    {
        return self::showmessage('warning', $title, $message, $url, $time);
    }

    static protected function showmessage($mode, $title, $message, $url = '', $time = 3)
    {
        $controller = AppHelper::getController();
        $controller->layout = isset(\Yii::$app->params['message']['layout']) ? \Yii::$app->params['message']['layout'] : 'blank';
        return $controller->render(isset(\Yii::$app->params['message']['template']) ? \Yii::$app->params['message']['template'] : '../layouts/message',
            ArrayHelper::merge([
                'title'      => $title,
                'message'    => $message,
                'url'        => is_array($url) ? $url : ($url ? [$url] : \Yii::$app->request->getReferrer()),
                'time'       => $time,
                'mode'       => $mode,
                'controller' => $controller,
            ], self::$variables)
        );
    }
}
