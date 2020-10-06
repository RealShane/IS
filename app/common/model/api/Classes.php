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

/**班级模型
 * Class Classes
 * @package app\common\model\api
 */

class Classes extends Model
{

    protected $name = "api_class";

    public function findByIdWithStatus($id){
        return $this -> where('id', $id) -> where('status', 1) -> find();
    }

    public function findById($id){
        return $this -> where('id', $id) -> find();
    }

    public function findByInviteCode($inviteCode){
        return $this -> where('invite_code', $inviteCode) -> where('join_status', 1) -> find();
    }

}