<?php


namespace app\api\controller;


use app\BaseController;
use app\common\business\api\Graduation as Business;
use app\common\validate\api\Graduation as Validate;
use think\App;

class Graduation extends BaseController
{

    protected $business = NULL;

    public function __construct(App $app, Business $business){
        parent::__construct($app);
        $this -> business = $business;
    }

    public function graduationRecord() {
        $data['examinee_number'] = $this -> request -> param('examinee_number', '', 'htmlspecialchars');
        $data['destination_code'] = $this -> request -> param('destination_code', '', 'htmlspecialchars');
        $data['unit_code'] = $this -> request -> param('unit_code', '', 'htmlspecialchars');
        $data['unit_name'] = $this -> request -> param('unit_name', '', 'htmlspecialchars');
        $data['unit_property_code'] = $this -> request -> param('unit_property_code', '', 'htmlspecialchars');
        $data['unit_location_code'] = $this -> request -> param('unit_location_code', '', 'htmlspecialchars');
        $data['job_category_code'] = $this -> request -> param('job_category_code', '', 'htmlspecialchars');
        $data['unit_contact'] = $this -> request -> param('unit_contact', '', 'htmlspecialchars');
        $data['contact_phone'] = $this -> request -> param('contact_phone', '', 'htmlspecialchars');
        $data['uid'] = $this -> getUid();
        try {
            validate(Validate::class) -> scene('record_' . $data['destination_code']) -> check($data);
        } catch (\Exception $exception) {
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> graduationRecord($data);
        return $this -> success("此毕业生信息写入成功!");
    }

    public function getGraduationRecord() {
        return $this -> success($this -> business -> getGraduationRecord($this -> getUser()));
    }

    public function downExcel() {
        $class_id = $this -> request -> param('class_id', '', 'htmlspecialchars');
        $this -> business -> downExcel($class_id);
    }

    public function getGraduationDestinationCode(){
        return $this -> success($this -> business -> getGraduationDestinationCode());
    }

}