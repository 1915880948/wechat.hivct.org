<?php
/**
 * @category WwwBaseController
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2016/10/1 23:14
 * @since
 */

namespace application\web\www\components;

use common\core\base\BaseController;

/**
 * Class WwwBaseController
 * @package cms
 */
class WwwBaseController extends BaseController
{
    /**
     * 覆盖父类,表示login/info/clear 不需要登录
     * @inheritdoc
     * @return array
     */
    public function behaviors()
    {
        return [
            // 'access' => [
            //     'class' => AccessControl::className(),
            //     'rules' => [
            //         [
            //             //'actions' => [ 'index', 'withdraw' ],
            //             'allow' => true,
            //             'roles' => ['@'],
            //         ],
            //     ],
            // ],
        ];
    }
}

