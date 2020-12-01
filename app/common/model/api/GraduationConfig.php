<?php


namespace app\common\model\api;


use think\Model;

class GraduationConfig extends Model
{
    protected $name = "api_graduation_config";

    public function findByKey($key){
        return $this -> field('value') -> where('key', $key) -> where('status', 1) -> find();
    }

}