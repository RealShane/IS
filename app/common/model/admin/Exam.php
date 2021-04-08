<?php


namespace app\common\model\admin;


use think\Model;

class Exam extends Model
{
    protected $table = 'api_exam_papers';

    protected $type = [
        'paper_answer'    =>  'json',
        'close_time'     =>  'json',
    ];


}