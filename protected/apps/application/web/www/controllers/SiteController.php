<?php
/**
 * @category SiteController
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/1 23:14
 * @since
 */

namespace application\web\www\controllers;

use application\web\www\components\WwwBaseController;
use common\core\base\controller\ActionsTrait;
use yii\filters\AccessControl;

/**
 * Class SiteController
 * @package application\web\www\controllers
 */
class SiteController extends WwwBaseController
{
    public $enableCsrfValidation = false;
    use ActionsTrait;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'logout', 'province', 'test', 'upload'],
                        'allow'   => true,
                        'roles'   => ['?'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }
}
