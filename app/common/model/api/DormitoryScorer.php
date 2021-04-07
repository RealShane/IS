<?php


namespace app\common\model\api;


use think\Model;

class DormitoryScorer extends Model
{

    protected $table = 'api_dormitory_scorer';

    public function findById($scorer_id){
        return $this -> where('user_id', $scorer_id) -> find();
    }

}