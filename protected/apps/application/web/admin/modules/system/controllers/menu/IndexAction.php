<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/10/28 10:33
 * @since
 */

namespace application\web\admin\modules\system\controllers\menu;

use application\models\base\SystemMenu;
use application\web\admin\components\AdminBaseAction;
use common\core\session\GSession;
use common\status\BaseStatus;
use qiqi\helper\MessageHelper;
use qiqi\helper\TreeHelper;

class IndexAction extends AdminBaseAction
{
    public function run($id = 0, $del = 0, $status = null)
    {
        if( !$this->userinfo['is_admin'] ){
            return MessageHelper::success('对不起，您没有权限！');
        }

        $request = \Yii::$app->request;
        if($id){
            $model = SystemMenu::find()
                               ->andFilterWhere(['id' => $id])
                               ->one();
            if($del == 1){
                $model->delete();
                return MessageHelper::show('删除成功', '菜单删除 ，现在返回列表',['/system/menu']);
            }
            if(!$del && $status != null){
                $model->status = (int) $status;
                $model->save();
                if(0 == $status){
                    SystemMenu::updateAll(['status' => 0], ['pid' => $id]);//删除子菜单
                }
                return MessageHelper::show('处理成功', '将菜单设置为删除状态',['/system/menu']);
            }
        }
        if(!isset($model) || !$model){
            $model = new SystemMenu();
            $model->pid = 0;
            $model->status = BaseStatus::COMMON_STATUS_ENABLED;
            $model->ordinal = 50;
        }
        $query = SystemMenu::find()
                           ->orderBy(['ordinal' => SORT_ASC]);
        if($status !== null){
            $query->andFilterWhere(['status' => $status]);
        }
        if($request->getIsPost()){//存储
            $model->load($request->post());
            if(!$model->pid){
                $model->pid = 0;
            }
            if($model->save()){
                return MessageHelper::show('保存成功', $model->pid ? '编辑菜单成功' : '您成功添加了一条菜单，现在返回列表', ['/system/menu']);
            }
            GSession::setDbError($model);
        }
        return $this->render([
            'model'    => $model,
            'menus'    => TreeHelper::getInstance([
                'model' => SystemMenu::find(),
            ])
                                    ->tree(),
            'provider' => $query->all(),
            'request'  => $request,
        ]);
    }
}
