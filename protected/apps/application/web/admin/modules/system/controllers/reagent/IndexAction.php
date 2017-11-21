<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 21/11/2017 14:50
 * @since
 */

namespace application\web\admin\modules\system\controllers\reagent;

use application\models\base\Reagent;
use application\web\admin\components\AdminBaseAction;
use common\core\session\GSession;
use qiqi\helper\MessageHelper;
use yii\helpers\Url;

class IndexAction extends AdminBaseAction
{
    public function run($id = 0)
    {

        $model = Reagent::findByPk($id);
        if(!$model){
            $model = new Reagent();
            $model->loadDefaultValues();
        }
        if($this->request->getIsPost()){

            if($model->create($this->request->post())){
                // return $this->controller->redirect(Url::current());
                return MessageHelper::success(($id ? "编辑 " : "新增" ). "成功", gUrl($this->getUniqueId()));
            }

            GSession::setDbError($model);
        }
        $reagents = Reagent::getInstance();
        $provider = $reagents->search([]);

        return $this->render(compact('provider', 'model'));
    }
}
