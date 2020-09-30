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

class User extends Validate
{

    protected $rule = [
        'username' => 'require',
        'target' => 'require',
        'password' => 'require',
        'status' => 'require',
//        'validate' => 'require|captcha'
    ];

    protected $message = [
        'username.require' => '用户名不为空！',
        'password.require' => '密码不为空！',
        'validate.require' => '验证码不为空！',
        'validate.captcha' => '验证码不正确！',
        'target.require' => '目标不为空！',
        'status.require' => '状态不为空！',
    ];

    protected $scene = [
        'updateAdmin' => ['target', 'username', 'status'],
        'changePassword' => ['target', 'password'],
        'addAdmin' => ['username', 'password'],
        'login' => ['username', 'password', 'validate']
    ];

}