<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 21/11/2017 14:48
 * @since
 */

namespace application\web\admin\modules\system\controllers\express;

use application\models\base\Express;
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
        $model = Express::findByPk($id);
        if(!$model){
            $model = new Express();
            $model->loadDefaultValues();
        }
        if($this->request->getIsPost()){

            if($model->create($this->request->post())){
                // return $this->controller->redirect(Url::current());
                return MessageHelper::success(($id ? "编辑 " : "新增") . "成功", gUrl($this->getUniqueId()));
            }

            GSession::setDbError($model);
        }
        $reagents = Express::getInstance();
        $provider = $reagents->search([]);

        return $this->render(compact('provider', 'model'));
    }
}
