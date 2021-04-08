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


use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Excel
{

    private $excel = NULL;

    public function __construct(){
        $this -> excel = new Spreadsheet();
    }

    public function read($file){
        $io = IOFactory::load($file);
        $sheetCount = $io -> getSheetCount();
        echo json_encode($sheetCount);exit();
        $sheetSelected = 0;
        $io -> setActiveSheetIndex($sheetSelected);
        $rowCount = $objPHPExcel->getActiveSheet()->getHighestRow(); //获取表格行数
        $columnCount = $objPHPExcel->getActiveSheet()->getHighestColumn();//获取表格列数
        $dataArr = array();
        /* 循环读取每个单元格的数据 */
        for ($row = 1; $row <= $rowCount; $row++) {
            //列数循环 , 列数是以A列开始
            $n = 0;
            for ($column = 'A'; $column <= $columnCount; $column++) {
                $dataArr[$row][$column] = $objPHPExcel->getActiveSheet()->getCell($column . $row)->getValue();
            }
        }
        print_r($dataArr);exit;
        $data = array();
        foreach ($dataArr as $k => $v) {
            $data[$k]['uid']  = $dataArr[$k]['A'];
            $data[$k]['res'] = Db::name('wechat_user')->insert($data[$k]);
            $data[$k]['sql'] = Db::getLastSql();
        }
        print_r($data);exit;
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
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN
                        ]
                    ]
                ];
                if($item > 1000000000){
                    $this -> excel -> setActiveSheetIndex(0) -> setCellValueExplicit($alpha . $counter, $item, DataType::TYPE_STRING);
                    $this -> excel -> getActiveSheet() -> getStyle($alpha . $counter) -> getNumberFormat() -> setFormatCode(NumberFormat::FORMAT_TEXT);
                    $this -> excel -> getActiveSheet()  -> getStyle($alpha . $counter) -> applyFromArray($styleArray);
                    $alpha++;
                    continue;
                }
                $this -> excel -> setActiveSheetIndex(0) ->setCellValue($alpha . $counter, $item);
                $this -> excel -> getActiveSheet()  -> getStyle($alpha . $counter) -> applyFromArray($styleArray);
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

}