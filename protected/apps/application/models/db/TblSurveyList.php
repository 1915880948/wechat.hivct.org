<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%survey_list}}".
 *
 * @property integer $id
 * @property string $uuid
 * @property integer $uid
 * @property string $create_time
 * @property string $name
 * @property string $nation
 * @property string $gender
 * @property string $birthday
 * @property string $education
 * @property string $marriage
 * @property string $job
 * @property string $job_other
 * @property string $income
 * @property string $household
 * @property string $livecity
 * @property string $livecity_code
 * @property string $livetime
 * @property integer $has_sex
 * @property integer $sex_age
 * @property string $partner
 * @property integer $partner_sns
 * @property integer $partner_bar
 * @property integer $partner_ktv
 * @property integer $partner_park
 * @property string $partner_other
 * @property string $sex_type
 * @property string $sex_type_other
 * @property string $sex_direction
 * @property integer $has_sex_3month
 * @property integer $hetero_partner_num
 * @property integer $condom_full_use
 * @property string $condom_percent
 * @property string $condom_near
 * @property integer $condom_full_use_not
 * @property integer $anal_sex
 * @property string $anal_sex_role
 * @property integer $anal_sex_partner_num
 * @property integer $anal_sex_full_use
 * @property string $anal_sex_percent
 * @property string $anal_sex_near
 * @property integer $anal_sex_full_use_not
 * @property integer $is_use_drug
 * @property string $drug_type
 * @property string $drug_rate
 * @property string $is_use_drug_near_month
 * @property integer $drug_near_month_num
 * @property integer $is_use_inject
 * @property integer $is_use_inject_near_month
 * @property integer $inject_near_month_num
 * @property integer $is_use_pinhead
 * @property integer $is_use_pinhead_near_month
 * @property string $pinhead_near_month_num
 * @property integer $is_sex_after_drug_3month
 * @property integer $sex_after_drug_3month_num
 * @property integer $is_sex_after_drug_1month
 * @property integer $sex_after_drug_1month_num
 * @property integer $cough_2week
 * @property integer $cough_withblood
 * @property integer $sweat_on_night
 * @property integer $weight_downgrade
 * @property integer $always_tired
 * @property integer $fever_2week
 * @property integer $lymphadenectasis
 * @property integer $tuberculosis_contact_history
 * @property integer $no_tuberculosis
 * @property integer $is_phthisic_checked
 * @property string $phthisic_result
 * @property integer $is_syphilis
 * @property string $syphilis_result
 * @property integer $is_hepatitis_b
 * @property string $hepatitis_b_result
 * @property integer $is_hepatitis_c
 * @property string $hepatitis_c_result
 * @property integer $detect_hospital
 * @property integer $detect_jk_center
 * @property integer $detect_community
 * @property integer $detect_drugstore
 * @property integer $detect_clinic
 * @property string $detect_other
 * @property integer $is_accept_detect_hiv
 * @property integer $detect_num
 * @property integer $detect_num_near_1year
 * @property integer $detect_num_near_6month
 * @property string $last_hiv_checkdate
 * @property string $last_hiv_checkdate_choose
 * @property integer $is_know_detect_result
 * @property string $hiv_check_mode
 * @property string $hiv_check_reason
 * @property string $hiv_check_reason_other
 * @property string $last_hiv_check_mode
 * @property string $last_hiv_check_mode_other
 * @property integer $is_detect_care
 * @property string $hiv_check_care
 * @property string $hiv_check_care_other
 * @property integer $detect_channel_hospital
 * @property integer $detect_channel_jk_center
 * @property integer $detect_channel_community
 * @property integer $detect_channel_drugstore
 * @property integer $detect_channel_clinic
 * @property string $detect_channel_other
 * @property integer $detect_by_self
 * @property string $hiv_check_time
 * @property integer $apply_for_free
 * @property string $partner_is_check_hiv
 * @property string $partner_check_result
 * @property integer $partner_mobilize
 * @property integer $fast_detect_service
 * @property integer $org_for_cd4
 * @property integer $org_therapy
 * @property integer $org_syphilis
 * @property integer $org_syphilis_other
 * @property integer $org_psychological
 * @property integer $org_pmtct
 * @property integer $org_phthisis
 * @property string $org_other
 * @property integer $active_treatment
 * @property integer $unaccept_medical
 * @property integer $treatment_until_standard
 * @property integer $resistant_care
 * @property integer $explore_care
 * @property integer $not_treatment
 * @property string $treatment_other
 * @property string $created_at
 */
class TblSurveyList extends \application\common\db\ApplicationActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%survey_list}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'create_time'], 'required'],
            [['uid', 'has_sex', 'sex_age', 'partner_sns', 'partner_bar', 'partner_ktv', 'partner_park', 'has_sex_3month', 'hetero_partner_num', 'condom_full_use', 'condom_full_use_not', 'anal_sex', 'anal_sex_partner_num', 'anal_sex_full_use', 'anal_sex_full_use_not', 'is_use_drug', 'drug_near_month_num', 'is_use_inject', 'is_use_inject_near_month', 'inject_near_month_num', 'is_use_pinhead', 'is_use_pinhead_near_month', 'is_sex_after_drug_3month', 'sex_after_drug_3month_num', 'is_sex_after_drug_1month', 'sex_after_drug_1month_num', 'cough_2week', 'cough_withblood', 'sweat_on_night', 'weight_downgrade', 'always_tired', 'fever_2week', 'lymphadenectasis', 'tuberculosis_contact_history', 'no_tuberculosis', 'is_phthisic_checked', 'is_syphilis', 'is_hepatitis_b', 'is_hepatitis_c', 'detect_hospital', 'detect_jk_center', 'detect_community', 'detect_drugstore', 'detect_clinic', 'is_accept_detect_hiv', 'detect_num', 'detect_num_near_1year', 'detect_num_near_6month', 'is_know_detect_result', 'is_detect_care', 'detect_channel_hospital', 'detect_channel_jk_center', 'detect_channel_community', 'detect_channel_drugstore', 'detect_channel_clinic', 'detect_by_self', 'apply_for_free', 'partner_mobilize', 'fast_detect_service', 'org_for_cd4', 'org_therapy', 'org_syphilis', 'org_syphilis_other', 'org_psychological', 'org_pmtct', 'org_phthisis', 'active_treatment', 'unaccept_medical', 'treatment_until_standard', 'resistant_care', 'explore_care', 'not_treatment'], 'integer'],
            [['create_time', 'birthday', 'last_hiv_checkdate', 'created_at'], 'safe'],
            [['uuid'], 'string', 'max' => 36],
            [['name', 'nation', 'education', 'marriage', 'job', 'job_other', 'income', 'household', 'livecity', 'livecity_code', 'livetime', 'partner', 'sex_type', 'sex_type_other', 'sex_direction', 'condom_percent', 'condom_near', 'anal_sex_role', 'anal_sex_percent', 'anal_sex_near', 'drug_type', 'drug_rate', 'pinhead_near_month_num', 'phthisic_result', 'syphilis_result', 'hepatitis_b_result', 'hepatitis_c_result', 'last_hiv_checkdate_choose', 'hiv_check_reason', 'last_hiv_check_mode', 'hiv_check_care', 'hiv_check_time', 'partner_check_result'], 'string', 'max' => 20],
            [['gender'], 'string', 'max' => 3],
            [['partner_other', 'detect_other', 'hiv_check_reason_other', 'hiv_check_care_other', 'detect_channel_other', 'org_other', 'treatment_other'], 'string', 'max' => 50],
            [['is_use_drug_near_month', 'last_hiv_check_mode_other'], 'string', 'max' => 255],
            [['hiv_check_mode', 'partner_is_check_hiv'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => '唯一ID',
            'uid' => '用户ID',
            'create_time' => '填表日期，也是标题',
            'name' => '姓名或称呼',
            'nation' => '民族',
            'gender' => 'Gender',
            'birthday' => 'Birthday',
            'education' => '文化程度',
            'marriage' => 'Marriage',
            'job' => '职业',
            'job_other' => '其他职业（当job填其他的时候）',
            'income' => '月平均收入',
            'household' => '户籍所在地',
            'livecity' => '现居地',
            'livecity_code' => '居住地代码',
            'livetime' => '当地居住时长',
            'has_sex' => '是否有过性行为。1:是，0:否',
            'sex_age' => '您第一次发生性行为的年龄',
            'partner' => '寻找其他性伴侣的方式',
            'partner_sns' => '互联网（社交软件等）',
            'partner_bar' => '酒吧',
            'partner_ktv' => 'KTV
KTV
KTV
KTV',
            'partner_park' => '公园',
            'partner_other' => '其他',
            'sex_type' => '常用性行为方式',
            'sex_type_other' => 'Sex Type Other',
            'sex_direction' => '性取向',
            'has_sex_3month' => '你近3个月内有过性行为吗？',
            'hetero_partner_num' => '近3个月内您有多少个异性伙伴',
            'condom_full_use' => '是否全程使用安全套',
            'condom_percent' => '在最近3个月没有全程使用安全套的比例：',
            'condom_near' => '最近一次与异性发生性行为是否使用安全套',
            'condom_full_use_not' => '是否未全程使用安全套',
            'anal_sex' => '是否有肛交行为吗',
            'anal_sex_role' => 'Anal Sex Role',
            'anal_sex_partner_num' => '近3个月内您有多少个同性伙伴',
            'anal_sex_full_use' => '同性间是否全程使用安全套',
            'anal_sex_percent' => '没有全程使用安全套比例',
            'anal_sex_near' => 'Anal Sex Near',
            'anal_sex_full_use_not' => 'Anal Sex Full Use Not',
            'is_use_drug' => '是否使用过毒品',
            'drug_type' => '毒品类型',
            'drug_rate' => '毒品使用频率',
            'is_use_drug_near_month' => '近一个月使用过毒品',
            'drug_near_month_num' => '近一个月使用毒品的频率',
            'is_use_inject' => '注射过毒品',
            'is_use_inject_near_month' => '最近一个月是否注射过毒品',
            'inject_near_month_num' => '最近一个月注射毒品的频率',
            'is_use_pinhead' => '曾经与别人是否共用过针具',
            'is_use_pinhead_near_month' => '最近一个月，注射毒品时是否与别人共用过针具',
            'pinhead_near_month_num' => '最近一个月注射毒品时，与别人共用针具的频率如何。',
            'is_sex_after_drug_3month' => '最近3个月,是否有过吸食毒品后发生性行为',
            'sex_after_drug_3month_num' => '在最近3个月与多少人是在吸食毒品后发生的性行为',
            'is_sex_after_drug_1month' => '最近1个月,是否有过吸食毒品后发生性行为',
            'sex_after_drug_1month_num' => '最近1个月与多少人是在吸食毒品后发生的性行为',
            'cough_2week' => '咳嗽、咳痰持续2周以上',
            'cough_withblood' => '反复咳出的痰中带血',
            'sweat_on_night' => '夜间经常出汗',
            'weight_downgrade' => '无法解思的体重明显下降',
            'always_tired' => '经常容易疲劳或呼吸短促',
            'fever_2week' => '反复发热持续2周以上',
            'lymphadenectasis' => '淋巴结肿大',
            'tuberculosis_contact_history' => '结核病人接触史',
            'no_tuberculosis' => 'No Tuberculosis',
            'is_phthisic_checked' => '最近是否做过结核检查（痰检或X胸片）',
            'phthisic_result' => '结核检测结果',
            'is_syphilis' => '是否做过梅毒检查 ',
            'syphilis_result' => '梅毒检测结果',
            'is_hepatitis_b' => '最近是否做过乙肝检测',
            'hepatitis_b_result' => '乙肝检测结果',
            'is_hepatitis_c' => '最近是否做过丙肝检测',
            'hepatitis_c_result' => '丙肝检测结果',
            'detect_hospital' => '医院',
            'detect_jk_center' => '疾控中心
疾控中心疾控中心疾控中心
疾控中心
疾控中心
疾控中心
疾控中心',
            'detect_community' => '社区小组',
            'detect_drugstore' => '药店',
            'detect_clinic' => '个体诊所
个体诊所',
            'detect_other' => '其他',
            'is_accept_detect_hiv' => '您是否接受过HIV检测',
            'detect_num' => '接受过几次HIV检测',
            'detect_num_near_1year' => '最近一年内接受过几次HIV检测',
            'detect_num_near_6month' => '最近6个月内接受过几次HIV检测',
            'last_hiv_checkdate' => '最近一次参加HIV检测日期',
            'last_hiv_checkdate_choose' => 'Last Hiv Checkdate Choose',
            'is_know_detect_result' => '否知道自己最近一次的HIV检测结果',
            'hiv_check_mode' => '最近一次主动检测HIV还是被动员检测',
            'hiv_check_reason' => '最近一次参加检测的原因',
            'hiv_check_reason_other' => '最近一次参加检测的其他原因',
            'last_hiv_check_mode' => '最近一次通过何种方式参加HIV检测',
            'last_hiv_check_mode_other' => '最近一次通过其他方式参加HIV检测',
            'is_detect_care' => '对于参加HIV检测是否有顾虑',
            'hiv_check_care' => 'HIV检测的主要顾虑是什么',
            'hiv_check_care_other' => 'HIV检测的其他顾虑是什么',
            'detect_channel_hospital' => '期望获得HIV检测的渠道-医院',
            'detect_channel_jk_center' => '期望获得HIV检测的渠道-疾控中心',
            'detect_channel_community' => '期望获得HIV检测的渠道-社区小组',
            'detect_channel_drugstore' => '期望获得HIV检测的渠道-药店',
            'detect_channel_clinic' => '期望获得HIV检测的渠道-个体诊所',
            'detect_channel_other' => '期望获得HIV检测的渠道-其他',
            'detect_by_self' => '是否愿意获自费购买HIV检测试剂',
            'hiv_check_time' => '再次申请获得一次项目邮寄免费检测试剂',
            'apply_for_free' => '本次是否申请梅毒检测试剂',
            'partner_is_check_hiv' => '配偶/性伴是否检测过HIV',
            'partner_check_result' => '配偶/性伴的检测结果',
            'partner_mobilize' => '是否愿意动员配偶/性伴进行HIV检测',
            'fast_detect_service' => '提供进一步快检服务',
            'org_for_cd4' => '提供确证和CD4检测机构信息',
            'org_therapy' => '提供抗病毒治疗或相关医疗机构信息',
            'org_syphilis' => '提供性病诊断治疗机构信息',
            'org_syphilis_other' => '提供机会性感染治疗及其他相关治疗机构信息',
            'org_psychological' => '提供心理咨询和帮助机构信息',
            'org_pmtct' => '提供母婴阻断机构信息',
            'org_phthisis' => '提供结核诊断治疗机构信息',
            'org_other' => '其他服务',
            'active_treatment' => '积极接受治疗',
            'unaccept_medical' => '担心药物副作用，暂不接受
担心药物副作用，暂不接受',
            'treatment_until_standard' => '未到治疗标准就不用治疗',
            'resistant_care' => '担心很快耐药',
            'explore_care' => '担心吃药后被人发现',
            'not_treatment' => '认为无法治愈，不治疗，任其自然',
            'treatment_other' => '其他看法',
            'created_at' => 'Created At',
        ];
    }
}
