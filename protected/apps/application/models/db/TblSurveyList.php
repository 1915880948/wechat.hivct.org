<?php

namespace application\models\db;

use Yii;

/**
 * This is the model class for table "{{%survey_list}}".
 *
 * @property integer $id
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
 * @property string $livetime
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
 * @property integer $hetero_partner_num
 * @property integer $condom_full_use
 * @property string $condom_percent
 * @property integer $condom_near
 * @property integer $condom_full_use_not
 * @property integer $anal_sex
 * @property string $anal_sex_role
 * @property integer $anal_sex_partner_num
 * @property integer $anal_sex_full_use
 * @property integer $anal_sex_percent
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
 * @property integer $pinhead_near_month_num
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
 * @property integer $hiv_check_mode
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
 * @property integer $treatment_other
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
            [['uid', 'sex_age', 'partner_sns', 'partner_bar', 'partner_ktv', 'partner_park', 'hetero_partner_num', 'condom_full_use', 'condom_near', 'condom_full_use_not', 'anal_sex', 'anal_sex_partner_num', 'anal_sex_full_use', 'anal_sex_percent', 'anal_sex_full_use_not', 'is_use_drug', 'drug_near_month_num', 'is_use_inject', 'is_use_inject_near_month', 'inject_near_month_num', 'is_use_pinhead', 'is_use_pinhead_near_month', 'pinhead_near_month_num', 'is_sex_after_drug_3month', 'sex_after_drug_3month_num', 'is_sex_after_drug_1month', 'sex_after_drug_1month_num', 'cough_2week', 'cough_withblood', 'sweat_on_night', 'weight_downgrade', 'always_tired', 'fever_2week', 'lymphadenectasis', 'tuberculosis_contact_history', 'no_tuberculosis', 'is_phthisic_checked', 'is_syphilis', 'is_hepatitis_b', 'is_hepatitis_c', 'detect_hospital', 'detect_jk_center', 'detect_community', 'detect_drugstore', 'detect_clinic', 'is_accept_detect_hiv', 'detect_num', 'detect_num_near_1year', 'detect_num_near_6month', 'is_know_detect_result', 'hiv_check_mode', 'is_detect_care', 'detect_channel_hospital', 'detect_channel_jk_center', 'detect_channel_community', 'detect_channel_drugstore', 'detect_channel_clinic', 'detect_by_self', 'apply_for_free', 'partner_mobilize', 'fast_detect_service', 'org_for_cd4', 'org_therapy', 'org_syphilis', 'org_syphilis_other', 'org_psychological', 'org_pmtct', 'org_phthisis', 'active_treatment', 'unaccept_medical', 'treatment_until_standard', 'resistant_care', 'explore_care', 'not_treatment', 'treatment_other'], 'integer'],
            [['create_time', 'birthday', 'last_hiv_checkdate', 'created_at'], 'safe'],
            [['name', 'nation', 'education', 'marriage', 'job', 'job_other', 'income', 'household', 'livecity', 'livetime', 'partner', 'sex_type', 'sex_type_other', 'sex_direction', 'condom_percent', 'anal_sex_role', 'anal_sex_near', 'drug_type', 'drug_rate', 'phthisic_result', 'syphilis_result', 'hepatitis_b_result', 'hepatitis_c_result', 'last_hiv_checkdate_choose', 'hiv_check_reason', 'last_hiv_check_mode', 'hiv_check_care', 'hiv_check_time', 'partner_check_result'], 'string', 'max' => 20],
            [['gender'], 'string', 'max' => 3],
            [['partner_other', 'detect_other', 'hiv_check_reason_other', 'hiv_check_care_other', 'detect_channel_other', 'org_other'], 'string', 'max' => 50],
            [['is_use_drug_near_month', 'last_hiv_check_mode_other'], 'string', 'max' => 255],
            [['partner_is_check_hiv'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
            'livetime' => '当地居住时长',
            'sex_age' => '您第一次发生性行为的年龄',
            'partner' => '寻找其他性伴侣的方式',
            'partner_sns' => 'Partner Sns',
            'partner_bar' => 'Partner Bar',
            'partner_ktv' => 'Partner Ktv',
            'partner_park' => 'Partner Park',
            'partner_other' => 'Partner Other',
            'sex_type' => '常用性行为方式',
            'sex_type_other' => 'Sex Type Other',
            'sex_direction' => '性取向',
            'hetero_partner_num' => '近3个月内您有多少个异性伙伴',
            'condom_full_use' => '是否全程使用安全套',
            'condom_percent' => 'Condom Percent',
            'condom_near' => '最近一次与异性发生性行为是否使用安全套',
            'condom_full_use_not' => '是否未全程使用安全套',
            'anal_sex' => '是否有肛交行为吗',
            'anal_sex_role' => 'Anal Sex Role',
            'anal_sex_partner_num' => '近3个月内您有多少个同性伙伴',
            'anal_sex_full_use' => '同性间是否全程使用安全套',
            'anal_sex_percent' => '没有全程使用安全套',
            'anal_sex_near' => 'Anal Sex Near',
            'anal_sex_full_use_not' => 'Anal Sex Full Use Not',
            'is_use_drug' => '是否使用过毒品',
            'drug_type' => '毒品类型',
            'drug_rate' => '毒品使用频率',
            'is_use_drug_near_month' => '近一个月使用过毒品',
            'drug_near_month_num' => '近一个月使用毒品的频率',
            'is_use_inject' => '注射过毒品',
            'is_use_inject_near_month' => 'Is Use Inject Near Month',
            'inject_near_month_num' => 'Inject Near Month Num',
            'is_use_pinhead' => 'Is Use Pinhead',
            'is_use_pinhead_near_month' => 'Is Use Pinhead Near Month',
            'pinhead_near_month_num' => 'Pinhead Near Month Num',
            'is_sex_after_drug_3month' => 'Is Sex After Drug 3month',
            'sex_after_drug_3month_num' => 'Sex After Drug 3month Num',
            'is_sex_after_drug_1month' => 'Is Sex After Drug 1month',
            'sex_after_drug_1month_num' => 'Sex After Drug 1month Num',
            'cough_2week' => 'Cough 2week',
            'cough_withblood' => 'Cough Withblood',
            'sweat_on_night' => 'Sweat On Night',
            'weight_downgrade' => 'Weight Downgrade',
            'always_tired' => 'Always Tired',
            'fever_2week' => 'Fever 2week',
            'lymphadenectasis' => '淋巴结肿大',
            'tuberculosis_contact_history' => 'Tuberculosis Contact History',
            'no_tuberculosis' => 'No Tuberculosis',
            'is_phthisic_checked' => 'Is Phthisic Checked',
            'phthisic_result' => 'Phthisic Result',
            'is_syphilis' => '是否做过梅毒检查 ',
            'syphilis_result' => 'Syphilis Result',
            'is_hepatitis_b' => 'Is Hepatitis B',
            'hepatitis_b_result' => 'Hepatitis B Result',
            'is_hepatitis_c' => 'Is Hepatitis C',
            'hepatitis_c_result' => 'Hepatitis C Result',
            'detect_hospital' => 'Detect Hospital',
            'detect_jk_center' => 'Detect Jk Center',
            'detect_community' => 'Detect Community',
            'detect_drugstore' => 'Detect Drugstore',
            'detect_clinic' => 'Detect Clinic',
            'detect_other' => 'Detect Other',
            'is_accept_detect_hiv' => 'Is Accept Detect Hiv',
            'detect_num' => 'Detect Num',
            'detect_num_near_1year' => 'Detect Num Near 1year',
            'detect_num_near_6month' => 'Detect Num Near 6month',
            'last_hiv_checkdate' => 'Last Hiv Checkdate',
            'last_hiv_checkdate_choose' => 'Last Hiv Checkdate Choose',
            'is_know_detect_result' => 'Is Know Detect Result',
            'hiv_check_mode' => 'Hiv Check Mode',
            'hiv_check_reason' => 'Hiv Check Reason',
            'hiv_check_reason_other' => 'Hiv Check Reason Other',
            'last_hiv_check_mode' => 'Last Hiv Check Mode',
            'last_hiv_check_mode_other' => 'Last Hiv Check Mode Other',
            'is_detect_care' => 'Is Detect Care',
            'hiv_check_care' => 'Hiv Check Care',
            'hiv_check_care_other' => 'Hiv Check Care Other',
            'detect_channel_hospital' => 'Detect Channel Hospital',
            'detect_channel_jk_center' => 'Detect Channel Jk Center',
            'detect_channel_community' => 'Detect Channel Community',
            'detect_channel_drugstore' => 'Detect Channel Drugstore',
            'detect_channel_clinic' => 'Detect Channel Clinic',
            'detect_channel_other' => 'Detect Channel Other',
            'detect_by_self' => 'Detect By Self',
            'hiv_check_time' => 'Hiv Check Time',
            'apply_for_free' => 'Apply For Free',
            'partner_is_check_hiv' => 'Partner Is Check Hiv',
            'partner_check_result' => 'Partner Check Result',
            'partner_mobilize' => 'Partner Mobilize',
            'fast_detect_service' => 'Fast Detect Service',
            'org_for_cd4' => 'Org For Cd4',
            'org_therapy' => 'Org Therapy',
            'org_syphilis' => 'Org Syphilis',
            'org_syphilis_other' => 'Org Syphilis Other',
            'org_psychological' => 'Org Psychological',
            'org_pmtct' => 'Org Pmtct',
            'org_phthisis' => 'Org Phthisis',
            'org_other' => 'Org Other',
            'active_treatment' => 'Active Treatment',
            'unaccept_medical' => 'Unaccept Medical',
            'treatment_until_standard' => 'Treatment Until Standard',
            'resistant_care' => 'Resistant Care',
            'explore_care' => 'Explore Care',
            'not_treatment' => 'Not Treatment',
            'treatment_other' => 'Treatment Other',
            'created_at' => 'Created At',
        ];
    }
}
