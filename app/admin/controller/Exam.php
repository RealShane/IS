<?php


namespace app\admin\controller;


use app\BaseController;
use app\common\business\admin\Exam as Business;
use app\common\validate\admin\Exam as Validate;
use think\App;

class Exam extends BaseController
{

    protected $business = NULL;

    public function __construct(App $app, Business $business){
        parent::__construct($app);
        $this -> business = $business;
    }

    public function deletePaper(){
        echo 2;
        $id = $this -> request -> param('id', '', 'htmlspecialchars');
        echo 3;
        try {
            validate(Validate::class) -> scene('deletePaper') -> check(['id' => $id]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        echo 4;
        $this -> business -> deletePaper($id);
        return $this -> success("删除成功！");

    }

    public function getTargetPapers(){
        $title = $this -> request -> param('title', '', 'htmlspecialchars');
        $num = $this -> request -> param("num", 10, 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('getTargetPapers') -> check(['title' => $title]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> getTargetPapers($title, $num));
    }

    public function viewAllPapers(){
        $errCode = $this -> business -> viewAllPapers($this -> request -> param("num", 10, 'htmlspecialchars'));
        return $this -> success($errCode);
    }

    public function readPaper(){
        $file = $this -> request -> file('file');
        try {
            validate(Validate::class) -> scene('readPaper') -> check(['file' => $file]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> readPaper($file));
    }

    public function commitPaper(){
        $data['class_id'] = $this -> request -> param('class_id', '', 'htmlspecialchars');
        $data['token'] = $this -> request -> param('token', '', 'htmlspecialchars');
        $data['begin_time'] = $this -> request -> param('begin_time', NULL, 'htmlspecialchars');
        $data['close_time'] = $this -> request -> param('close_time', NULL, 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('commitPaper') -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> commitPaper($data);
        return $this -> success("添加试卷成功！");
    }

    public function selectAllClass(){
        return $this -> success($this -> business -> selectAllClass());
    }

}