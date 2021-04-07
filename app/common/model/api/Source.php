<?php


namespace app\common\model\api;


use think\Model;

class Source extends Model
{

    protected $table = 'api_source';

    public function findByUid($uid){
        return $this -> where('uid', $uid) -> find();
    }

    public function updateRecord($data){
        $result = $this -> findByUid($data['uid']);
        return $result -> allowField([
            'id_number',
            'graduate_school',
            'source',
            'poor_code',
            'mobile_phone',
            'qq',
            'home_address',
            'home_phone',
        ]) -> save($data);
    }

    public function selectByUid($uid){
        return $this -> where('uid', $uid) -> select();
    }

}