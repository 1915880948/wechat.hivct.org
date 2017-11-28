<?php
/**
 * @category SaveAction
 * @author   gouki <gouki.xiao@gmail.com>
 * @created 2017/10/22 23:39
 * @since
 */

namespace application\web\www\controllers\survey;

use application\models\base\SurveyList;
use application\models\base\UserEvent;
use application\web\www\components\suvey\SurveyTrait;
use application\web\www\components\WwwBaseAction;
use common\core\base\Schema;
use yii\helpers\ArrayHelper;

class SaveAction extends WwwBaseAction
{
    use SurveyTrait;
    public $method = 'post';
    public $responseType = 'json';
    protected $eventId;
    protected $step;

    public function run($type)
    {
        $posts = $this->request->post();
        $eventId = ArrayHelper::getValue($posts, 'eventId');
        $step = ArrayHelper::getValue($posts, 'step');
        if(!$eventId){
            return Schema::FailureNotify('参数不正确', ['items' => ['参数不正确']]);
        }
        $this->eventId = $eventId;
        $this->step = $step;
        $posts['uid'] = $this->account->uid;
        $posts['create_time'] = date("Y-m-d");

        $func = "try{$type}";
        if(!method_exists($this, $func)){
            return Schema::FailureNotify('error', ['items' => ['方法不正确']]);
        }

        $result = $this->$func($posts);

        if(is_numeric($result)){
            return Schema::SuccessNotify('更新成功', ['id' => $result]);
        }
        return Schema::FailureNotify('添加失败', ['items' => $result]);
    }

    protected function tryBase($datas)
    {
        $model = $this->getSurvey($datas['eventId']);
        $model->setAttributes($datas);
        $datas['name'] = isset($datas['name']) ? $datas['name'] : "";
        if(!$model->name){
            $model->addError('name', '姓名不能为空');
        }
        if(!$model->nation){
            $model->addError('name', '民族不能为空');
        }
        if(!$model->birthday){
            $model->addError('name', '出生日期不能为空');
        }
        if(!$model->education){
            $model->addError('name', '文化程度不能为空');
        }
        if(!$model->marriage){
            $model->addError('name', '婚姻状况不能为空');
        }
        if(!$model->job || (($model->job == '其他') && !$model->job_other)){
            $model->addError('name', '主要职业不能为空');
        }
        if(!$model->income){
            $model->addError('name', '月平均收入不能为空');
        }
        if(!$model->household){
            $model->addError('name', '户籍所在地不能为空');
        }
        if(!$model->livecity){
            $model->addError('name', '现居住地不能为空');
        }
        if(!$model->livetime){
            $model->addError('name', '本地居住时长不能为空');
        }

        return $this->saveAndReturn($model, 'init');
    }

    protected function trySex($datas)
    {
        $model = $this->getSurvey($datas['eventId']);
        $model->setAttributes($datas);
        if(!$model->has_sex){
            return $this->saveAndReturn($model);
        }
        if(!$model->sex_age){
            $model->addError('name', '第一次性行为年龄不能为空');
        }
        if(!$model->sex_direction){
            $model->addError('name', '性取向不能为空');
        }

        return $this->saveAndReturn($model);
    }

    protected function tryDrug($datas)
    {
        $model = $this->getSurvey($datas['eventId']);
        if(!isset($datas['is_use_drug'])){
            $datas['is_use_drug'] = 0;
            $datas = ArrayHelper::merge($datas, [
                'drug_type'                 => '',
                'drug_rate'                 => '',
                'is_use_drug_near_month'    => 0,
                'drug_near_month_num'       => '',
                'is_use_pinhead_near_month' => 0,
                'pinhead_near_month_num'    => '',
                'is_sex_after_drug_3month'  => 0,
                'sex_after_drug_3month_num' => '',
                'is_sex_after_drug_1month'  => 0,
                'sex_after_drug_1month_num' => '',
            ]);
        }
        $model->setAttributes($datas);
        if(!$model->is_use_drug){
            $model->save();
            return $model->id;
        }
        if(!$model->drug_type){
            $model->addError('name', '毒品类型不能为空');
        }
        if(!$model->drug_rate){
            $model->addError('name', '毒品使用频率不能为空');
        }
        if($model->is_use_drug_near_month && !$model->drug_near_month_num){
            $model->addError('name', '最近一个月使用毒品的频率不能为空');
        }
        if($model->is_use_inject){
            if($model->is_use_inject_near_month && !$model->inject_near_month_num){
                $model->addError('name', '最近一个月注射毒品的频率不能为空');
            }
            if($model->is_use_pinhead_near_month && !$model->pinhead_near_month_num){
                $model->addError('name', '最近一个月注射毒品与别人共用针具的频率不能为空');
            }
        }
        if($model->is_sex_after_drug_3month && !$model->sex_after_drug_3month_num){
            $model->addError('name', '最近3个月在吸食毒品后发生性行为的人数不能为空');
        }
        if($model->is_sex_after_drug_1month && !$model->sex_after_drug_1month_num){
            $model->addError('name', '最近1个月在吸食毒品后发生性行为的人数不能为空');
        }
        return $this->saveAndReturn($model);
    }

    protected function tryPhthisic($datas)
    {
        $model = $this->getSurvey($datas['eventId']);

        $model->setAttributes($datas);
        if($model->is_phthisic_checked && !$model->phthisic_result){
            $model->addError('name', '结核检测结果不能为空');
        }
        if($model->is_syphilis && !$model->syphilis_result){
            $model->addError('name', '梅毒检测结果不能为空');
        }
        if($model->is_hepatitis_b && !$model->hepatitis_b_result){
            $model->addError('name', '乙肝检测结果不能为空');
        }
        if($model->is_hepatitis_c && !$model->hepatitis_c_result){
            $model->addError('name', '丙肝检测结果不能为空');
        }
        return $this->saveAndReturn($model);
    }

    protected function tryHiv($datas)
    {
        $model = $this->getSurvey($datas['eventId']);
        if(!isset($datas['is_accept_detect_hiv'])){
            $datas['is_accept_detect_hiv'] = 0;
            $datas = ArrayHelper::merge($datas, [
                'detect_num'         => 0,
                'last_hiv_checkdate' => '',
                'hiv_check_mode'     => '',
                'hiv_check_reason'   => '',
                'is_detect_care'     => 0,
                'hiv_check_care'     => '',
                'hiv_check_time'     => '',
            ]);
        }
        $model->setAttributes($datas);
        if(!$model->is_accept_detect_hiv){
            $model->save();
            return $model->id;
        }
        if(!$model->detect_num){
            $model->addError('name', '请输入 接受过HIV检测次数');
        }
        if(!$model->last_hiv_checkdate){
            $model->addError('name', '请选择 最近一次参加HIV检测日期');
        }
        if(!$model->hiv_check_mode){
            $model->addError('name', '请选择 最近一次主动检测HIV还是被动员检测？');
        }
        if(!$model->hiv_check_reason){
            $model->addError('name', '请选择最近一次参加检测的原因');
        }
        if(!$model->last_hiv_check_mode){
            $model->addError('name', '请选择最近一次通过何种方式参加HIV检测');
        }
        if(!$model->is_detect_care && $model->hiv_check_care){
            $model->addError('name', '请选择你之前对参加HIV检测的主要顾虑');
        }
        if(!$model->hiv_check_time){
            $model->addError('name', '你希望多久再次申请获得一次项目邮寄给你的免费检测试剂？？');
        }
        return $this->saveAndReturn($model);
    }

    protected function tryPartner($datas)
    {
        $model = $this->getSurvey($datas['eventId']);

        $model->setAttributes($datas);
        if(!$model->partner_is_check_hiv){
            $model->addError('name', '配偶/性伴是否检测');
        }
        if($model->partner_is_check_hiv == '是' && !$model->partner_check_result){
            $model->addError('name', '配偶/性伴的检测结果不能为空');
        }
        return $this->saveAndReturn($model);
    }

    protected function tryFollowup($datas)
    {
        $model = $this->getSurvey($datas['eventId']);
        $model->setAttributes($datas);
        return $this->saveAndReturn($model, 'finish');
    }

    /**
     * @param SurveyList $model
     * @param null       $mode
     * @return mixed
     */
    protected function saveAndReturn(SurveyList $model, $mode = null)
    {
        if($model->validate(null, false) && $model->save()){
            $updates = ['event_type_step_current' => $this->step];
            if($mode !== null){
                if($mode == 'init'){
                    $updates = ArrayHelper::merge($updates, [
                        'event_type'            => 'survey',
                        'event_type_uuid'       => $model->uuid,
                        'event_type_step_total' => $model->getTotalStepCount()
                    ]);
                }
                if($mode == 'finish'){
                    //忘了要干嘛了？？？
                }
            }
            UserEvent::updateAll($updates, ['uuid' => $this->eventId]);
            return $model->id;
        }
        return array_values($model->getFirstErrors());
    }
}
