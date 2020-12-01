<?php


namespace app\common\model\api;


use think\Model;

class DormitoryFloor extends Model
{
    protected $name = 'api_dormitory_floor';
    public function findById($id){
        return $this -> where('id', $id) -> find();
    }
    public function findAll(){
        return $this -> where('id','>', 0) -> select();
    }
}