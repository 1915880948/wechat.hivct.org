<?php
/**
 * @category IndexAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 21/11/2017 23:01
 * @since
 */

namespace application\web\admin\modules\order\controllers\site;

use application\models\base\Express;
use application\models\base\Logistics;
use application\models\base\OrderList;
use application\web\admin\components\AdminBaseAction;
use qiqi\helper\DataProviderHelper;

class ApplyAction extends AdminBaseAction
{
    public function run($is_to_examine = '0')
    {
        $logistics = Logistics::find()
            ->andWhere(['status' => 1])
            ->asArray()
            ->all();
        $express = Express::find()
            ->andWhere(['status' => 1])
            ->asArray()
            ->all();
        $query = OrderList::find();

        if(!$this->userinfo['is_admin']){
            $query = $query->andWhere(['logistic_id'=>$this->userinfo['logistic_id']]);
        }
        if( $is_to_examine != '-99'){
            $query = $query->andWhere(['is_to_examine'=>$is_to_examine]);
        }

        $provider = DataProviderHelper::create($query, 20);
        $provider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);

        $expressArr = ['-99' => '全部'];
        $ship = [];
        foreach($express as $key => $v){
            $ship[$v['id']] = $v['name'];
            $expressArr[$v['id']] = $v['name'];
        }

        $logArr = ['-99' => '全部'];
        foreach($logistics as $k => $v){
            $logArr[$v['id']] = $v['title'];
        }
        $applyArr = [
            '-99'   => '全部',
            '0'     => '未审核',
            '1'     => '通过',
            '2'     => '未通过'
        ];

        return $this->render(compact( 'applyArr', 'logArr','provider'));
    }
}
