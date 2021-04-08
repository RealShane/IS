<?php


namespace app\common\business\admin;


use app\common\business\lib\Excel;
use app\common\model\admin\Exam as examModel;
use app\common\business\admin\CRUD;
class Exam
{

    private $excel = NULL;
    private $examModel = NULL;
    private $crud = NULL;

    public function __construct(){
        $this -> excel = new Excel();
        $this -> examModel = new examModel();
        $this -> crud = new CRUD();
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

    public function selectAllClass(){
        $classes = $this -> crud -> setStore('api_class') -> all(['id', 'name']);
        foreach ($classes as $class){
            $data[] = [
                'id' => $class['id'],
                'name' => $class['name']
            ];
        }
        return json($data);

    }

    public function selectInfo(){


    }
}
