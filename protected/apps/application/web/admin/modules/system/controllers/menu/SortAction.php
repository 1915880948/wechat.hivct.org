<?php
/**
 * @category SortAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/10/28 10:34
 * @since
 */

namespace application\web\admin\modules\system\controllers\menu;

use application\models\base\SystemMenu;
use application\web\admin\components\AdminBaseAction;
use common\core\base\Schema;

class SortAction extends AdminBaseAction
{
    public $method = 'post';
    public $responseType = 'json';

    public function init()
    {
        $this->controller->enableCsrfValidation = false;
        parent::init();
    }

    public function run()
    {
        $sorts = \Yii::$app->request->post('sort');
        $sorts = json_decode($sorts, true);
        $step = 10;
        foreach($sorts as $k => $sort){
            //            echo $sort['id'] , "---" ,$k * $step ," \n";
            SystemMenu::updateAll(['ordinal' => $k * $step], ['id' => $sort['id']]);
            if(isset($sort['children']) && is_array($sort['children'])){
                foreach($sort['children'] as $kk => $children){
                    SystemMenu::updateAll(['ordinal' => $kk * $step, 'pid' => $sort['id']], ['id' => $children['id']]);
                }
            }
        }
        return Schema::SuccessNotify('更新成功');
    }
}
