<?php


namespace app\api\controller;


use app\BaseController;
use app\common\business\api\Graduation as GraduationBusiness;
use app\common\validate\api\Graduation as GraduationValidate;

class Graduation extends BaseController
{

    public function graduationRecord() {
        $user = $this -> getUser();
        $data['examinee_number'] = $this -> request -> param('examinee_number', '', 'htmlspecialchars');
        $data['destination_code'] = $this -> request -> param('destination_code', '', 'htmlspecialchars');
        $data['unit_code'] = $this -> request -> param('unit_code', '', 'htmlspecialchars');
        $data['unit_name'] = $this -> request -> param('unit_name', '', 'htmlspecialchars');
        $data['unit_property_code'] = $this -> request -> param('unit_property_code', '', 'htmlspecialchars');
        $data['unit_location_code'] = $this -> request -> param('unit_location_code', '', 'htmlspecialchars');
        $data['job_category_code'] = $this -> request -> param('job_category_code', '', 'htmlspecialchars');
        $data['unit_contact'] = $this -> request -> param('unit_contact', '', 'htmlspecialchars');
        $data['contact_phone'] = $this -> request -> param('contact_phone', '', 'htmlspecialchars');
        $data['uid'] = $user['id'];
        try {
            validate(GraduationValidate::class) -> scene('record_' . $data['destination_code']) -> check($data);
        } catch (\Exception $exception) {
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                $exception -> getMessage()
            );
        }
        $errCode = (new GraduationBusiness()) -> graduationRecord($data);
        if ($errCode == config('status.close')){
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                '该功能处于关闭状态！'
            );
        }
        if ($errCode == config('status.failed')){
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                '内部异常'
            );
        }
        return $this -> show(
            config('status.success'),
            config('message.success'),
            '此毕业生信息写入成功'
        );
    }

    public function getGraduationRecord() {
        $user = $this -> getUser();
        $errCode = (new GraduationBusiness()) -> getGraduationRecord($user);
        if ($errCode == config('status.not_exist')){
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                '此毕业生信息不存在！'
            );
        }
        if ($errCode == config('status.failed')){
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                '内部异常！'
            );
        }
        return $this -> show(
            config('status.success'),
            config('message.success'),
            $errCode
        );
    }

    public function downExcel() {
        $class_id = $this -> request -> param('class_id', '', 'htmlspecialchars');
        $errCode = (new GraduationBusiness()) -> downExcel($class_id);
        if ($errCode == config('status.not_exist')){
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                '该班级不存在或未定义'
            );
        }
        if (empty($errCode)){
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                '内部异常'
            );
        }

        return $this -> show(
            config('status.success'),
            config('message.success'),
            $errCode
        );
    }

    public function getGraduationDestinationCode(){
        $errCode = (new GraduationBusiness()) -> getGraduationDestinationCode();
        if ($errCode == config('status.failed')){
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                '内部异常！'
            );
        }
        return $this -> show(
            config('status.success'),
            config('message.success'),
            $errCode
        );
    }

}