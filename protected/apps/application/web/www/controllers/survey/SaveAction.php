<?php
/**
 * @category SaveAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/10/22 23:39
 * @since
 */

namespace application\web\www\controllers\survey;

use application\models\base\SurveyList;
use application\web\www\components\WwwBaseAction;
use common\core\base\Schema;

class SaveAction extends WwwBaseAction
{
    public $method = 'post';
    public $responseType = 'json';

    public function run($type)
    {
        $posts = $this->request->post();
        $posts['uid'] = 1;
        $posts['create_time'] = date("Y-m-d");
        switch($type){
            case "base":
            default:
                $result = $this->{"try{$type}"}($posts);
                break;
        }
        if(is_numeric($result)){
            return Schema::SuccessNotify('更新成功', ['id' => $result]);
        }
        return Schema::FailureNotify('添加失败', ['items' => $result]);
    }

    protected function tryBase($datas)
    {
        $model = new SurveyList();
        $model->setAttributes($datas);
        $datas['name'] = $datas['name'] ?? "";
        if(!$model->name){
            $model->addError('name', '姓名不能为空');
        }

        if($model->validate(null, false) && $model->save()){
            return $model->id;
        }

        return array_values($model->getFirstErrors());
    }

    protected function trySex($datas)
    {
        $model = SurveyList::find()
                           ->andWhere(['id' => $datas['id']])
                           ->one();
        if($model->uid != $datas['uid']){
            $model->addError('uid', '用户数据不正确');
            return $model->getFirstErrors();
        }
        $model->setAttributes($datas);
        if($model->validate(null, false) && $model->save()){
            return $model->id;
        }

        return array_values($model->getFirstErrors());
    }

    protected function tryDrug($datas)
    {
        return $this->trySex($datas);
    }

    protected function tryPhthisic($datas)
    {
        return $this->trySex($datas);
    }

    protected function tryHiv($datas)
    {
        return $this->trySex($datas);
    }

    protected function tryPartner($datas)
    {
        return $this->trySex($datas);
    }
    protected function tryFollowup($datas){
        return $this->trySex($datas);
    }
}
