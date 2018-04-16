<?php

namespace application\web\admin\modules\order\controllers\site;

ini_set('memory_limit', '1024M');

use application\models\base\Logistics;
use application\models\base\OrderList;
use application\models\base\SurveyList;
use application\models\base\UserEvent;
use application\web\admin\components\AdminBaseAction;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;

class ExportAction extends AdminBaseAction
{
    public function run($logistic_id = '-99', $ship_uuid = '-99', $pay_status = '1', $order_status = '-99', $adis_result = '-99', $syphilis_result = '-99', $hepatitis_b_result = '-99', $hepatitis_c_result = '-99', $ship_code = '', $wx_transaction_id = '', $address_contact = '', $address_mobile = '')
    {
        $query = OrderList::find()
                          ->select("*");
        $conditions = [
            'logistic_id'        => $logistic_id,
            'ship_uuid'          => $ship_uuid,
            'pay_status'         => $pay_status,
            'order_status'       => $order_status,
            'adis_result'        => $adis_result,
            'syphilis_result'    => $syphilis_result,
            'hepatitis_b_result' => $hepatitis_b_result,
            'hepatitis_c_result' => $hepatitis_c_result
        ];
        foreach($conditions as $condition => $val){
            if($val != '-99'){
                $query = $query->andWhere([$condition => $val]);
            }
        }

        if($ship_code){
            $query = $query->andWhere(['like', 'ship_code', $ship_code]);
        }
        if($wx_transaction_id){
            $query = $query->andWhere(['like', 'wx_transaction_id', $wx_transaction_id]);
        }
        if($address_contact){
            $query = $query->andWhere(['like', 'address_contact', $address_contact]);
        }
        if($address_mobile){
            $query = $query->andWhere(['like', 'address_mobile', $address_mobile]);
        }

        $query->leftJoin(UserEvent::tableName(), OrderList::tableName() . '.uuid=' . UserEvent::tableName() . '.order_uuid')
              ->leftJoin(SurveyList::tableName(), 'event_type_uuid=' . SurveyList::tableName() . '.uuid');
        if($logistic_id != -99){
            $query->leftJoin(Logistics::tableName(), OrderList::tableName() . '.logistic_id=' . Logistics::tableName() . '.id');
        }

        $listData = $query->orderBy([SurveyList::tableName() . '.id' => SORT_DESC])
                          ->asArray()
                          ->all();

        $objectPHPExcel = new PHPExcel();
        $objectPHPExcel->setActiveSheetIndex(0);
        $n = 0;
        $column = [
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'H',
            'I',
            'J',
            'K',
            'L',
            'M',
            'N',
            'O',
            'P',
            'Q',
            'R',
            'S',
            'T',
            'U',
            'V',
            'W',
            'X',
            'Y',
            'Z',
            'AA',
            'AB',
            'AC',
            'AD',
            'AE',
            'AF',
            'AG',
            'AH',
            'AI',
            'AJ',
            'AK',
            'AL',
            'AM',
            'AN',
            'AO',
            'AP',
            'AQ',
            'AR',
            'AS',
            'AT',
            'AU',
            'AV',
            'AW',
            'AX',
            'AY',
            'AZ',
            'BA',
            'BB',
            'BC',
            'BD',
            'BE',
            'BF',
            'BG',
            'BH',
            'BI',
            'BJ',
            'BK',
            'BL',
            'BM',
            'BN',
            'BO',
            'BP',
            'BQ',
            'BR',
            'BS',
            'BT',
            'BU',
            'BV',
            'BW',
            'BX',
            'BY',
            'BZ',
            'CA',
            'CB',
            'CC',
            'CD',
            'CE',
            'CF',
            'CG',
            'CH',
            'CI',
            'CJ',
            'CK',
            'CL',
            'CM',
            'CN',
            'CO',
            'CP',
            'CQ',
            'CR',
            'CS',
            'CT',
            'CU',
            'CV',
            'CW',
            'CX',
            'CY',
            'CZ',
            'DA',
            'DB',
            'DE',
            'DF',
            'DG',
            'DH',
            'DI',
            'DJ',
            'DK',
            'DL',
            'DM',
            'DN',
            'DO',
            'DP',
            'DQ',
            'DR',
            'DS'
        ];
        $header = [
            '序号',
            '发货地',
            '收货人',
            '电话',
            '详细地址',
            '订单标题',
            '订单说明',
            '订单时间',
            '艾滋病检测结果',
            '是否确认',
            '确认时间',
            '是否治疗',
            '治疗时间',
            '梅毒检测结果',
            '是否确认',
            '确认时间',
            '是否治疗',
            '治疗时间',
            '检测时间',
            '姓名或称呼',
            '民族',
            '性别',
            '出生日期',
            '文化程度',
            '婚姻状况',
            '职业',
            '收入',
            '户籍地',
            '现居地',
            '居住时长',
            '是否有过性行为',
            '第一次性行为年龄',
            '寻找性伴侣的方式',
            '寻找性伴侣的途径',
            '常用性行为方式',
            '其他方式',
            '性取向',
            '你近三个月内有过性行为吗',
            '近三个月内您有多少个异性伙伴',
            '是否全程使用安全套',
            '在最近三个月没有全程使用安全套的比例',
            '最近一次与异性发生性行为是否使用安全套',
            '最近一次是否未全程使用安全套',
            '是否有肛交行为',
            '肛交角色',
            '近3个月内您有多少个同性伙伴',
            '同性间是否全程使用安全套',
            '没有全程使用安全套比例',
            '最近一次与同性发生性行为是否使用安全套',
            '与同性发生性行为出现过未全程使用安全套(在肛交发生一段时间才使用安全套，如射精前阶段)',
            '是否使用过毒品',
            '毒品类型',
            '毒品使用频率',
            '近一个月使用过毒品',
            '近一个月使用毒品的频率',
            '注射过毒品',
            '最近一个月是否注射过毒品',
            '最近一个月注射毒品的频率',
            '曾经与别人是否共用过针具',
            '最近一个月注射毒品时是否与别人共用过针具',
            '最近一个月注射毒品时，与别人共用针具的频率如何',
            '最近三个月,是否有过吸食毒品后发生性行为',
            '在最近三个月与多少人是在吸食毒品后发生的性行为',
            '最近一个月,是否有过吸食毒品后发生性行为',
            '最近一个月,与多少人是在吸食毒品后发生的性行为',
            '咳嗽、咳痰持续2周以上',
            '反复咳出的痰中带血',
            '夜间经常出汗',
            '无法解思的体重明显下降',
            '经常容易疲劳或呼吸短促',
            '反复发热持续2周以上',
            '淋巴结肿大',
            '结核病人接触史',
            '无结核相关症状',
            '结核检测结果',
            '最近是否做过结核检查（痰检或X胸片）',
            '梅毒检测结果',
            '是否做过梅毒检查',
            '乙肝检测结果',
            '最近是否做过乙肝检测',
            '丙肝检测结果',
            '最近是否做过丙肝检测',
            '既往检测机构',
            '医院',
            '疾控',
            '自检',
            'VCT门诊',
            '社区组织',
            '其他',
            '你知道本地哪里可以检测HIV',
            '是否接受过HIV检测',
            '接受过几次HIV检测',
            '最近一年内接受过几次HIV检测',
            '最近6个月内接受过几次HIV检测',
            '最近一次参加HIV检测日期',
            '是否知道自己最近一次的HIV检测结果',
            '最近一次主动检测HIV还是被动员检测',
            '最近一次参加检测的原因',
            '最近一次参加检测的其他原因',
            '最近一次通过何种方式参加HIV检测',
            '最近一次通过其他方式参加HIV检测',
            '对于参加HIV检测是否有顾虑',
            'HIV检测的主要顾虑是什么',
            'HIV检测的其他顾虑是什么',
            '你期望获得HIV检测的渠道',
            '是否愿意获自费购买HIV检测试剂',
            '再次申请获得一次项目邮寄免费检测试剂',
            '本次是否申请梅毒检测试剂',
            '配偶/性伴是否检测过HIV',
            '配偶/性伴的检测结果',
            '是否愿意动员配偶/性伴进行HIV检测',
            '提供进一步快检服务',
            '提供确证和CD4检测机构信息',
            '提供抗病毒治疗或相关医疗机构信息',
            '提供性病诊断治疗机构信息',
            '提供机会性感染治疗及其他相关治疗机构信息',
            '提供心理咨询和帮助机构信息',
            '提供母婴阻断机构信息',
            '提供结核诊断治疗机构信息',
            '其他服务',
            '你对感染HIV后是否需要接受治疗的看法是'
        ];
        $db_column = [
            'id',
            'title',
            'address_contact',
            'address_mobile',
            'address_detail',
            'info',
            'description',
            'created_at',
            'adis_result',
            'adis_is_confirm',
            'adis_confirm_time',
            'adis_is_cure',
            'adis_cure_time',
            'syphilis_result',
            'syphilis_is_confirm',
            'syphilis_confirm_time',
            'syphilis_is_cure',
            'syphilis_cure_time',
            'check_time',
            'name',
            'nation',
            'gender',
            'birthday',
            'education',
            'marriage',
            'job',
            'income',
            'household',
            'livecity',
            'livetime',
            'has_sex',
            'sex_age',
            'partner',
            'partner_method',
            'sex_type',
            'sex_type_other',
            'sex_direction',
            'has_sex_3month',
            'hetero_partner_num',
            'condom_full_use',
            'condom_percent',
            'condom_near',
            'condom_full_use_not',
            'anal_sex',
            'anal_sex_role',
            'anal_sex_partner_num',
            'anal_sex_full_use',
            'anal_sex_percent',
            'anal_sex_near',
            'anal_sex_full_use_not',
            'is_use_drug',
            'drug_type',
            'drug_rate',
            'is_use_drug_near_month',
            'drug_near_month_num',
            'is_use_inject',
            'is_use_inject_near_month',
            'inject_near_month_num',
            'is_use_pinhead',
            'is_use_pinhead_near_month',
            'pinhead_near_month_num',
            'is_sex_after_drug_3month',
            'sex_after_drug_3month_num',
            'is_sex_after_drug_1month',
            'sex_after_drug_1month_num',
            'cough_2week',
            'cough_withblood',
            'sweat_on_night',
            'weight_downgrade',
            'always_tired',
            'fever_2week',
            'lymphadenectasis',
            'tuberculosis_contact_history',
            'no_tuberculosis',
            'is_phthisic_checked',
            'phthisic_result',
            'is_syphilis',
            'syphilis_result',
            'is_hepatitis_b',
            'hepatitis_b_result',
            'is_hepatitis_c',
            'hepatitis_c_result',
            'past_check_organize',
            'past_channel_hospital',
            'past_channel_jk',
            'past_channel_self',
            'past_channel_vct',
            'past_channel_community',
            'past_channel_other',
            'where_can_check_HIV',
            'is_accept_detect_hiv',
            'detect_num',
            'detect_num_near_1year',
            'detect_num_near_6month',
            'last_hiv_checkdate',
            'is_know_detect_result',
            'hiv_check_mode',
            'hiv_check_reason',
            'hiv_check_reason_other',
            'last_hiv_check_mode',
            'last_hiv_check_mode_other',
            'is_detect_care',
            'hiv_check_care',
            'hiv_check_care_other',
            'hope_check_channel',
            'detect_by_self',
            'hiv_check_time',
            'apply_for_free',
            'partner_is_check_hiv',
            'partner_check_result',
            'partner_mobilize',
            'fast_detect_service',
            'org_for_cd4',
            'org_therapy',
            'org_syphilis',
            'org_syphilis_other',
            'org_psychological',
            'org_pmtct',
            'org_phthisis',
            'org_other',
            'attitude'
        ];

        //报表头的输出
        $objectPHPExcel->getActiveSheet()
                       ->mergeCells('A1:' . end($column) . '1');
        $objectPHPExcel->getActiveSheet()
                       ->setCellValue('A1', '订单、调研列表');

        $objectPHPExcel->setActiveSheetIndex(0)
                       ->setCellValue('B2', '订单、调研列表');
        $objectPHPExcel->setActiveSheetIndex(0)
                       ->getStyle('A1')
                       ->getFont()
                       ->setSize(24);
        $objectPHPExcel->setActiveSheetIndex(0)
                       ->getStyle('A1')
                       ->getAlignment()
                       ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //加粗
        $objectPHPExcel->getActiveSheet()
                       ->getStyle("A2:" . end($column) . '2')
                       ->getFont()
                       ->setBold(true);
        //设置居中
        $objectPHPExcel->getActiveSheet()
                       ->getStyle('A2:' . end($column) . '2')
                       ->getAlignment()
                       ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //设置边框
        $objectPHPExcel->getActiveSheet()
                       ->getStyle('A2:' . end($column) . '2')
                       ->getBorders()
                       ->getTop()
                       ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //设置颜色
        $objectPHPExcel->getActiveSheet()
                       ->getStyle('A2:' . end($column) . '2')
                       ->getFill()
                       ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                       ->getStartColor()
                       ->setARGB('0013fd5c0');

        foreach(array_combine($column, $header) as $k => $v){
            $objectPHPExcel->getActiveSheet()
                           ->getColumnDimension($k)
                           ->setAutoSize(true);
            $objectPHPExcel->setActiveSheetIndex(0)
                           ->setCellValue($k . '2', $v);
        }
        foreach($listData as $data){
            //明细的输出
            foreach(array_combine($column, $db_column) as $k => $v){
                if($v == 'id'){
                    $objectPHPExcel->getActiveSheet()
                                   ->setCellValue($k . ($n + 3), $n + 1);
                } elseif($v == 'adis_result' || $v == 'syphilis_result'){
                    $objectPHPExcel->getActiveSheet()
                                   ->setCellValue($k . ($n + 3), (gCheckResult($data[$v])));
                } elseif($v == 'partner_method'){
                    $tmp = [];
                    $tmp[] = $data['partner_sns'] == 1 ? '互联网（社交软件等）' : ' ';
                    $tmp[] = $data['partner_bar'] == 1 ? '酒吧' : ' ';
                    $tmp[] = $data['partner_ktv'] == 1 ? 'KTV' : ' ';
                    $tmp[] = $data['partner_park'] == 1 ? '公园' : ' ';
                    $tmp[] = $data['partner_other'];
                    $objectPHPExcel->getActiveSheet()
                                   ->setCellValue($k . ($n + 3), join(",", $tmp));
                } elseif($v == 'past_check_organize'){
                    $tmp = [];
                    $tmp[] = $data['past_channel_hospital'] == 1 ? '医院' : ' ';
                    $tmp[] = $data['past_channel_jk'] == 1 ? '疾控' : ' ';
                    $tmp[] = $data['past_channel_self'] == 1 ? '自检' : ' ';
                    $tmp[] = $data['past_channel_vct'] == 1 ? 'VCT门诊' : ' ';
                    $tmp[] = $data['past_channel_community'] == 1 ? '社区组织' : ' ';
                    $tmp[] = $data['past_channel_other'];
                    $objectPHPExcel->getActiveSheet()
                                   ->setCellValue($k . ($n + 3), join(",", $tmp));
                } elseif($v == 'where_can_check_HIV'){
                    $tmp = [];
                    $tmp[] = $data['detect_hospital'] == 1 ? '医院' : ' ';
                    $tmp[] = $data['detect_jk_center'] == 1 ? '疾控中心' : ' ';
                    $tmp[] = $data['detect_community'] == 1 ? '社区小组' : ' ';
                    $tmp[] = $data['detect_drugstore'] == 1 ? '药店' : ' ';
                    $tmp[] = $data['detect_clinic'] == 1 ? '个体诊所' : ' ';
                    $objectPHPExcel->getActiveSheet()
                                   ->setCellValue($k . ($n + 3), join(",", $tmp));
                } elseif($v == 'hope_check_channel'){
                    $tmp = [];
                    $tmp[] = $data['detect_channel_hospital'] == 1 ? '医院' : ' ';
                    $tmp[] = $data['detect_channel_jk_center'] == 1 ? '疾控中心' : ' ';
                    $tmp[] = $data['detect_channel_community'] == 1 ? '社区小组' : ' ';
                    $tmp[] = $data['detect_channel_drugstore'] == 1 ? '药店' : ' ';
                    $tmp[] = $data['detect_channel_clinic'] == 1 ? '个体诊所' : ' ';
                    $tmp[] = $data['detect_channel_other'];
                    $objectPHPExcel->getActiveSheet()
                                   ->setCellValue($k . ($n + 3), join(",", $tmp));
                } elseif($v == 'attitude'){
                    $tmp = [];
                    $tmp[] = $data['active_treatment'] == 1 ? '积极接受治疗' : '';
                    $tmp[] = $data['unaccept_medical'] == 1 ? '担心药物副作用，暂不接受' : '';
                    $tmp[] = $data['treatment_until_standard'] == 1 ? '未到治疗标准就不用治疗' : '';
                    $tmp[] = $data['resistant_care'] == 1 ? '担心很快耐药' : '';
                    $tmp[] = $data['explore_care'] == 1 ? '担心吃药后被人发现' : '';
                    $tmp[] = $data['not_treatment'] == 1 ? '认为无法治愈，不治疗，任其自然' : '';
                    $objectPHPExcel->getActiveSheet()
                                   ->setCellValue($k . ($n + 3), join(",", $tmp));
                } else{
                    $value = isset($data[$v])?($data[$v] == 1 ? '是' : ($data[$v] === '0' ? '否' : $data[$v])):"";
                    $objectPHPExcel->getActiveSheet()
                                   ->setCellValue($k . ($n + 3), $value);
                }
            }

            //设置边框
            $currentRowNum = $n + 4;
            $objectPHPExcel->getActiveSheet()
                           ->getStyle('A' . ($n + 3) . ':' . end($column) . $currentRowNum)
                           ->getBorders()
                           ->getTop()
                           ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()
                           ->getStyle('A' . ($n + 3) . ':' . end($column) . $currentRowNum)
                           ->getBorders()
                           ->getLeft()
                           ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()
                           ->getStyle('A' . ($n + 3) . ':' . end($column) . $currentRowNum)
                           ->getBorders()
                           ->getRight()
                           ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()
                           ->getStyle('A' . ($n + 3) . ':' . end($column) . $currentRowNum)
                           ->getBorders()
                           ->getBottom()
                           ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()
                           ->getStyle('A' . ($n + 3) . ':' . end($column) . $currentRowNum)
                           ->getBorders()
                           ->getVertical()
                           ->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $n = $n + 1;
        }

        //设置分页显示
        //$objectPHPExcel->getActiveSheet()->setBreak( 'I55' , PHPExcel_Worksheet::BREAK_ROW );
        //$objectPHPExcel->getActiveSheet()->setBreak( 'I10' , PHPExcel_Worksheet::BREAK_COLUMN );
        $objectPHPExcel->getActiveSheet()
                       ->getPageSetup()
                       ->setHorizontalCentered(true);
        $objectPHPExcel->getActiveSheet()
                       ->getPageSetup()
                       ->setVerticalCentered(false);

        //        ob_end_clean();
        //        ob_start();

        header('Content-Type:application/vnd.ms-excel');
        header('Content-Disposition:attachment;filename="' . '订单/调研列表-' . date("Y年m月d日") . '.xls"');
        $objWriter = PHPExcel_IOFactory::createWriter($objectPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
}
