<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/23 15:33
 */


namespace app\common\model\api;


use think\Model;

/**用户模型
 * Class User
 * @package app\common\model\api
 */

class User extends Model
{

    protected $name = "api_user";

    public function updateLoginInfo($data){
        $result = $this -> findByEmail($data['email']);
        return $result -> allowField(['last_login_ip', 'last_login_time', 'last_login_token']) -> save($data);
    }

    public function findById($id){
        return $this -> where('id', $id) -> where('status', 1) -> find();
    }

    public function findByEmail($email){
        return $this -> where('email', $email) -> where('status', 1) -> find();
    }

    public function findByEmailWithOutStatus($email){
        return $this -> where('email', $email) -> find();
    }

}