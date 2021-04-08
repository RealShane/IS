<?php


namespace app\common\business\admin;


use app\common\business\lib\Excel;
use app\common\model\admin\Exam as examModel;
class Exam
{

    private $excel = NULL;
    private $examModel = NULL;

    public function __construct(){
        $this -> excel = new Excel();
        $this -> examModel = new examModel();
    }

    public function commitPaper($file){
        $data = $this -> excel -> read($file);

    }
}