<?php


namespace app\admin\controller;


use app\BaseController;
use app\common\business\admin\Exam as examBusiness;
class Exam extends BaseController
{
    public function commitPaper(){
        $file = $this -> request -> file('file');
        echo json_encode( $file -> getFilename());
        $errCode = (new examBusiness()) -> commitPaper($file);
    }

}