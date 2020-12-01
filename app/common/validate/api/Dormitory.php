<?php


namespace app\common\validate\api;


use think\Validate;

class Dormitory extends Validate
{
    protected $rule =   [
        'number_id' => 'require',
        'grade' => 'require',
        'class_id' => 'require',
        'time_index' => 'require',

    ];

    protected $message  =   [
        'number_id.require' => '宿舍id必须',
        'grade.require' => '成绩必须',
        'class_id.require' => '班级名必须',
        'time_index.require' => '日期必须',
    ];

    protected $scene = [
        'score'  =>  ['number_id', 'grade'],
        'getRecord' => ['class_id', 'time_index'],
        'getByTime' => ['time_index'],
    ];

}