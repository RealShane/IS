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
        'username|用户名' => 'require',
        'target|目标' => 'require',
        'password|密码' => 'require',
        'status|状态' => 'require',
        'validate|验证码' => 'require|captcha'
    ];

    protected $scene = [
        'deleteAdmin' => ['target'],
        'updateAdmin' => ['target', 'username', 'status'],
        'changePassword' => ['target', 'password'],
        'addAdmin' => ['username', 'password'],
        'login' => ['username', 'password', 'validate']
    ];

}