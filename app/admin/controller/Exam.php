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

    public function commitPaper(){
        $data['class_id'] = $this -> request -> param('class_id', '', 'htmlspecialchars');
        $data['file'] = $this -> request -> file('file');
        echo json_encode($data['file'] -> getOriginalName());exit();
        $data['begin_time'] = $this -> request -> param('begin_time', '', 'htmlspecialchars');
        $data['close_time'] = $this -> request -> param('close_time', '', 'htmlspecialchars');
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