<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 21/11/2017 14:48
 * @since
 */

namespace application\web\admin\modules\system\controllers\logistics;

use application\models\base\Logistics;
use application\web\admin\components\AdminBaseAction;
use common\core\session\GSession;
use qiqi\helper\MessageHelper;
use yii\helpers\Url;

/**
 * 送货点管理
 * Class IndexAction
 * @package application\web\admin\modules\system\controllers\logistics
 */
class IndexAction extends AdminBaseAction
{
    /**
     * @param int $id
     * @return string
     */
    public function run($id = 0)
    {
        if($this->userinfo['account'] !== 'admin'){
            return MessageHelper::success('对不起，您没有权限！');
        }
        $model = Logistics::findByPk($id);
        if(!$model){
            $model = new Logistics();
            $model->loadDefaultValues();
        }
        if($this->request->getIsPost()){

            if($model->create($this->request->post())){
                // return $this->controller->redirect(Url::current());
                return MessageHelper::success(($id ? "编辑 " : "新增") . "成功", gUrl($this->getUniqueId()));
            }

            GSession::setDbError($model);
        }
        $reagents = Logistics::getInstance();
        $provider = $reagents->search([]);

        return $this->render(compact('provider', 'model'));
    }
}
