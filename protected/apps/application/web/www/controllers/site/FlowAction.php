<?php
/**
 * @category FlowAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 14/01/2018 00:23
 * @since
 */

namespace application\web\www\controllers\site;

use application\models\base\OrderList;
use application\web\www\components\WwwBaseAction;
//use qiqi\traits\RenderTrait;

class FlowAction extends WwwBaseAction
{
    public function run(){
        $orderList = OrderList::find()
            ->andWhere(['uid'=>$this->account['uid'],'order_status'=>99])
            ->andWhere(['>','created_at',date("Y-m-d H:i:s",time()-86400*30)])
            ->asArray()
            ->all();

            $is_allow = count($orderList)>0?'1':'0';
        return $this->render(compact('is_allow'));
    }
}
