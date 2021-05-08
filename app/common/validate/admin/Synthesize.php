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

class Synthesize extends Validate
{

    protected $rule = [
        'classId|班级id' => ['require'],
        'key|查找关键字' => ['require'],
        'token|token' => ['require'],
        'target|目标班级' => ['require'],
    ];

    protected $scene = [
        'exportCrossExcel' => ['classId', 'token'],
        'getTargetClass' => ['key'],
        'exportPoorSignExcel' => ['target', 'token'],
    ];

}