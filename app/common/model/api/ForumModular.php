<?php


namespace app\common\model\api;


use think\Model;

class ForumModular extends Model
{
    protected $name = 'api_forum_modular';
    public function findAll(){
       return $this -> where('id','>', 0) -> where('status',1) -> select();
    }
}