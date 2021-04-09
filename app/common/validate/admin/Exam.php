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
        'file|文件' => 'file',
        'token' => 'require'
    ];

    protected $scene = [
        'commitPaper' => ['class_id', 'token'],
        'readPaper' => ['file']
    ];

}