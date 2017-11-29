<?php
/**
 * @category ${NAME}
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/8/14 00:31
 * @since
 */

use common\core\session\GSession;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * @param $url
 * @return bool|string
 */
function gStatic($url)
{
    $url = ltrim($url, '/');
    return Yii::getAlias("@webstatic/{$url}");
}

function gHasError()
{
    return \Yii::$app->getSession()
                     ->hasFlash('error');
}

function gGetError()
{
    return GSession::getDbError();
}

function gSession()
{
    return Yii::createObject(GSession::class);
}

function gArrayHelper()
{
    return Yii::createObject(ArrayHelper::class);
}

/**
 * @param      $url
 * @param bool $schema
 * @return string
 */
function gUrl($url, $schema = false)
{
    $url = "/" . Url::to($url);
    return Url::to($url, $schema);
}

/**
 * 返回全局首页
 * @return string
 */
function gHomeUrl()
{
    return '/site/index';
}
