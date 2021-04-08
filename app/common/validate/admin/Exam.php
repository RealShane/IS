<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/30 14:37
 */


namespace app\common\validate\admin;


use think\Validate;

class Exam extends Validate
{

    protected $rule = [
        'class_id|班级id' => 'require',
        'file|文件' => 'require',
        'begin_time|开始时间' => 'require',
        'close_time|结束时间' => 'require',
    ];

    protected $scene = [
        'commitPaper' => ['class_id', 'file', 'begin_time', 'close_time'],
    ];

}