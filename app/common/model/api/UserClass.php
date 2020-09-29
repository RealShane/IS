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

/**用户班级关系模型
 * Class UserClass
 * @package app\common\model\api
 */

class UserClass extends Model
{

    protected $name = "api_user_class";

    public function findByUid($uid){
        return $this -> where('uid', $uid) -> find();
    }

}