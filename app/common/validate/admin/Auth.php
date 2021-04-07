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
        'uid|管理员ID' => 'require',
        'group|权限组ID' => 'require',
        'name|权限组/规则名' => 'require',
        'rules|规则' => 'require',
        'id' => 'require',
        'status|状态' => 'require'
    ];

    protected $scene = [
        'updateRule' => ['id', 'name', 'status'],
        'deleteGroup' => ['id'],
        'addGroup' => ['name', 'rules'],
        'deleteAccess' => ['id'],
        'addAccess' => ['uid', 'group']
    ];

}