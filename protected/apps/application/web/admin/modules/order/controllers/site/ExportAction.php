<?php
namespace application\web\admin\modules\order\controllers\site;
use application\models\base\OrderList;
use application\web\admin\components\AdminBaseAction;
use PHPExcel;
use PHPExcel_Style_Alignment;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use PHPExcel_IOFactory;

class ExportAction extends AdminBaseAction{
    public function run($logistics_id='-99',$ship_uuid='-99',$pay_status='',$order_status='-99',$ship_code ='', $wx_transaction_id='' ){
        $query = OrderList::find();
        if( $logistics_id != '-99' ){
            $query = $query->andWhere(['logistic_id'=>$logistics_id]);
        }
        if( $ship_uuid != '-99' ){
            $query = $query->andWhere(['ship_uuid'=>$ship_uuid]);
        }
        if( $pay_status != '-99' ){
            $query = $query->andWhere(['pay_status'=>$pay_status]);
        }
        if( $order_status != '-99' ){
            $query = $query->andWhere(['order_status'=>$order_status]);
        }
        if( $ship_code ){
            $query = $query->andWhere(['like','ship_code', $ship_code]);
        }
        if( $wx_transaction_id ){
            $query = $query->andWhere(['like','wx_transaction_id', $wx_transaction_id]);
        }
        $listData = $query->orderBy(['id'=>SORT_DESC])->asArray()->all();
//        dd( $listData);

        $objectPHPExcel = new PHPExcel();
        $objectPHPExcel->setActiveSheetIndex(0);
        $page_size = 5;
//        $count = count($listData);
//        $page_count = (int)($count/$page_size) +1;
        $current_page = 0;
        $n = 0;
        foreach ( $listData as $data )
        {
            if ( $n % $page_size === 0 )
            {
                $current_page = $current_page +1;

                //报表头的输出
                $objectPHPExcel->getActiveSheet()->mergeCells('A1:F1');
                $objectPHPExcel->getActiveSheet()->setCellValue('A1','订单列表');

                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','订单列表');
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','订单列表');
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')->getFont()->setSize(24);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('A1')
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

//                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','日期：'.date("Y年m月d日"));
//                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('G2','第'.$current_page.'/'.$page_count.'页');
//                $objectPHPExcel->setActiveSheetIndex(0)->getStyle('G2')
//                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

                //表格头的输出

                $objectPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('A2','序号');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(6.5);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','收货人');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(17);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('C2','电话');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(22);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('D2','详细地址');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('E2','订单标题');
                $objectPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('F2','订单说明');
//                $objectPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
                //加粗
                $objectPHPExcel->getActiveSheet()->getStyle("A2:F2")->getFont()->setBold(true);
                //设置居中
                $objectPHPExcel->getActiveSheet()->getStyle('A2:F2')
                    ->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

                //设置边框
                $objectPHPExcel->getActiveSheet()->getStyle('A2:F2' )
                    ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('A2:F2' )
                    ->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('A2:F2' )
                    ->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('A2:F2' )
                    ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
                $objectPHPExcel->getActiveSheet()->getStyle('A2:F2' )
                    ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

                //设置颜色
                $objectPHPExcel->getActiveSheet()->getStyle('A2:F2')->getFill()
                    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('3FD5C0');

            }
            //明细的输出
            $objectPHPExcel->getActiveSheet()->setCellValue('A'.($n+3) ,$n+1);
            $objectPHPExcel->getActiveSheet()->setCellValue('B'.($n+3) ,$data['address_contact']);
            $objectPHPExcel->getActiveSheet()->setCellValue('C'.($n+3) ,$data['address_mobile']);
            $objectPHPExcel->getActiveSheet()->setCellValue('D'.($n+3) ,$data['address_detail']);
            $objectPHPExcel->getActiveSheet()->setCellValue('E'.($n+3) ,$data['info']);
            $objectPHPExcel->getActiveSheet()->setCellValue('F'.($n+3) ,$data['description']);
            //设置边框
            $currentRowNum = $n+4;
            $objectPHPExcel->getActiveSheet()->getStyle('A'.($n+3).':F'.$currentRowNum )
                ->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A'.($n+3).':F'.$currentRowNum )
                ->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A'.($n+3).':F'.$currentRowNum )
                ->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A'.($n+3).':F'.$currentRowNum )
                ->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('A'.($n+3).':F'.$currentRowNum )
                ->getBorders()->getVertical()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $n = $n +1;
        }

        //设置分页显示
        //$objectPHPExcel->getActiveSheet()->setBreak( 'I55' , PHPExcel_Worksheet::BREAK_ROW );
        //$objectPHPExcel->getActiveSheet()->setBreak( 'I10' , PHPExcel_Worksheet::BREAK_COLUMN );
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);

//        ob_end_clean();
//        ob_start();

        header('Content-Type : application/vnd.ms-excel');
        header('Content-Disposition:attachment;filename="'.'订单列表-'.date("Y年m月d日").'.xls"');
        $objWriter= PHPExcel_IOFactory::createWriter($objectPHPExcel,'Excel5');
        $objWriter->save('php://output');
    }
}