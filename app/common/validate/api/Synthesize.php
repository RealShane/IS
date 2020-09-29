<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/25 9:52
 */


namespace app\common\validate\api;


use think\Validate;

class Synthesize extends Validate
{

    protected $rule = [
        'email' => 'require|email',
    ];

    protected $message = [
        'email.require' => '邮箱不为空!',
    ];

    protected $scene = [
        'register' => ['email'],
    ];

}