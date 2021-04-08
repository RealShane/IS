<?php


namespace app\common\business\admin;


use think\Model;

class Exam extends Model
{
    protected $table = 'api_exam_papers';

    protected $type = [
        'paper_answer'    =>  'json',
        'close_time'     =>  'json',
    ];

}