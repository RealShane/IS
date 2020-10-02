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

    public function findAll($num){
        return $this -> where('id', '>', 0)
            -> field(['id', 'name', 'rules', 'create_time', 'update_time', 'status'])
            -> paginate($num);
    }

    public function deleteById($id){
        return $this -> where('id', $id) -> delete();
    }

    public function updateByName($data){
        $result = $this -> findByName($data['name']);
        return $result -> allowField(['rules', 'update_time']) -> save($data);
    }

    public function findByName($name){
        return $this -> where('name', $name) -> find();
    }

    public function findById($id){
        return $this -> where('id', $id) -> where('status', 1) -> find();
    }

    public function findByIdWithOutStatus($id){
        return $this -> where('id', $id) -> find();
    }

}