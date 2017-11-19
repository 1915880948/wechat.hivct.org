<?php
/**
 * @category ListAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 19/11/2017 00:07
 * @since
 */

namespace application\web\admin\modules\survey\controllers\site;

use application\common\db\ApplicationSearchActiveRecord;
use application\models\base\SurveyList;
use application\web\admin\components\AdminBaseAction;

class ListAction extends AdminBaseAction
{
    public function run($district = null)
    {
        $search = new ApplicationSearchActiveRecord();
        $search->setModel(new SurveyList());
        $provider = $search->search([['district' => $district]]);

        /**
         * 处理
         */
        $pageStart = $this->request->get('start', $this->request->post('start', 0));
        $pageSize = $this->request->get('length', $this->request->post('length', 30));
        $currentPage = ceil($pageStart / $pageSize);

        $provider->pagination->setPage($currentPage);
        $provider->pagination->setPageSize($pageSize);

        $lists = [];

        foreach($provider->getModels() as $model){
            $lists[] = [

            ];
        }

        $counts = $provider->getPagination()->totalCount;
        if($lists){


            return [
                'recordsTotal'    => $counts,
                'recordsFiltered' => $counts,
                'data'            => $lists
            ];
        }

        return [
            //总记录数
            'recordsTotal'    => 0,
            //筛选后的记录数
            'recordsFiltered' => 0,
            //返回的数据{与table里一一对应}
            'data'            => []
        ];
    }
}
