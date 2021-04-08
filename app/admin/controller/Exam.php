<?php


namespace app\admin\controller;


use app\BaseController;
use app\common\business\admin\Exam as examBusiness;
class Exam extends BaseController
{
    public function pushPaper(){
        $file = $this -> request -> file('file');
//        echo json_encode( $file->getFilename());exit;
//        $errCode = (new examBusiness()) -> pushPaper($file);

    }

}