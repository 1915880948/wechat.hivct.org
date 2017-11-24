<?php

namespace application\models\base;

use application\models\db\TblSurveyList;
use qiqi\helper\base\InstanceTrait;

/**
 * This is the model class for tableClass "TblSurveyList".
 * className SurveyList
 * @package application\models\base
 */
class SurveyList extends TblSurveyList
{
    use InstanceTrait;

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

    public function getSurveyByUserId($userId)
    {
        return self::find()
            ->andWhere(['uid'=>$userId])
            ->asArray()
            ->one();
    }
}
