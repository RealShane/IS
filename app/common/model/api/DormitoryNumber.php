<?php


namespace app\common\model\api;


use think\Model;

class DormitoryNumber extends Model
{

    protected $table = 'api_dormitory_number';

    public function findById($id){
        return $this -> where('id', $id) -> find();
    }

    public function findByClassId($class_id){
        return $this -> where('class_id', $class_id) -> select();
    }

    public function findByFloor($floor_id){
        return $this -> where('floor_id', $floor_id) -> select();
    }

}