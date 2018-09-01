<?php
/**
 * @category main.php
 * @author   gouki <gouki.xiao@gmail.com>
 * @created  6/27/15 20:57
 * @since
 */

use qiqi\core\template\blade\BladeView;
use qiqi\core\template\blade\ViewRenderer;

$appId = basename(__DIR__);
$appName = defined('APP_GROUP') ? APP_GROUP : APP_NAME;
$modules = [];
$viewPaths = [];
foreach(glob(Yii::getAlias("@{$appName}/web/{$appId}/modules/*")) as $item){
    if(is_dir($item) && file_exists($item . "/config.php")){
        $config = include $item . "/config.php";
        if(isset($config['class'])){
            if(!isset($config['id'])){
                $config['id'] = md5($config['class']);
            }
            $modules[$config['id']] = $config;
            $viewPaths[] = $item."/views";
        }
    }
}
return [
    'id'                  => $appId,
    'name'                => $appId,
    'basePath'            => "@{$appName}/web/{$appId}",
    'viewPath'            => "@{$appName}/web/{$appId}/views",
    'controllerNamespace' => "{$appName}\\web\\{$appId}\\controllers",
    'components'          => [
        'user'         => [
            'identityClass'   => "{$appName}\\web\\{$appId}\\AdminUser",
            'idParam'         => '__admin',
            'enableAutoLogin' => true,
            'identityCookie'  => [
                'name'     => '_admin_identity',
                'httpOnly' => true,
                'domain'   => isset($params['cookie']['domain']) ? $params['cookie']['domain'] : null,
            ],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            // 'hashCallback'    => function ($path) {
            //     return hash('md4', $path);
            // }
        ],
        'view'         => [
            'class'            => BladeView::className(),
            'defaultExtension' => 'blade.php',
            'renderers'        => [
                'blade' => [
                    'class'     => ViewRenderer::className(),
                    'cachePath' => '@runtime/cache',
                ],
            ],
        ],
    ],
    'bootstrap'           => env('APP') == 'dev' ? ['debug', 'log'] : ['log'],
    'modules'             => $modules,
];
