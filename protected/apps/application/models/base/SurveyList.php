<?php

namespace application\models\base;

use application\models\db\TblSurveyList;
use qiqi\helper\base\InstanceTrait;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for tableClass "TblSurveyList".
 * className SurveyList
 * @package application\models\base
 * @property mixed $totalStepCount
 * @property array $stepNames
 */
class SurveyList extends TblSurveyList
{
    use InstanceTrait;

    public function getEvents()
    {
        return $this->hasOne(UserEvent::className(), ['event_type_uuid' => 'uuid'])
                    ->andWhere(['event_type' => 'survey']);
    }

    public function getTotalStepCount()
    {
        return count($this->getStepNames());
    }

    public function getStepNames()
    {
        return [
            0 => 'base',
            1 => 'sex',
            2 => 'drug',
            3 => 'phthisic',
            4 => 'hiv',
            5 => 'partner',
            6 => 'followup',
        ];
    }

    public function getStepByName($name)
    {
        $name = str_replace('selfchecking', '', basename($name));
        return array_search($name, $this->getStepNames());
    }

    public function getStepName($step)
    {
        return ArrayHelper::getValue($this->getStepNames(), $step, 'base');
    }

    public function getStepUrl($step, $eventId)
    {
        $step = (int) $step;
        $stepName = $this->getStepName($step);
        return ["/survey/selfchecking{$stepName}", 'eventId' => $eventId, 'step' => $step];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'uid'         => '用户ID',
            'create_time' => '填表日期',
            'name'        => '姓名或称呼',
            'nation'      => '民族',
            'gender'      => '性别',
            'birthday'    => '生日',
            'education'   => '文化程度',
            'marriage'    => '婚姻状态',
            'job'         => '职业',
            'job_other'   => '其他职业',
            'income'      => '月平均收入',
            'household'   => '户籍所在地',
            'livecity'    => '现居地',
            'livetime'    => '当地居住时长',
        ];
    }

    public function getSurveyByUserId($userId, $options = [])
    {
        return self::find()
                   ->andWhere(['uid' => $userId])
                   ->asArray()
                   ->one();
    }

    /**
     * @param $userId
     * @return int|string
     */
    public function getLastMonthSurvey($userId)
    {
        return SurveyList::find()
                         ->andWhere(['uid' => $userId])
                         ->andWhere(['>', 'created_at', date('Y-m-d H:i:s', '-1 month')])
                         ->one();
    }
}
