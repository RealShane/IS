<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/29 21:40
 */


namespace app\common\business\lib;


use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Excel
{

    private $excel = NULL;

    public function __construct(){
        $this -> excel = new Spreadsheet();
    }

    public function push($title, $indexes, $data){
        $this -> excel -> getProperties() -> setCreator('Shane')
            ->setLastModifiedBy('Shane')
            ->setTitle($title)
            ->setSubject($title)
            ->setDescription($title)
            ->setKeywords("excel")
            ->setCategory("result file");
        $alpha = 'A';
        foreach ($indexes as $index){
            $this -> excel -> setActiveSheetIndex(0) -> setCellValue($alpha . '1', $index);
            $alpha++;
        }
        foreach($data as $key => $value){
            $counter = $key + 2;$alpha = 'A';
            foreach ($value as $item){
                $this -> excel -> setActiveSheetIndex(0) ->setCellValue($alpha . $counter, $item);
                $alpha++;
            }
        }
        $this -> excel  -> getActiveSheet() -> setTitle('Sheet1');
        $this -> excel  -> setActiveSheetIndex(0);

        header('Content-Type: application.ms-excel');
        header('Content-Disposition: attachment;filename="' . $title . '.xls"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        $objWriter = IOFactory::createWriter($this -> excel, 'Xls');
        $objWriter -> save('php://output');
        exit;
    }

    private function pus($title, $data, $user){

        $objPHPExcel = new Spreadsheet();

        $objPHPExcel->getProperties()->setCreator($user)
            ->setLastModifiedBy($user)
            ->setTitle($title)
            ->setSubject($title)
            ->setDescription($title)
            ->setKeywords("excel")
            ->setCategory("result file");

        $objPHPExcel -> setActiveSheetIndex(0) ->setCellValue('A'.'1', "自增id")->setCellValue('B'.'1', "班级id")->setCellValue('C'.'1', "班级名")->setCellValue('D'.'1', "年级")->setCellValue('E'.'1', "入学年份");

        foreach($data as $key => $value){

            $num = $key + 2;
            $id = isset($value['id']) ? $value['id'] : '';
            $classes_id = isset($value['classes_id']) ? $value['classes_id'] : '';
            $classes_name = isset($value['classes_name']) ? $value['classes_name'] : '';
            $grade = isset($value['grade']) ? $value['grade'] : '';
            $year = isset($value['year']) ? $value['year'] : '';
            $objPHPExcel -> setActiveSheetIndex(0)
                ->setCellValue('A'.$num, "$id")
                ->setCellValue('B'.$num, "$classes_id")
                ->setCellValue('C'.$num, "$classes_name")
                ->setCellValue('D'.$num, "$grade")
                ->setCellValue('E'.$num, "$year");

        }

        $objPHPExcel -> getActiveSheet() -> setTitle('User');
        $objPHPExcel -> setActiveSheetIndex(0);

        header('Content-Type: application.ms-excel');
        header('Content-Disposition: attachment;filename="'.$title.'.xls"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Xls');
        $objWriter -> save('php://output');
        exit;
    }

}