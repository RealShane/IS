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
        $datas = [
            'class_id' => $data['class_id'],
            'title' => $data['file']->getOriginalName(),
            'paper_answer' => $this->excel->read($data['file']),
            'close_time' => [
                'beginTime' => $data['beginTime'],
                'closeTime' => $data['closeTime']
            ],
            'create_time' => time(),
            'update_time' => time()
        ];
        $this->userModel->save($datas);
    }
}
