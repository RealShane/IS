<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/30 14:34
 */


namespace app\common\model\admin;


use think\Model;

/**管理员模型
 * Class User
 * @package app\common\model\admin
 */

class User extends Model
{

    protected $name = 'z_admin_user';

    public function updateLoginInfo($data){
        $result = $this -> findByUserName($data['username']);
        return $result -> allowField(['last_login_ip', 'last_login_time', 'last_login_token']) -> save($data);
    }

    public function findByUserName($username){
        return $this -> where('username', $username) -> where('status', 1) -> find();
    }

    public function findByUserNameWithOutStatus($username){
        return $this -> where('username', $username) -> find();
    }

}