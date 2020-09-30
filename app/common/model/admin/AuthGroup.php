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

/**管理员权限组模型
 * Class AuthAccess
 * @package app\common\model\admin
 */

class AuthGroup extends Model
{

    protected $name = 'z_admin_auth_group';

    public function findById($id){
        return $this -> where('id', $id) -> where('status', 1) -> find();
    }

}