<?php


namespace app\common\model\api;


use think\Model;

class SourceConfig extends Model
{
    protected $name = "api_source_config";

    public function findByKey($key){
        return $this -> field('value') -> where('key', $key) -> where('status', 1) -> find();
    }

}