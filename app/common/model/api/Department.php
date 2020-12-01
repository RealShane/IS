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

/**学部模型
 * Class Department
 * @package app\common\model\api
 */

class Department extends Model
{

    protected $name = "api_department";

    public function findAll(){
        return $this -> where('id', '>', 0) -> where('status', 1) -> select();
    }

    public function findById($id){
        return $this -> where('id', $id) -> find();
    }

}