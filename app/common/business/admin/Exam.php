<?php


namespace app\common\business\admin;


use app\common\business\lib\Excel;
use app\common\model\api\ExamPapers;
use app\common\business\admin\CRUD;
use app\common\business\lib\Redis;
use app\common\business\lib\Str;
use think\Exception;

class Exam
{

    private $excel = NULL;
    private $examPapersModel = NULL;
    private $crud = NULL;
    private $redis = NULL;
    private $str = NULL;

    public function __construct(){
        $this -> excel = new Excel();
        $this -> examPapersModel = new ExamPapers();
        $this -> crud = new CRUD();
        $this -> redis = new Redis();
        $this -> str = new Str();
    }

    public function editPaper($id){
        return $this -> examPapersModel -> editPaper($id);
    }

    public function deletePaper($id){
        $this -> examPapersModel -> delPaper($id);
    }

    public function getTargetPapers($title, $num){
        return $this -> examPapersModel -> selectTitle($title, $num);
    }

    public function viewAllPapers($num){
        return $this -> examPapersModel -> findAll($num);
    }

    public function readPaper($file){
        $token = $this -> str -> createToken($file -> getOriginalName());
        $this -> redis -> set($token, [
            'name' => explode(".", $file -> getOriginalName())[0],
            'data' => $this -> excel -> read($file)
        ], config('redis.file_expire'));
        return $token;
    }

    public function commitPaper($data){
        $redis = $this -> redis -> get($data['token']);
        $this -> examPapersModel -> save([
            'class_id' => $data['class_id'],
            'title' => $redis['name'],
            'paper_answer' => $redis['data'],
            'close_time' => [
                'begin_time' => $data['begin_time'],
                'close_time' => $data['close_time']
            ]
        ]);
    }

    public function selectAllClass(){

        return $this -> crud -> setStore('api_class') -> all(['id', 'name']);
    }


}
