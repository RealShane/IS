<?php


namespace app\admin\controller;


use app\BaseController;
use app\common\business\lib\Excel;
class Exam extends BaseController
{
    public function pushPaper(){
        $file = $this -> request -> file('file');
        (new Excel()) -> read($file);

    }

}