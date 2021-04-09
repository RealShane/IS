<?php


namespace app\common\business\admin;


use app\common\business\lib\Excel;
use app\common\model\admin\Exam as examModel;
use app\common\business\admin\CRUD;
use app\common\business\lib\Redis;
use app\common\business\lib\Str;

class Exam
{

    private $excel = NULL;
    private $examModel = NULL;
    private $crud = NULL;
    private $redis = NULL;
    private $str = NULL;

    public function __construct(){
        $this -> excel = new Excel();
        $this -> examModel = new examModel();
        $this -> crud = new CRUD();
        $this -> redis = new Redis();
        $this -> str = new Str();
    }

    public function readPaper($file){
        $token = $this -> str -> createToken($file -> getOriginalName());
        $this -> redis -> set($token, $this -> excel -> read($file), config('redis.file_expire'));
        return $token;
    }

    public function commitPaper($data){
        $this -> examModel -> save([
            'class_id' => $data['class_id'],
            'title' => explode(".", $data['file'] -> getOriginalName())[0],
            'paper_answer' => $this -> redis -> get($data['token']),
            'close_time' => [
                'begin_time' => $data['begin_time'],
                'close_time' => $data['close_time']
            ]
        ]);
    }

    public function selectAllClass(){

        return $this -> crud -> setStore('api_class') -> all(['id', 'name']);
    }

    public function selectInfo(){

    }
}
