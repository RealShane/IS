<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/10/1 11:17
 */


namespace app\common\validate\admin;


use think\Validate;

class Auth extends Validate
{

    protected $rule = [
        'uid' => 'require',
        'group' => 'require',
        'name' => 'require',
        'rules' => 'require',
        'id' => 'require'
    ];

    protected $message = [
        'uid.require' => '管理员ID不为空！',
        'group.require' => '权限组ID不为空！',
        'name.require' => '权限组名不为空！',
        'rules.require' => '规则不为空！',
        'id.require' => 'id不为空！'
    ];

    protected $scene = [
        'deleteGroup' => ['id'],
        'addGroup' => ['name', 'rules'],
        'deleteAccess' => ['id'],
        'addAccess' => ['uid', 'group']
    ];

}