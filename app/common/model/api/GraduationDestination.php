<?php


namespace app\common\model\api;


use think\Model;

class GraduationDestination extends Model
{

    protected $table = 'api_graduation_destination';

    public function findByUid($uid){
        return $this -> where('uid', $uid) -> find();
    }

    public function updateRecord($data){
        $result = $this -> findByUid($data['uid']);
        return $result -> allowField([
            'examinee_number',
            'destination_code',
            'unit_code',
            'unit_name',
            'unit_property_code',
            'unit_location_code',
            'job_category_code',
            'unit_contact',
            'contact_phone'
        ]) -> save($data);
    }

}