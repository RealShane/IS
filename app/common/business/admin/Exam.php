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
        $this -> excel -> read()
        echo json_encode(name($file));
        echo json_encode($data);exit;




        foreach ($data as $k => $v) {
            $data[$k]['uid']  = $data[$k]['A'];
            $data[$k]['res'] = Db::name('wechat_user')->insert($data[$k]);
            $data[$k]['sql'] = Db::getLastSql();
        }
        print_r($data);exit;

    }
}