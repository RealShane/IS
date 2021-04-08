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

    public function commitPaper($data){
        $this -> examModel -> save([
            'class_id' => $data['class_id'],
            'title' => explode(".", $data['file'] -> getOriginalName())[0],
            'paper_answer' => $this -> excel -> read($data['file']),
            'close_time' => [
                'begin_time' => $data['begin_time'],
                'close_time' => $data['close_time']
            ]
        ]);
    }

    public function selectInfo(){

    }
}
