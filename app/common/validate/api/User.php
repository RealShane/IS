<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/23 15:10
 */


namespace app\common\validate\api;


use think\Validate;

class User extends Validate
{

    protected $rule = [
        'email|邮箱' => ['require', 'email'],
        'password|密码' => ['require', 'max:20'],
        'name|姓名' => ['require', 'max:20'],
        'sex|性别' => ['require', 'between:0,1'],
        'student_id|学号' => ['require', 'max:255'],
        'random|六位验证码' => ['require', 'max:6'],
        'token' => ['require'],
        'invite_code|班级邀请码' => ['require'],
        'validate|验证码' => ['require', 'captcha']
    ];

    protected $scene = [
        'invite_code' => ['invite_code'],
        'type_password' => ['email', 'password', 'validate'],
        'type_email' => ['email', 'random', 'validate'],
        'send_email' => ['email', 'validate'],
        'change_password' => ['password', 'random'],
        'change_sex' => ['sex'],
        'active_register' => ['token'],
        'register' => ['email', 'password', 'name', 'sex', 'student_id', 'validate'],
    ];

}