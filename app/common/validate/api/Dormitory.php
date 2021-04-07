<?php


namespace app\common\validate\api;


use think\Validate;

class Dormitory extends Validate
{

    protected $rule =   [
        'number_id|宿舍id' => 'require',
        'grade|成绩' => 'require',
        'class_id|班级id' => 'require',
        'time_index|日期' => 'require',

    ];

    protected $scene = [
        'score'  =>  ['number_id', 'grade'],
        'getRecord' => ['class_id', 'time_index'],
        'getByTime' => ['time_index'],
    ];

}