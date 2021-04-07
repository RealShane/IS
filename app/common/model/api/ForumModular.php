<?php


namespace app\common\model\api;


use think\Model;

class ForumModular extends Model
{

    protected $table = 'api_forum_modular';

    public function findAll(){
       return $this -> where('status',1) -> select();
    }

}