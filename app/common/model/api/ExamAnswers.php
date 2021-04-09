<?php


namespace app\common\model\api;


use think\Model;

class ExamAnswers extends Model
{

    protected $table = 'api_exam_answers';

    protected $type = [
        'answer'    =>  'json',
    ];



}