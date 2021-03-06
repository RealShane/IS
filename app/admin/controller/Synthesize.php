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

    public function setConfig(){
        $data['POOR_SIGN_OPTION'] = $this -> request -> param("POOR_SIGN_OPTION", '', 'htmlspecialchars');
        $data['POOR_SIGN_STATUS'] = $this -> request -> param("POOR_SIGN_STATUS", '', 'htmlspecialchars');
        $data['CROSS_STATUS'] = $this -> request -> param("CROSS_STATUS", '', 'htmlspecialchars');
        $data['POOR_SIGN_MARK_STATUS'] = $this -> request -> param("POOR_SIGN_MARK_STATUS", '', 'htmlspecialchars');
        $data['POOR_SCORE_STATUS'] = $this -> request -> param("POOR_SCORE_STATUS", '', 'htmlspecialchars');
        $data['POOR_MARK_COUNT_STATUS'] = $this -> request -> param("POOR_MARK_COUNT_STATUS", '', 'htmlspecialchars');
        $data['LEADER_SIGN_STATUS'] = $this -> request -> param("LEADER_SIGN_STATUS", '', 'htmlspecialchars');
        $data['LEADER_SCORE_STATUS'] = $this -> request -> param("LEADER_SCORE_STATUS", '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('setConfig') -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> setConfig($data);
        return $this -> success('保存成功！');
    }

    public function getAllConfig(){
        return $this -> success($this -> business -> getAllConfig());
    }

    public function exportCrossExcel(){
        $uid = $this -> getParamUid();
        $classId = $this -> request -> param("target", '', 'htmlspecialchars');
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

    public function exportLeaderExcel(){
        $uid = $this -> getParamUid();
        $classId = $this -> request -> param("target", '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('exportLeaderExcel') -> check(['classId' => $classId, 'token' => $uid]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> exportLeaderExcel($classId);
    }

    public function exportPoorSignScoreExcel(){
        $uid = $this -> getParamUid();
        $classId = $this -> request -> param("target", '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('exportPoorSignScoreExcel') -> check(['classId' => $classId, 'token' => $uid]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> exportPoorSignScoreExcel($classId);
    }

    public function exportPoorSignExcel(){
        $uid = $this -> getParamUid();
        $class_id = $this -> request -> param("target", '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('exportPoorSignExcel') -> check(['target' => $class_id, 'token' => $uid]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> exportPoorSignExcel($class_id);
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