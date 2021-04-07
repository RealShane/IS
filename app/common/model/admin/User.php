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

use think\facade\Db;
use think\Model;

/**管理员模型
 * Class User
 * @package app\common\model\admin
 */

class User extends Model
{

    protected $name = 'z_admin_user';

    public function deleteAdmin($target){
        Db::startTrans();
        try {
            $this -> where('id', $target) -> delete();
            (new AuthAccess()) -> where('uid', $target) -> delete();
            Db::commit();
        } catch (\Exception $exception) {
            Db::rollback();
        }
    }

    public function getTargetAdmin($username){
        return $this -> where('username', $username)
            -> field(['id', 'username', 'last_login_ip', 'last_login_time', 'create_time', 'update_time', 'status'])
            -> find();
    }

    public function findAll($num){
        return $this -> where('id', '>', 0)
            -> field(['id', 'username', 'last_login_ip', 'last_login_time', 'create_time', 'update_time', 'status'])
            -> paginate($num);
    }

    public function updateAdmin($data){
        $result = $this -> findById($data['target']);
        return $result -> allowField(['username', 'status', 'update_time']) -> save($data);
    }

    public function changePassword($data){
        $result = $this -> findById($data['target']);
        return $result -> allowField(['password', 'password_salt', 'update_time']) -> save($data);
    }

    public function updateLoginInfo($data){
        $result = $this -> findByUserNameWithStatus($data['username']);
        return $result -> allowField(['last_login_ip', 'last_login_time', 'last_login_token']) -> save($data);
    }

    public function findByUserNameWithStatus($username){
        return $this -> where('username', $username) -> where('status', 1) -> find();
    }

    public function findByUserName($username){
        return $this -> where('username', $username) -> find();
    }

    public function findById($id){
        return $this -> where('id', $id) -> find();
    }

    public function findAllWithOutPaginate(){
        return $this -> where('status', 1)
            -> field(['id', 'username'])
            -> select();
    }

}