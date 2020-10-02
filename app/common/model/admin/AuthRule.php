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

/**后台权限规则模型
 * Class AuthAccess
 * @package app\common\model\admin
 */

class AuthRule extends Model
{

    protected $name = 'z_admin_auth_rule';

    public function findMenuAndView($num){
        return $this -> where('id', '>', 0)
            -> where('is_menu', 1)
            -> whereOr('is_view', 1)
            -> field(['id', 'name', 'icon', 'pid', 'weigh', 'status'])
            -> paginate($num);
    }

    public function updateById($data){
        $result = $this -> findByIdWithOutStatus($data['id']);
        return $result -> allowField(['name', 'icon', 'weigh', 'status']) -> save($data);
    }

    public function findById($id){
        return $this -> where('id', $id) -> where('status', 1) -> find();
    }

    public function findByIdWithOutStatus($id){
        return $this -> where('id', $id) -> find();
    }

}