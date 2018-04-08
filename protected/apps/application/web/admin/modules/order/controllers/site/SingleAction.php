<?php
/**
 * Created by PhpStorm.
 * User: gouki
 * Date: 18/4/8
 * Time: 上午10:33
 */

namespace application\web\admin\modules\order\controllers\site;
ini_set('memory_limit','1024M');
use application\models\base\Logistics;
use application\models\base\OrderList;
use application\models\base\SurveyList;
use application\models\base\UserEvent;
use application\web\admin\components\AdminBaseAction;
use PHPExcel;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use PHPExcel_IOFactory;

class SingleAction extends AdminBaseAction
{
    public function run()
    {
        if (\Yii::$app->request->isPost) {
            $uuid = \Yii::$app->request->post('uuid');
            $orderData = OrderList::find()->select("*")
                ->leftJoin(Logistics::tableName(),OrderList::tableName().'.logistic_id='.Logistics::tableName().'.id')
                ->andWhere(['uuid' => $uuid])->asArray()->one();
            $surveyData = SurveyList::find()
                ->leftJoin(UserEvent::tableName(), SurveyList::tableName() . '.uuid=' . UserEvent::tableName() . '.event_type_uuid')
                ->andWhere(['order_uuid' => $uuid])
                ->asArray()
                ->one();
            $objectPHPExcel = new PHPExcel();
            $objectPHPExcel->setActiveSheetIndex(0);
            $n = 0;
            //报表头的输出
            $objectPHPExcel->getActiveSheet()->mergeCells('A1:J1');
            $objectPHPExcel->getActiveSheet()->setCellValue('A1', '订单信息'.$orderData['created_at']);

            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', '订单信息'.$orderData['created_at']);
            $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(24);
            $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            //表格头的输出
            $objectPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', '序号');
            $objectPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(45);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', '发货地');
            $objectPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(45);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', '收货人');
            $objectPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(17);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('D2', '电话');
            $objectPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(22);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('E2', '详细地址');
            $objectPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('F2', '订单标题');
            $objectPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(65);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('G2', '订单说明');
            $objectPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('H2', '艾滋病检测结果');
            $objectPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('I2', '梅毒检测结果');
            //加粗
            $objectPHPExcel->getActiveSheet()->getStyle("A2:J2")->getFont()->setBold(true);
            //设置居中
            $objectPHPExcel->getActiveSheet()->getStyle('A2:J2')
                ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            //设置边框
            $objectPHPExcel->getActiveSheet()->getStyle('A2:J2')
                ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            //设置颜色
            $objectPHPExcel->getActiveSheet()->getStyle('A2:J2')->getFill()
                ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('3FD5C0');

            //明细的输出
            $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($n + 3), $n + 1);
            $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($n + 3), $orderData['title']          );
            $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($n + 3), $orderData['address_contact']);
            $objectPHPExcel->getActiveSheet()->setCellValue('D' . ($n + 3), $orderData['address_mobile'] );
            $objectPHPExcel->getActiveSheet()->setCellValue('E' . ($n + 3), $orderData['address_detail'] );
            $objectPHPExcel->getActiveSheet()->setCellValue('F' . ($n + 3), $orderData['info']           );
            $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($n + 3), $orderData['description']    );
            $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($n + 3), gCheckResult( $orderData['adis_result'] )    );
            $objectPHPExcel->getActiveSheet()->setCellValue('I' . ($n + 3), gCheckResult($orderData['syphilis_result'])   );
            //设置边框
            $objectPHPExcel->getActiveSheet()->getStyle('A' . ($n + 3) . ':J' . ($n + 3))
                ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            // 调研信息
            if ($surveyData) {
                //报表头的输出
                $surveyRow = 6;
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow) . ':J' . ($surveyRow));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow), '调研信息');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow))->getFont()->setSize(24);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


                $currentRow_BC = 2;
                //明细的输出
                //基本信息
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow + ($currentRow_BC)) . ':J' . ($surveyRow + ($currentRow_BC)));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow + $currentRow_BC), '基本信息');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))->getFont()->setSize(18);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '姓名或称呼');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['name']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '民族');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['nation']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '性别');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['gender']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '出生日期');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['birthday']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '文化程度');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['education']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '婚姻状况');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['marriage']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '职业');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['job'] . ' ' . $surveyData['job_other']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '收入');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['income']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '户籍地');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['household']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '现居地');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['livecity']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '居住时长');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['livetime']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), '');

                $currentRow_BC+=1;
                // 性行为情况
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow + ($currentRow_BC)) . ':J' . ($surveyRow + ($currentRow_BC)));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow + $currentRow_BC), '性行为情况');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))->getFont()->setSize(18);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '是否有过性行为');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['has_sex'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '第一次性行为年龄');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['sex_age']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '寻找性伴侣的方式');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['partner']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '寻找性伴侣的途径');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)),
                    $surveyData['partner_sns'] ? '互联网' : '' .
                    $surveyData['partner_bar'] ? '酒吧' : '' .
                    $surveyData['partner_ktv'] ? 'KTV' : '' .
                    $surveyData['partner_park'] ? '公园' : '' .
                        $surveyData['partner_other']
                );

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '常用性行为方式');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['sex_type']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '其他方式');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['sex_type_other']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '性取向');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['sex_direction']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '你近三个月内有过性行为吗');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['has_sex_3month'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '近三个月内您有多少个异性伙伴');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['hetero_partner_num']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '是否全程使用安全套');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['condom_full_use'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '在最近三个月没有全程使用安全套的比例');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['condom_percent']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '最近一次与异性发生性行为是否使用安全套');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['condom_near'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '最近一次是否未全程使用安全套');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['condom_full_use_not']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '是否有肛交行为');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['anal_sex'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                // 毒品使用情况
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow + ($currentRow_BC)) . ':J' . ($surveyRow + ($currentRow_BC)));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow + $currentRow_BC), '毒品使用情况');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))->getFont()->setSize(18);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '是否使用过毒品');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_use_drug'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '毒品类型');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['drug_type']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '毒品使用频率');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['drug_rate']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '近一个月使用过毒品');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['is_use_drug_near_month']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '近一个月使用毒品的频率');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['drug_near_month_num']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '注射过毒品');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['is_use_inject'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '最近一个月是否注射过毒品');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_use_inject_near_month'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '最近一个月注射毒品的频率');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['inject_near_month_num']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '曾经与别人是否共用过针具');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_use_pinhead'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '最近一个月注射毒品时是否与别人共用过针具');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['is_use_pinhead_near_month'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '最近一个月注射毒品时，与别人共用针具的频率如何');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['pinhead_near_month_num']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '最近三个月,是否有过吸食毒品后发生性行为');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['is_sex_after_drug_3month'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '在最近三个月与多少人是在吸食毒品后发生的性行为');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['sex_after_drug_3month_num']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '最近一个月,是否有过吸食毒品后发生性行为');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['is_sex_after_drug_1month'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '最近一个月,与多少人是在吸食毒品后发生的性行为');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['sex_after_drug_1month_num']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), '');

                $currentRow_BC+=1;
                // 结核和其他调查
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow + ($currentRow_BC)) . ':J' . ($surveyRow + ($currentRow_BC)));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow + $currentRow_BC), '结核和其他调查');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))->getFont()->setSize(18);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '咳嗽、咳痰持续2周以上');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['cough_2week'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '反复咳出的痰中带血');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['cough_withblood'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '咳嗽、咳痰持续2周以上');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['cough_2week'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '反复咳出的痰中带血');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['cough_withblood'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '夜间经常出汗');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['sweat_on_night'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '无法解思的体重明显下降');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['weight_downgrade'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '经常容易疲劳或呼吸短促');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['always_tired'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '反复发热持续2周以上');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['fever_2week'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '淋巴结肿大');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['lymphadenectasis'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '结核病人接触史');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['tuberculosis_contact_history'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '无结核相关症状');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['no_tuberculosis'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '结核病人接触史');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['tuberculosis_contact_history'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '最近是否做过结核检查（痰检或X胸片）');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_phthisic_checked'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '结核检测结果');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['phthisic_result']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '是否做过梅毒检查');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_syphilis'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '梅毒检测结果');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['syphilis_result']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '最近是否做过乙肝检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_hepatitis_b'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '乙肝检测结果');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['hepatitis_b_result']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '最近是否做过丙肝检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_hepatitis_c'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '丙肝检测结果');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['hepatitis_c_result']);

                $currentRow_BC+=1;
                // HIV快速检测
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow + ($currentRow_BC)) . ':J' . ($surveyRow + ($currentRow_BC)));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow + $currentRow_BC), 'HIV快速检测');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))->getFont()->setSize(18);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '既往检测机构');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)),
                    $surveyData['past_channel_hospital'] == 1 ? '医院' : '' .
                    $surveyData['past_channel_jk'] == 1 ? '疾控' : '' .
                    $surveyData['past_channel_self'] == 1 ? '自检' : '' .
                    $surveyData['past_channel_vct'] == 1 ? 'VCT门诊' : '' .
                    $surveyData['past_channel_community'] == 1 ? '社区组织' : '' .
                        $surveyData['past_channel_other']
                );

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '你知道本地哪里可以检测HIV');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)),
                    $surveyData['detect_hospital'] == 1 ? '&#10003;' : '' .
                    $surveyData['detect_hospital'] == 1 ? '医院' : '' .
                    $surveyData['detect_jk_center'] == 1 ? '疾控中心' : '' .
                    $surveyData['detect_community'] == 1 ? '社区小组' : '' .
                    $surveyData['detect_drugstore'] == 1 ? '药店' : '' .
                    $surveyData['detect_clinic'] == 1 ? '个体诊所' : '' .
                        $surveyData['detect_other']
                );
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '是否接受过HIV检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['is_accept_detect_hiv'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '接受过几次HIV检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['detect_num']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '最近一年内接受过几次HIV检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['detect_num_near_1year']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '最近6个月内接受过几次HIV检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['detect_num_near_6month']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '最近一次参加HIV检测日期');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['last_hiv_checkdate']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '是否知道自己最近一次的HIV检测结果');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_know_detect_result'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '最近一次主动检测HIV还是被动员检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['hiv_check_mode']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '最近一次参加检测的原因');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['hiv_check_reason']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '最近一次参加检测的其他原因');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['hiv_check_reason_other']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '最近一次通过何种方式参加HIV检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['last_hiv_check_mode']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '最近一次通过其他方式参加HIV检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['last_hiv_check_mode_other']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '对于参加HIV检测是否有顾虑');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['is_detect_care'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), 'HIV检测的主要顾虑是什么');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['hiv_check_care']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), 'HIV检测的其他顾虑是什么');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['hiv_check_care_other']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '你期望获得HIV检测的渠道');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)),
                    $surveyData['detect_channel_hospital'] == 1 ? '医院' : '' .
                    $surveyData['detect_channel_jk_center'] == 1 ? '疾控中心' : '' .
                    $surveyData['detect_channel_community'] == 1 ? '社区小组' : '' .
                    $surveyData['detect_channel_drugstore'] == 1 ? '药店' : '' .
                    $surveyData['detect_channel_clinic'] == 1 ? '个体诊所' : '' .
                        $surveyData['detect_channel_other']
                );

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '是否愿意获自费购买HIV检测试剂');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['detect_by_self'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '再次申请获得一次项目邮寄免费检测试剂');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['hiv_check_time']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '本次是否申请梅毒检测试剂');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['apply_for_free'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), '');

                $currentRow_BC+=1;
                // 配偶/性伴及其他检测
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow + ($currentRow_BC)) . ':J' . ($surveyRow + ($currentRow_BC)));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow + $currentRow_BC), '配偶/性伴及其他检测');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))->getFont()->setSize(18);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '配偶/性伴是否检测过HIV');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['partner_is_check_hiv']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '配偶/性伴的检测结果');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['partner_check_result']);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '是否愿意动员配偶/性伴进行HIV检测');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['partner_mobilize'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), '');

                $currentRow_BC+=1;
                // 转介及后续服务
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow + ($currentRow_BC)) . ':J' . ($surveyRow + ($currentRow_BC)));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow + $currentRow_BC), '转介及后续服务');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))->getFont()->setSize(18);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow + $currentRow_BC))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '提供进一步快检服务');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['fast_detect_service'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '提供确证和CD4检测机构信息');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['org_for_cd4'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '提供抗病毒治疗或相关医疗机构信息');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['org_therapy'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '提供性病诊断治疗机构信息');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['org_syphilis'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '提供机会性感染治疗及其他相关治疗机构信息');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['org_syphilis_other'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '提供心理咨询和帮助机构信息');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['org_psychological'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '提供母婴阻断机构信息');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['org_pmtct'] == 1 ? '是' : '否');
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '提供结核诊断治疗机构信息');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)), $surveyData['org_phthisis'] == 1 ? '是' : '否');

                $currentRow_BC+=1;
                $objectPHPExcel->getActiveSheet()->setCellValue('B' . ($surveyRow + ($currentRow_BC)), '其他服务');
                $objectPHPExcel->getActiveSheet()->setCellValue('C' . ($surveyRow + ($currentRow_BC)), $surveyData['org_other']);
                $objectPHPExcel->getActiveSheet()->setCellValue('G' . ($surveyRow + ($currentRow_BC)), '你对感染HIV后是否需要接受治疗的看法是');
                $objectPHPExcel->getActiveSheet()->setCellValue('H' . ($surveyRow + ($currentRow_BC)),
                    $surveyData['active_treatment'] == 1 ? '积极接受治疗' : '' .
                    $surveyData['unaccept_medical'] == 1 ? '担心药物副作用，暂不接受' : '' .
                    $surveyData['treatment_until_standard'] == 1 ? '未到治疗标准就不用治疗' : '' .
                    $surveyData['resistant_care'] == 1 ? '担心很快耐药' : '' .
                    $surveyData['explore_care'] == 1 ? '担心吃药后被人发现' : '' .
                    $surveyData['not_treatment'] == 1 ? '认为无法治愈，不治疗，任其自然' : '' .
                        $surveyData['treatment_other']
                );

                // 样式
                $objectPHPExcel->getActiveSheet()->getStyle('A' . ($surveyRow + 1) . ':J' . ($currentRow_BC))
                    ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

            } else {
                //报表头的输出
                $surveyRow = 6;
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow) . ':J' . ($surveyRow));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow), '调研信息');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow))->getFont()->setSize(24);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A' . ($surveyRow))
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $currentRow_BC =2;
                //明细的输出
                //基本信息
                $objectPHPExcel->getActiveSheet()->mergeCells('A' . ($surveyRow + ($currentRow_BC)) . ':J' . ($surveyRow + ($currentRow_BC)));
                $objectPHPExcel->getActiveSheet()->setCellValue('A' . ($surveyRow + $currentRow_BC), '暂无调研信息');
            }

            $objectPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
            $objectPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);

            header('Content-Type : application/vnd.ms-excel');
            header('Content-Disposition:attachment;filename="' . '订单-调研信息' . date("Y年m月d日") . '.xls"');
            $objWriter = PHPExcel_IOFactory::createWriter($objectPHPExcel, 'Excel5');
            $objWriter->save('php://output');

        }

    }

}