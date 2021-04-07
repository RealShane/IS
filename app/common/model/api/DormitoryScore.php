<?php


namespace app\common\model\api;


use think\Model;

class DormitoryScore extends Model
{

    protected $table = 'api_dormitory_score';

    public function findToday($data){
       return $this -> where('number_id', $data['number_id']) -> where('time_index', $data['time_index']) -> find();
    }

    public function updateGrade($data){
        $result = $this -> findToday($data);
        return $result -> allowField(['grade', 'image', 'update_time']) -> save($data);
    }

}