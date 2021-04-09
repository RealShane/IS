<?php


namespace app\common\validate\api;


use think\Validate;

class Exam extends Validate
{

    protected $rule = [
        'paper_id|试卷id' => ['require'],
    ];

    protected $scene = [
        'showPaper' => ['paper_id'],
    ];

}