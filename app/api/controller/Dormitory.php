<?php


namespace app\api\controller;


use app\BaseController;
use app\common\business\api\Dormitory as Business;
use app\common\validate\api\Dormitory as Validate;
use app\common\business\lib\Upload;
use think\App;

class Dormitory extends BaseController
{

    protected $business = NULL;
    protected $upload = NULL;

    public function __construct(App $app, Business $business, Upload $upload){
        parent::__construct($app);
        $this -> business = $business;
        $this -> upload = $upload;
    }

    public function dormitoryRecord(){
        $data['number_id'] = $this -> request -> param('number_id', '', 'htmlspecialchars');
        $data['grade'] = $this -> request -> param('grade', '', 'htmlspecialchars');
        $data['image'] = $this -> request -> param('image', '', 'htmlspecialchars');
        $user = $this -> getUser();
        try {
            validate(Validate::class) -> scene('score') -> check($data);
        } catch (\Exception $exception) {
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> dormitoryRecord($data, $user);
        return $this -> success("弄好了！");
    }

    public function dormitoryUpload(){
        $file = $this -> request -> file('file');
        $saveName = $this -> upload -> upload($this -> getUser(), $file, 'dormitory', '/dormitory/');
        return $this -> success($saveName);
    }

    public function getDormitoryRecord(){
        $data['class_id'] = $this -> request -> param('class_id', '', 'htmlspecialchars');
        $data['time_index'] = $this -> request -> param('time_index', '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('getRecord') -> check($data);
        } catch (\Exception $exception) {
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> getDormitoryRecord($data));
    }

    public function pushExcel(){
        $data['class_id'] = $this -> request -> param('class_id', '', 'htmlspecialchars');
        $data['time_index'] = $this -> request -> param('time_index', '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('getRecord') -> check($data);
        } catch (\Exception $exception) {
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> pushExcel($data);
    }

    public function showAllFloorAndDormitory(){
        return $this -> success($this -> business -> showAllFloorAndDormitory());
    }


}