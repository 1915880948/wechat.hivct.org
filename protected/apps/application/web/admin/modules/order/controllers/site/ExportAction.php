<?php

namespace application\web\admin\modules\order\controllers\site;

use application\models\base\OrderList;
use application\models\base\SurveyList;
use application\models\base\UserEvent;
use application\web\admin\components\AdminBaseAction;
use PHPExcel;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use PHPExcel_IOFactory;

class ExportAction extends AdminBaseAction
{
    public function run($logistics_id = '-99', $ship_uuid = '-99', $pay_status = '-99', $order_status = '-99', $adis_result = '-99', $syphilis_result = '-99', $hepatitis_b_result = '-99', $hepatitis_c_result = '-99', $ship_code = '', $wx_transaction_id = '', $address_contact = '', $address_mobile = '')
    {
        if (\Yii::$app->request->isPost) {
            $uuid = \Yii::$app->request->post('uuid');
            $orderData = OrderList::find()->andWhere(['uuid' => $uuid])->asArray()->one();
            $surveyData = SurveyList::find()
                ->leftJoin(UserEvent::tableName(), SurveyList::tableName() . '.uuid=' . UserEvent::tableName() . '.event_type_uuid')
                ->andWhere(['order_uuid' => $uuid])
                ->asArray()
                ->one();
//            echo count($surveyData);
//            dd( $surveyData) ;
            $objectPHPExcel = new PHPExcel();
            $objectPHPExcel->setActiveSheetIndex(0);
            $n = 0;
            //报表头的输出
            $objectPHPExcel->getActiveSheet()->mergeCells('A1:F1');
            $objectPHPExcel->getActiveSheet()->setCellValue('A1', '订单信息');

            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', '订单信息');
            $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(24);
            $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            //表格头的输出
            $objectPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', '序号');
            $objectPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(45);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', '收货人');
            $objectPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(17);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', '电话');
            $objectPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('D2', '详细地址');
            $objectPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', '订单标题');
            $objectPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(65);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('F2', '订单说明');
            //加粗
            $objectPHPExcel->getActiveSheet()->getStyle("A2:F2")->getFont()->setBold(true);
            //设置居中
            $objectPHPExcel->getActiveSheet()->getStyle('A2:F2')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            //设置边框
            $objectPHPExcel->getActiveSheet()->getStyle('A2:F2')
                ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            //设置颜色
            $objectPHPExcel->getActiveSheet()->getStyle('A2:F2')->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('3FD5C0');

            //明细的输出
            $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($n + 3), $n + 1);
            $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($n + 3), $orderData['address_contact']);
            $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($n + 3), $orderData['address_mobile']);
            $objectPHPExcel->getActiveSheet()->setCellValue('D' . ($n + 3), $orderData['address_detail']);
            $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($n + 3), $orderData['info']);
            $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($n + 3), $orderData['description']);
            //设置边框
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 3) . ':F' . ($n + 3))
                ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            // 调研信息
            if ($surveyData) {
                //报表头的输出
                $surveyRow = 6;
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow) . ':F' . ($surveyRow));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow), '调研信息');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow))->getFont()->setSize(24);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                $currentRow_BC = $currentRow_EF = 1;
                //明细的输出
                //基本信息
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow + (++$currentRow_BC)) . ':F' . ($surveyRow + (++$currentRow_EF)));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow + $currentRow_BC), '基本信息');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))->getFont()->setSize(18);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '姓名或称呼');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['name']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '民族');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['nation']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '性别');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['gender']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '出生日期');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['birthday']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '文化程度');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['education']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '婚姻状况');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['marriage']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '职业');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['job'] . ' ' . $surveyData['job_other']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '收入');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['income']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '户籍地');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['household']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '现居地');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['livecity']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '居住时长');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['livetime']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), '');

                // 性行为情况
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow + (++$currentRow_BC)) . ':F' . ($surveyRow + (++$currentRow_EF)));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow + $currentRow_BC), '性行为情况');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))->getFont()->setSize(18);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '是否有过性行为');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['has_sex'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '第一次性行为年龄');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['sex_age']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '寻找性伴侣的方式');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['partner']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '寻找性伴侣的途径');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)),
                    $surveyData['partner_sns'] ? '互联网' : '' .
                    $surveyData['partner_bar'] ? '酒吧' : '' .
                    $surveyData['partner_ktv'] ? 'KTV' : '' .
                    $surveyData['partner_park'] ? '公园' : '' .
                        $surveyData['partner_other']
                );

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '常用性行为方式');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['sex_type']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '其他方式');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['sex_type_other']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '性取向');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['sex_direction']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '你近三个月内有过性行为吗');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['has_sex_3month'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '近三个月内您有多少个异性伙伴');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['hetero_partner_num']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '是否全程使用安全套');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['condom_full_use'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '在最近三个月没有全程使用安全套的比例');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['condom_percent']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '最近一次与异性发生性行为是否使用安全套');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['condom_near'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '最近一次是否未全程使用安全套');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['condom_full_use_not']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '是否有肛交行为');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['anal_sex'] == 1 ? '是' : '否');

                // 毒品使用情况
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow + (++$currentRow_BC)) . ':F' . ($surveyRow + (++$currentRow_EF)));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow + $currentRow_BC), '毒品使用情况');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))->getFont()->setSize(18);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '是否使用过毒品');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_use_drug'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '毒品类型');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['drug_type']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '毒品使用频率');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['drug_rate']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '近一个月使用过毒品');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['is_use_drug_near_month']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '近一个月使用毒品的频率');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['drug_near_month_num']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '注射过毒品');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['is_use_inject'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '最近一个月是否注射过毒品');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_use_inject_near_month'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '最近一个月注射毒品的频率');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['inject_near_month_num']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '曾经与别人是否共用过针具');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_use_pinhead'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '最近一个月注射毒品时是否与别人共用过针具');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['is_use_pinhead_near_month'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '最近一个月注射毒品时，与别人共用针具的频率如何');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['pinhead_near_month_num']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '最近三个月,是否有过吸食毒品后发生性行为');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['is_sex_after_drug_3month'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '在最近三个月与多少人是在吸食毒品后发生的性行为');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['sex_after_drug_3month_num']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '最近一个月,是否有过吸食毒品后发生性行为');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['is_sex_after_drug_1month'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '最近一个月,与多少人是在吸食毒品后发生的性行为');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['sex_after_drug_1month_num']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), '');

                // 结核和其他调查
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow + (++$currentRow_BC)) . ':F' . ($surveyRow + (++$currentRow_EF)));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow + $currentRow_BC), '结核和其他调查');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))->getFont()->setSize(18);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '咳嗽、咳痰持续2周以上');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['cough_2week'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '反复咳出的痰中带血');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['cough_withblood'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '咳嗽、咳痰持续2周以上');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['cough_2week'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '反复咳出的痰中带血');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['cough_withblood'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '夜间经常出汗');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['sweat_on_night'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '无法解思的体重明显下降');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['weight_downgrade'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '经常容易疲劳或呼吸短促');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['always_tired'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '反复发热持续2周以上');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['fever_2week'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '淋巴结肿大');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['lymphadenectasis'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '结核病人接触史');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['tuberculosis_contact_history'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '无结核相关症状');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['no_tuberculosis'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '结核病人接触史');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['tuberculosis_contact_history'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '最近是否做过结核检查（痰检或X胸片）');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_phthisic_checked'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '结核检测结果');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['phthisic_result']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '是否做过梅毒检查');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_syphilis'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '梅毒检测结果');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['syphilis_result']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '最近是否做过乙肝检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_hepatitis_b'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '乙肝检测结果');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['hepatitis_b_result']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '最近是否做过丙肝检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_hepatitis_c'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '丙肝检测结果');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['hepatitis_c_result']);

                // HIV快速检测
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow + (++$currentRow_BC)) . ':F' . ($surveyRow + (++$currentRow_EF)));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow + $currentRow_BC), 'HIV快速检测');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))->getFont()->setSize(18);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '你知道本地哪里可以检测HIV');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)),
                    $surveyData['detect_hospital'] == 1 ? '&#10003;' : '' .
                    $surveyData['detect_hospital'] == 1 ? '医院' : '' .
                    $surveyData['detect_jk_center'] == 1 ? '疾控中心' : '' .
                    $surveyData['detect_community'] == 1 ? '社区小组' : '' .
                    $surveyData['detect_drugstore'] == 1 ? '药店' : '' .
                    $surveyData['detect_clinic'] == 1 ? '个体诊所' : '' .
                        $surveyData['detect_other']
                );
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '是否接受过HIV检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['is_accept_detect_hiv'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '接受过几次HIV检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['detect_num']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '最近一年内接受过几次HIV检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['detect_num_near_1year']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '最近6个月内接受过几次HIV检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['detect_num_near_6month']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '最近一次参加HIV检测日期');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['last_hiv_checkdate']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '是否知道自己最近一次的HIV检测结果');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_know_detect_result'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '最近一次主动检测HIV还是被动员检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['hiv_check_mode']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '最近一次参加检测的原因');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['hiv_check_reason']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '最近一次参加检测的其他原因');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['hiv_check_reason_other']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '最近一次通过何种方式参加HIV检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['last_hiv_check_mode']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '最近一次通过其他方式参加HIV检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['last_hiv_check_mode_other']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '对于参加HIV检测是否有顾虑');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_detect_care'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), 'HIV检测的主要顾虑是什么');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['hiv_check_care']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), 'HIV检测的其他顾虑是什么');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['hiv_check_care_other']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '你期望获得HIV检测的渠道');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)),
                    $surveyData['detect_channel_hospital'] == 1 ? '医院' : '' .
                    $surveyData['detect_channel_jk_center'] == 1 ? '疾控中心' : '' .
                    $surveyData['detect_channel_community'] == 1 ? '社区小组' : '' .
                    $surveyData['detect_channel_drugstore'] == 1 ? '药店' : '' .
                    $surveyData['detect_channel_clinic'] == 1 ? '个体诊所' : '' .
                        $surveyData['detect_channel_other']
                );

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '是否愿意获自费购买HIV检测试剂');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['detect_by_self'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '再次申请获得一次项目邮寄免费检测试剂');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['hiv_check_time']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '本次是否申请梅毒检测试剂');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['apply_for_free'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), '');

                // 配偶/性伴及其他检测
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow + (++$currentRow_BC)) . ':F' . ($surveyRow + (++$currentRow_EF)));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow + $currentRow_BC), '配偶/性伴及其他检测');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))->getFont()->setSize(18);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '配偶/性伴是否检测过HIV');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['partner_is_check_hiv']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '配偶/性伴的检测结果');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['partner_check_result']);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '是否愿意动员配偶/性伴进行HIV检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['partner_mobilize'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), '');

                // 转介及后续服务
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow + (++$currentRow_BC)) . ':F' . ($surveyRow + (++$currentRow_EF)));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow + $currentRow_BC), '转介及后续服务');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))->getFont()->setSize(18);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '提供进一步快检服务');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['fast_detect_service'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '提供确证和CD4检测机构信息');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['org_for_cd4'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '提供抗病毒治疗或相关医疗机构信息');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['org_therapy'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '提供性病诊断治疗机构信息');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['org_syphilis'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '提供机会性感染治疗及其他相关治疗机构信息');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['org_syphilis_other'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '提供心理咨询和帮助机构信息');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['org_psychological'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '提供母婴阻断机构信息');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['org_pmtct'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '提供结核诊断治疗机构信息');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)), $surveyData['org_phthisis'] == 1 ? '是' : '否');

                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + (++$currentRow_BC)), '其他服务');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['org_other']);
                $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($surveyRow + (++$currentRow_EF)), '你对感染HIV后是否需要接受治疗的看法是');
                $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($surveyRow + ($currentRow_EF)),
                    $surveyData['active_treatment'] == 1 ? '积极接受治疗' : '' .
                    $surveyData['unaccept_medical'] == 1 ? '担心药物副作用，暂不接受' : '' .
                    $surveyData['treatment_until_standard'] == 1 ? '未到治疗标准就不用治疗' : '' .
                    $surveyData['resistant_care'] == 1 ? '担心很快耐药' : '' .
                    $surveyData['explore_care'] == 1 ? '担心吃药后被人发现' : '' .
                    $surveyData['not_treatment'] == 1 ? '认为无法治愈，不治疗，任其自然' : '' .
                        $surveyData['treatment_other']
                );

                // 样式
                $objectPHPExcel->getActiveSheet()->getStyle('A' . ($surveyRow + 1) . ':F' . ($currentRow_EF))
                    ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            } else {
                //报表头的输出
                $surveyRow = 6;
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow) . ':F' . ($surveyRow));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow), '调研信息');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow))->getFont()->setSize(24);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $currentRow_BC = $currentRow_EF = 1;
                //明细的输出
                //基本信息
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow + (++$currentRow_BC)) . ':F' . ($surveyRow + (++$currentRow_EF)));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow + $currentRow_BC), '暂无调研信息');
            }

            $objectPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
            $objectPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);

            header('Content-Type : application/vnd.ms-excel');
            header('Content-Disposition:attachment;filename="' . '订单-调研信息' . date("Y年m月d日") . '.xls"');
            $objWriter = PHPExcel_IOFactory::createWriter($objectPHPExcel, 'Excel5');
            $objWriter->save('php://output');

        }
        $query = OrderList::find()->select("*");
        if ($logistics_id != '-99') {
            $query = $query->andWhere(['logistic_id' => $logistics_id]);
        }
        if ($ship_uuid != '-99') {
            $query = $query->andWhere(['ship_uuid' => $ship_uuid]);
        }
        if ($pay_status != '-99') {
            $query = $query->andWhere(['pay_status' => $pay_status]);
        }
        if ($order_status != '-99') {
            $query = $query->andWhere(['order_status' => $order_status]);
        }
        if ($adis_result != '-99') {
            $query = $query->andWhere(['adis_result' => $adis_result]);
        }
        if ($syphilis_result != '-99') {
            $query = $query->andWhere(['syphilis_result' => $syphilis_result]);
        }
        if ($hepatitis_b_result != '-99') {
            $query = $query->andWhere(['hepatitis_b_result' => $hepatitis_b_result]);
        }
        if ($hepatitis_c_result != '-99') {
            $query = $query->andWhere(['hepatitis_c_result' => $hepatitis_c_result]);
        }

        if ($ship_code) {
            $query = $query->andWhere(['like', 'ship_code', $ship_code]);
        }
        if ($wx_transaction_id) {
            $query = $query->andWhere(['like', 'wx_transaction_id', $wx_transaction_id]);
        }
        if ($address_contact) {
            $query = $query->andWhere(['like', 'address_contact', $address_contact]);
        }
        if ($address_mobile) {
            $query = $query->andWhere(['like', 'address_mobile', $address_mobile]);
        }

        $listData = $query
            ->leftJoin(UserEvent::tableName(),OrderList::tableName().'.uuid='.UserEvent::tableName().'.order_uuid')
            ->leftJoin(SurveyList::tableName(),'event_type_uuid='.SurveyList::tableName().'.uuid')
            ->orderBy([SurveyList::tableName().'.id' => SORT_DESC])->asArray()->all();
        $objectPHPExcel = new PHPExcel();
        $objectPHPExcel->setActiveSheetIndex(0);
        $n = 0;
        $column = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB', 'BC', 'BD', 'BE', 'BF', 'BG', 'BH', 'BI', 'BJ', 'BK', 'BL', 'BM', 'BN', 'BO', 'BP', 'BQ', 'BR', 'BS', 'BT', 'BU', 'BV', 'BW', 'BX', 'BY', 'BZ', 'CA', 'CB', 'CC', 'CD', 'CE', 'CF', 'CG', 'CH', 'CI', 'CJ', 'CK', 'CL', 'CM', 'CN', 'CO', 'CP', 'CQ', 'CR', 'CS', 'CT', 'CU', 'CV', 'CW'];
        $header = ['序号', '收货人', '电话', '详细地址', '订单标题', '订单说明',
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
            'address_contact',
            'address_mobile',
            'address_detail',
            'info',
            'description',
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
        $objectPHPExcel->getActiveSheet()->mergeCells('A1:CW1');
        $objectPHPExcel->getActiveSheet()->setCellValue('A1', '订单、调研列表');

        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', '订单、调研列表');
        $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', '订单、调研列表');
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(24);
        $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')
            ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //加粗
        $objectPHPExcel->getActiveSheet()->getStyle("A2:CW1")->getFont()->setBold(true);
        //设置居中
        $objectPHPExcel->getActiveSheet()->getStyle('A2:CW1')
            ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        //设置边框
        $objectPHPExcel->getActiveSheet()->getStyle('A2:CW1')
            ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

        //设置颜色
        $objectPHPExcel->getActiveSheet()->getStyle('A2:CW1')->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('137255255');

        foreach (array_combine($column, $header) as $k => $v) {
            $objectPHPExcel->getActiveSheet()->getColumnDimension($k)->setAutoSize(true);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue($k . '2', $v);
        }
        foreach ($listData as $data) {
            //明细的输出
            foreach (array_combine($column, $db_column) as $k => $v) {
                if( $v == 'id'){
                    $objectPHPExcel->getActiveSheet()->setCellValue($k . ($n + 3), $n + 1);
                }elseif ($v == 'partner_method'){
                    $objectPHPExcel->getActiveSheet()->setCellValue($k . ($n + 3),
                        (
                            $data['partner_sns']==1?'互联网（社交软件等）':' '.
                            $data['partner_bar']==1?'酒吧':' '.
                            $data['partner_ktv']==1?'KTV':' '.
                            $data['partner_park']==1?'公园':' '.
                            $data['partner_other']
                        )
                    );
                }elseif ( $v == 'where_can_check_HIV'){
                    $objectPHPExcel->getActiveSheet()->setCellValue($k . ($n + 3),
                        (
                        $data['detect_hospital']==1?'医院':' '.
                        $data['detect_jk_center']==1?'疾控中心':' '.
                        $data['detect_community']==1?'社区小组':' '.
                        $data['detect_drugstore']==1?'药店':' '.
                        $data['detect_clinic']==1?'个体诊所':' '.
                            $data['detect_other']
                        )
                    );
                }elseif ( $v == 'hope_check_channel'){
                    $objectPHPExcel->getActiveSheet()->setCellValue($k . ($n + 3),
                        (
                        $data['detect_channel_hospital']==1?'医院':' '.
                        $data['detect_channel_jk_center']==1?'疾控中心':' '.
                        $data['detect_channel_community']==1?'社区小组':' '.
                        $data['detect_channel_drugstore']==1?'药店':' '.
                        $data['detect_channel_clinic']==1?'个体诊所':' '.
                            $data['detect_channel_other']
                        )
                    );
                }elseif ( $v == 'attitude'){
                    $objectPHPExcel->getActiveSheet()->setCellValue($k . ($n + 3),
                        (
                        $data['active_treatment']==1?'积极接受治疗':''.
                        $data['unaccept_medical']==1?'担心药物副作用，暂不接受':''.
                        $data['treatment_until_standard']==1?'未到治疗标准就不用治疗':''.
                        $data['resistant_care']==1?'担心很快耐药':''.
                        $data['explore_care']==1?'担心吃药后被人发现':''.
                        $data['not_treatment']==1?'认为无法治愈，不治疗，任其自然':''.
                            $data['treatment_other']
                        )
                    );
                }else{
                    $value = $data[$v]==1?'是':($data[$v]==='0'?'否':$data[$v]);
                    $objectPHPExcel->getActiveSheet()->setCellValue($k . ($n + 3), $value);
                }
            }

            //设置边框
            $currentRowNum = $n + 4;
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 3) . ':CW' . $currentRowNum)
                ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 3) . ':CW' . $currentRowNum)
                ->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 3) . ':CW' . $currentRowNum)
                ->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 3) . ':CW' . $currentRowNum)
                ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 3) . ':CW' . $currentRowNum)
                ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $n = $n + 1;
        }

        //设置分页显示
        //$objectPHPExcel->getActiveSheet()->setBreak( 'I55' , PHPExcel_Worksheet::BREAK_ROW );
        //$objectPHPExcel->getActiveSheet()->setBreak( 'I10' , PHPExcel_Worksheet::BREAK_COLUMN );
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);

//        ob_end_clean();
//        ob_start();

        header('Content-Type : application/vnd.ms-excel');
        header('Content-Disposition:attachment;filename="' . '订单/调研列表-' . date("Y年m月d日") . '.xls"');
        $objWriter = PHPExcel_IOFactory::createWriter($objectPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
}