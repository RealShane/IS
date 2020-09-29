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
        'email' => 'require|email',
        'password' => 'require|max:20',
        'name' => 'require|max:20',
        'sex' => 'require|integer',
        'student_id' => 'require|max:255',
        'random' => 'require|max:20',
        'token' => 'require',
        'invite_code' => 'require',
//        'validate' => 'require|captcha'
    ];

    protected $message = [
        'email.require' => '邮箱不为空!',
        'email.email' => '邮箱格式不正确!',
        'password.require' => '密码不为空!',
        'password.max' => '密码不超过20个字符!',
        'name.require' => '姓名不为空!',
        'name.max' => '姓名不超过20个字符!',
        'sex.require' => '性别不为空!',
        'sex.integer' => '性别数据格式不正确!',
        'student_id.require' => '学号不为空!',
        'student_id.max' => '学号不超过255个字符!',
        'random.require' => '随机码不为空!',
        'random.max' => '随机码不超过20个字符!',
        'token.require' => '非法请求!',
        'invite_code.require' => '班级邀请码不为空!',
        'validate.require' => '验证码不为空!',
        'validate.captcha' => '验证码错误!'
    ];

    protected $scene = [
        'invite_code' => ['invite_code'],
        'type_password' => ['email', 'password', 'validate'],
        'type_email' => ['email', 'random', 'validate'],
        'send_email' => ['email', 'validate'],
        'active_register' => ['token'],
        'register' => ['email', 'password', 'name', 'sex', 'student_id', 'validate'],
    ];

}