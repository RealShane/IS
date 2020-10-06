<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/10/6 8:35
 */


namespace app\common\business\admin;

use app\common\business\lib\Excel;
use app\common\business\lib\Str;
use app\common\model\admin\Synthesize as SynthesizeModel;
use think\facade\Db;

class Synthesize
{

    private $synthesizeModel = NULL;
    private $strLib = NULL;
    private $excelLib = NULL;

    public function __construct(){
        $this -> synthesizeModel = new SynthesizeModel();
        $this -> strLib = new Str();
        $this -> excelLib = new Excel();
    }

    public function exportPoorSignExcel($type){
        if ($type == 'ALL'){
            return $this -> exportAllPoorSignExcel();
        }
        if ($type == 'CLASS'){
            return $this -> exportPoorSignExcelByClass();
        }
        return NULL;
    }

    private function exportPoorSignExcelByClass(){
        try {
            $classIndex = Db::query("SHOW FULL FIELDS FROM api_class");
            $departmentIndex = Db::query("SHOW FULL FIELDS FROM api_department");
            $userIndex = Db::query("SHOW FULL FIELDS FROM api_user");
            $signIndex = Db::query("SHOW FULL FIELDS FROM api_synthesize_poor_sign");
            $indexes = [
                "序号",
                $departmentIndex[1]['Comment'],
                $classIndex[1]['Comment'],
                $classIndex[3]['Comment'],
                $classIndex[2]['Comment'],
                $userIndex[4]['Comment'],
                $userIndex[5]['Comment'],
                $signIndex[2]['Comment'],
                $userIndex[6]['Comment'],
                $signIndex[3]['Comment'],
                $signIndex[4]['Comment'],
                $signIndex[5]['Comment'],
                $signIndex[6]['Comment'],
                $signIndex[7]['Comment'],
                $signIndex[8]['Comment'],
                $signIndex[9]['Comment'],
                $signIndex[10]['Comment'],
                $signIndex[11]['Comment'],
                $signIndex[12]['Comment'],
                $signIndex[13]['Comment'],
                $signIndex[14]['Comment'],
                $signIndex[15]['Comment'],
                $signIndex[16]['Comment'],
                $signIndex[17]['Comment'],
                $signIndex[18]['Comment'],
                $signIndex[19]['Comment'],
                $signIndex[20]['Comment'],
            ];
            $classes = (new \app\common\model\api\Classes()) -> findAll();
            foreach ($classes as $class){
                $temp = (new \app\common\model\api\UserClass()) -> findAllByClassId($class['id']);
                $department = (new \app\common\model\api\Department()) -> findById($class['depart_id']);
                $data = [];
                foreach ($temp as $key){
                    $user = (new \app\common\model\api\User()) -> findById($key['uid']);
                    $sign = $this -> synthesizeModel -> findByUid($key['uid']);
                    $user['sex'] = $this -> strLib -> convertSex($user['sex']);
                    $sign['poor_type_one'] = $this -> strLib -> convertIs($sign['poor_type_one']);
                    $sign['poor_type_two'] = $this -> strLib -> convertIs($sign['poor_type_two']);
                    $sign['poor_type_three'] = $this -> strLib -> convertIs($sign['poor_type_three']);
                    $sign['poor_type_four'] = $this -> strLib -> convertIs($sign['poor_type_four']);
                    $sign['poor_type_five'] = $this -> strLib -> convertIs($sign['poor_type_five']);
                    $sign['poor_type_six'] = $this -> strLib -> convertIs($sign['poor_type_six']);
                    $sign['poor_type_seven'] = $this -> strLib -> convertIs($sign['poor_type_seven']);
                    $sign['poor_type_eight'] = $this -> strLib -> convertIs($sign['poor_type_eight']);
                    $data[] = [
                        'id' => 1,
                        'department' => $department['name'],
                        'grade' => $class['grade'],
                        'charge' => $class['charge'],
                        'class' => $class['name'],
                        'name' => $user['name'],
                        'sex' => $user['sex'],
                        'political_outlook' => $sign['political_outlook'],
                        'student_id' => $user['student_id'],
                        'id_card_type' => $sign['id_card_type'],
                        'id_card_number' => $sign['id_card_number'],
                        'confirm_level' => $sign['confirm_level'],
                        'poor_type_one' => $sign['poor_type_one'],
                        'poor_type_two' => $sign['poor_type_two'],
                        'poor_type_three' => $sign['poor_type_three'],
                        'poor_type_four' => $sign['poor_type_four'],
                        'poor_type_five' => $sign['poor_type_five'],
                        'poor_type_six' => $sign['poor_type_six'],
                        'poor_type_seven' => $sign['poor_type_seven'],
                        'poor_type_eight' => $sign['poor_type_eight'],
                        'confirm_time' => $sign['confirm_time'],
                        'confirm_reason' => $sign['confirm_reason'],
                        'confirm_reason_explain' => $sign['confirm_reason_explain'],
                        'address' => $sign['address'],
                        'home_phone' => $sign['home_phone'],
                        'contact_phone' => $sign['contact_phone'],
                        'remark' => $sign['remark']
                    ];
                }
                $this -> excelLib -> push('贫困生报名' . $class['name'], $indexes, $data);
            }
            exit;
        }catch (\Exception $exception){
            return NULL;
        }
    }

    private function exportAllPoorSignExcel(){
        try {
            $signs = $this -> synthesizeModel -> findAll();
            $data = [];
            foreach ($signs as $sign){
                $temp = (new \app\common\model\api\UserClass()) -> findByUid($sign['uid']);
                $class = (new \app\common\model\api\Classes()) -> findById($temp['class_id']);
                $department = (new \app\common\model\api\Department()) -> findById($class['depart_id']);
                $user = (new \app\common\model\api\User()) -> findById($sign['uid']);
                $user['sex'] = $this -> strLib -> convertSex($user['sex']);
                $sign['poor_type_one'] = $this -> strLib -> convertIs($sign['poor_type_one']);
                $sign['poor_type_two'] = $this -> strLib -> convertIs($sign['poor_type_two']);
                $sign['poor_type_three'] = $this -> strLib -> convertIs($sign['poor_type_three']);
                $sign['poor_type_four'] = $this -> strLib -> convertIs($sign['poor_type_four']);
                $sign['poor_type_five'] = $this -> strLib -> convertIs($sign['poor_type_five']);
                $sign['poor_type_six'] = $this -> strLib -> convertIs($sign['poor_type_six']);
                $sign['poor_type_seven'] = $this -> strLib -> convertIs($sign['poor_type_seven']);
                $sign['poor_type_eight'] = $this -> strLib -> convertIs($sign['poor_type_eight']);
                $data[] = [
                    'id' => 1,
                    'department' => $department['name'],
                    'grade' => $class['grade'],
                    'charge' => $class['charge'],
                    'class' => $class['name'],
                    'name' => $user['name'],
                    'sex' => $user['sex'],
                    'political_outlook' => $sign['political_outlook'],
                    'student_id' => $user['student_id'],
                    'id_card_type' => $sign['id_card_type'],
                    'id_card_number' => $sign['id_card_number'],
                    'confirm_level' => $sign['confirm_level'],
                    'poor_type_one' => $sign['poor_type_one'],
                    'poor_type_two' => $sign['poor_type_two'],
                    'poor_type_three' => $sign['poor_type_three'],
                    'poor_type_four' => $sign['poor_type_four'],
                    'poor_type_five' => $sign['poor_type_five'],
                    'poor_type_six' => $sign['poor_type_six'],
                    'poor_type_seven' => $sign['poor_type_seven'],
                    'poor_type_eight' => $sign['poor_type_eight'],
                    'confirm_time' => $sign['confirm_time'],
                    'confirm_reason' => $sign['confirm_reason'],
                    'confirm_reason_explain' => $sign['confirm_reason_explain'],
                    'address' => $sign['address'],
                    'home_phone' => $sign['home_phone'],
                    'contact_phone' => $sign['contact_phone'],
                    'remark' => $sign['remark']
                ];
            }
            $classIndex = Db::query("SHOW FULL FIELDS FROM api_class");
            $departmentIndex = Db::query("SHOW FULL FIELDS FROM api_department");
            $userIndex = Db::query("SHOW FULL FIELDS FROM api_user");
            $signIndex = Db::query("SHOW FULL FIELDS FROM api_synthesize_poor_sign");
            $indexes = [
                "序号",
                $departmentIndex[1]['Comment'],
                $classIndex[1]['Comment'],
                $classIndex[3]['Comment'],
                $classIndex[2]['Comment'],
                $userIndex[4]['Comment'],
                $userIndex[5]['Comment'],
                $signIndex[2]['Comment'],
                $userIndex[6]['Comment'],
                $signIndex[3]['Comment'],
                $signIndex[4]['Comment'],
                $signIndex[5]['Comment'],
                $signIndex[6]['Comment'],
                $signIndex[7]['Comment'],
                $signIndex[8]['Comment'],
                $signIndex[9]['Comment'],
                $signIndex[10]['Comment'],
                $signIndex[11]['Comment'],
                $signIndex[12]['Comment'],
                $signIndex[13]['Comment'],
                $signIndex[14]['Comment'],
                $signIndex[15]['Comment'],
                $signIndex[16]['Comment'],
                $signIndex[17]['Comment'],
                $signIndex[18]['Comment'],
                $signIndex[19]['Comment'],
                $signIndex[20]['Comment'],
            ];
            return $this -> excelLib -> push('贫困生报名(全部信息)', $indexes, $data);
        }catch (\Exception $exception){
            return NULL;
        }
    }

}