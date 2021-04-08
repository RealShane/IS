<?php


namespace app\common\business\admin;


use app\common\business\lib\Excel;
use app\common\model\admin\Exam as examModel;
class Exam
{
    private $excelLib = NULL;
    private $examModel = NULL;
    public function __construct(){
        $this -> excelLib = new Excel();
        $this -> examModel = new examModel();
    }
    public function pushPaper($file){
//        $data = $this -> excelLib -> read($file);

    }
}