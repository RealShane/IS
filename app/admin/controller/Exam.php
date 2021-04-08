<?php


namespace app\admin\controller;


use app\BaseController;
use app\common\business\admin\Exam as examBusiness;
use app\common\validate\admin\User as Validate;

class Exam extends BaseController
{
    public function commitPaper(){
        $data['class_id'] = $this -> request -> param('class_id');
        $data['file'] = $this -> request -> file('file');
        $data['beginTime'] = $this -> request -> param('beginTime');
        $data['closeTime'] = $this -> request -> param('closeTime');
        try {
            validate(Validate::class) -> scene('commitPaper') -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        (new examBusiness()) -> commitPaper($data);
        return $this -> success("添加试卷成功！");
    }

}