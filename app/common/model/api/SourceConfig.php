<?php


namespace app\common\model\api;


use think\Model;

class SourceConfig extends Model
{

    protected $table = "api_source_config";

    public function keyValue($key){
        return $this -> field('value') -> where('key', $key) -> where('status', 1) -> find();
    }

}