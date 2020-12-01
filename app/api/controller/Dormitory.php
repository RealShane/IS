<?php


namespace app\api\controller;


use app\BaseController;
use app\common\business\api\Dormitory as DormitoryBusiness;
use app\common\validate\api\Dormitory as DormitoryValidate;
use app\common\business\lib\Upload;

class Dormitory extends BaseController
{
    public function dormitoryRecord(){
        $data['number_id'] = $this -> request -> param('number_id', '', 'htmlspecialchars');
        $data['grade'] = $this -> request -> param('grade', '', 'htmlspecialchars');
        $data['image'] = $this -> request -> param('image', '', 'htmlspecialchars');
        $user = $this -> getUser();
        try {
            validate(DormitoryValidate::class) -> scene('score') -> check($data);
        } catch (\Exception $exception) {
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                $exception -> getMessage()
            );
        }
        $errCode = (new DormitoryBusiness()) -> dormitoryRecord($data, $user);
        if ($errCode == config('status.not_exist')) {
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                '没有权限'
            );
        }
        if ($errCode == config('status.failed')) {
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                '内部异常'
            );
        }
        return $this -> show(
            config('status.success'),
            config('message.success'),
            '评分成功'
        );


    }

    /**
     * 上传图片
     */
    public function dormitoryUpload(){
        $file = $this -> request -> file('file');
        $user = $this -> getUser();
        $saveName = (new Upload()) -> upload($user, $file, 'dormitory', '/dormitory/');
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $saveName
        );

    }

    public function getDormitoryRecord(){
        $data['class_id'] = $this -> request -> param('class_id', '', 'htmlspecialchars');
        $data['time_index'] = $this -> request -> param('time_index', '', 'htmlspecialchars');
        try {
            validate(DormitoryValidate::class) -> scene('getRecord') -> check($data);
        } catch (\Exception $exception) {
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                $exception -> getMessage()
            );
        }
        $errCode = (new DormitoryBusiness()) -> getDormitoryRecord($data);
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

    public function pushExcel(){
        $data['class_id'] = $this -> request -> param('class_id', '', 'htmlspecialchars');
        $data['time_index'] = $this -> request -> param('time_index', '', 'htmlspecialchars');
        try {
            validate(DormitoryValidate::class) -> scene('getRecord') -> check($data);
        } catch (\Exception $exception) {
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                $exception -> getMessage()
            );
        }
        $errCode = (new DormitoryBusiness()) -> pushExcel($data);
        return $this -> show(
            config('status.success'),
            config('message.success'),
            $errCode
        );
    }

    public function showAllFloorAndDormitory(){
        $errCode = (new DormitoryBusiness()) -> showAllFloorAndDormitory();
        return $this -> show(
            config('status.success'),
            config('message.success'),
            $errCode
        );
    }


}