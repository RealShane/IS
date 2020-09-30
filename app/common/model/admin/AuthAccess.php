<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/30 15:13
 */


namespace app\common\model\admin;


use think\Model;

/**管理员权限分配模型
 * Class AuthAccess
 * @package app\common\model\admin
 */

class AuthAccess extends Model
{

    protected $name = 'z_admin_auth_access';

    public function findByUserName($username){
        return $this -> where('username', $username) -> find();
    }

}