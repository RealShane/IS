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

    protected $table = "api_user";

    public function changePassword($data){
        $result = $this -> findByIdWithStatus($data['user']['id']);
        return $result -> allowField(['password', 'password_salt']) -> save($data);
    }

    public function changeSex($data){
        $result = $this -> findByIdWithStatus($data['user']['id']);
        return $result -> allowField(['sex']) -> save($data);
    }

    public function findByStudentId($studentId){
        return $this -> where('student_id', $studentId) -> find();
    }

    public function updateLoginInfo($data){
        $result = $this -> findByEmail($data['email']);
        return $result -> allowField(['last_login_ip', 'last_login_time', 'last_login_token']) -> save($data);
    }

    public function findByIdWithStatus($id){
        return $this -> where('id', $id) -> where('status', 1) -> find();
    }

    public function findByEmail($email){
        return $this -> where('email', $email) -> find();
    }

    public function findByEmailWithStatus($email){
        return $this -> where('email', $email) -> where('status', 1) -> find();
    }

}