<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 21/11/2017 14:50
 * @since
 */

namespace application\web\admin\modules\system\controllers\reagent;

use application\models\base\Logistics;
use application\models\base\Reagent;
use application\models\base\RelationReagentLogistics;
use application\web\admin\components\AdminBaseAction;
use common\core\session\GSession;
use qiqi\helper\MessageHelper;

class IndexAction extends AdminBaseAction
{
    public function run($id = 0)
    {
        if( !$this->userinfo['is_admin'] ){
            return MessageHelper::success('对不起，您没有权限！');
        }

        $model = Reagent::findByPk($id);
        if(!$model){
            $model = new Reagent();
            $model->loadDefaultValues();
        }
        if($this->request->getIsPost()){

            if($model->create($this->request->post())){
                //处理relation
                $relations = $this->request->post('relation');
                if($relations){
                    if($id){
                        RelationReagentLogistics::deleteAll(['reagent_id'=>$id]);
                    }
                    foreach($relations as $relation){
                        $m = RelationReagentLogistics::create($id,$relation);
                    }
                }
                return MessageHelper::success(($id ? "编辑 " : "新增") . "成功", gUrl($this->getUniqueId()));
            }

            GSession::setDbError($model);
        }
        $reagents = Reagent::getInstance();
        $provider = $reagents->search([]);
        $logistics = Logistics::getInstance()
                              ->getAllActivateLogistics();

        $logi_related = [];
        if($id > 0){
            $logi_related = RelationReagentLogistics::getLogisticsByReagentId($id);
        }

        return $this->render(compact('provider', 'model', 'logistics','logi_related'));
    }
}
