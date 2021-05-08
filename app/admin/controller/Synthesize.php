<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/10/6 8:32
 */


namespace app\admin\controller;


use app\BaseController;
use app\common\business\admin\Synthesize as Business;
use think\App;
use app\common\validate\admin\Synthesize as validate;

class Synthesize extends BaseController
{

    protected $business = NULL;

    public function __construct(App $app, Business $business){
        parent::__construct($app);
        $this -> business = $business;
    }

    public function exportCrossExcel(){
        $uid = $this -> getParamUid();
        $classId = $this -> request -> param("target", 10, 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('exportCrossExcel') -> check(['classId' => $classId, 'token' => $uid]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> exportCrossExcel($classId);
    }

    public function getTargetClass(){
        $key = $this -> request -> param("key", '', 'htmlspecialchars');
        $num = $this -> request -> param("num", 10, 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('getTargetClass') -> check(['key' => $key]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> getTargetClass($key, $num));
    }
    public function getAllClass(){
        $num = $this -> request -> param("num", 10, 'htmlspecialchars');
        return $this -> success($this -> business -> getAllClass($num));
    }

    public function exportPoorSignExcel(){
        $uid = $this -> getParamUid();
        $class_id = $this -> request -> param("target", '', 'htmlspecialchars');
        echo json_encode($class_id);exit();
        try {
            validate(Validate::class) -> scene('exportPoorSignExcel') -> check(['key' => $class_id, 'token' => $uid]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> exportPoorSignExcel($class_id));
    }

    public function showClasses(){
        $errCode = (new Business()) -> showClasses();
        if (empty($errCode)){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "内部异常，请稍候重试！"
            );
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $errCode
        );
    }

}