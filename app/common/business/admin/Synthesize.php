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
use app\common\model\api\Classes;
use think\facade\Db;
use app\common\model\api\SynthesizeCross;
use app\common\model\api\UserClass;
class Synthesize
{

    private $synthesizeModel = NULL;
    private $strLib = NULL;
    private $excelLib = NULL;
    private $classesModel = NULL;
    private $synthesizeCrossModel = NULL;
    private $userClassModel = NULL;

    public function __construct(){
        $this -> strLib = new Str();
        $this -> excelLib = new Excel();
        $this -> classesModel = new Classes();
        $this -> synthesizeCrossModel = new SynthesizeCross();
        $this -> userClassModel = new UserClass();
    }

    public function exportCrossExcel($classId){
        $class = $this -> classesModel -> findById($classId);
        $title = $class['name'] . "综测评分表";
        //$results = $this -> synthesizeCrossModel -> findByUidAndTarget();
        $id = 1;
        $res = [];
        $user = [];
        $e = [];
        $sum = 0;
        $avgScore = 0;
        $infos = $this -> userClassModel -> findAllByClassId($classId);
        foreach ($infos as $key){
            $e[] = $key['uid'];
        }
        $cout = $this -> userClassModel -> countByClass($classId);
        //echo json_encode($e);exit();

        $n = 0;
        foreach ($infos as $info) {
            $userName = $this -> userClassModel -> findByUidWithUser($info['uid'])['user']['name'];
            foreach ($e as $item) {
                $results = $this -> synthesizeCrossModel -> findByUidAndTarget($info['uid'], $item);
                if ($info['uid'] = $item || $results['score'] == null || empty($results)) {
                    $results['score'] = 0;
                }
                $tem[] =  $results['score'];
                $sum += $results['score'];
                $avgScore = $sum / $cout;
            }
            $temp = [
                'id' => $id,
                'target' => $userName,
            ];
            for ($i = 0; $i < $cout; $i++){
                $temp['rater' . $i] = $tem[$i];
            }
            $temp['avgScore'] = 1;
            $temp['sumScore'] = 1;
            $res[] = $temp;

            $user[] = $userName;

            $id++;

        }

        $count = $cout + 2;
        $indexes[0] = '序号';
        $indexes[1] = '被评分人';
        $j = 0;
        for ($i = 2; $i < $count; $i++){
            $indexes[$i] = $user[$j++];
        }
        $indexes[$count + 1] = '平均分';
        $indexes[$count + 2] = '总分';
//    echo json_encode($cout);exit();
        $this -> excelLib -> push($title, $indexes, $res);
    }

    public function getAllClass($num){
        return $this -> classesModel -> getAllClasses($num);
    }

    public function exportPoorSignExcel($type, $class_id){
        if ($type == 'ALL'){
            return $this -> exportAllPoorSignExcel();
        }
        if ($type == 'CLASS'){
            $class = (new \app\common\model\api\Classes()) -> findByIdWithStatus($class_id);
            if (empty($class)){
                return NULL;
            }
            return $this -> exportPoorSignExcelByClass($class);
        }
        return NULL;
    }

    public function showClasses(){
        try {
            return (new \app\common\model\api\Classes()) -> findAll();
        }catch (\Exception $exception){
            return NULL;
        }
    }

    private function exportPoorSignExcelByClass($class){
        try {
            $indexes = $this -> getPoorSignIndexes();
            $temp = (new \app\common\model\api\UserClass()) -> findAllByClassId($class['id']);
            $department = (new \app\common\model\api\Department()) -> findById($class['depart_id']);
            $data = [];
            foreach ($temp as $key){
                $user = (new \app\common\model\api\User()) -> findById($key['uid']);
                $sign = $this -> synthesizeModel -> findByUid($key['uid']);
                if (empty($sign) || empty($key) || empty($department) || empty($user)){
                    continue;
                }
                $data[] = $this -> packPoorSignData($department, $user, $sign, $class);
            }
            $this -> excelLib -> push('贫困生报名-' . $class['name'], $indexes, $data);
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
                if (empty($temp) || empty($class) || empty($department) || empty($user)){
                    continue;
                }
                $data[] = $this -> packPoorSignData($department, $user, $sign, $class);
            }
            $indexes = $this -> getPoorSignIndexes();
            return $this -> excelLib -> push('贫困生报名(全部信息)', $indexes, $data);
        }catch (\Exception $exception){
            return NULL;
        }
    }

    private function packPoorSignData($department, $user, $sign, $class){
        $user['sex'] = $this -> strLib -> convertSex($user['sex']);
        $sign['poor_type_one'] = $this -> strLib -> convertIs($sign['poor_type_one']);
        $sign['poor_type_two'] = $this -> strLib -> convertIs($sign['poor_type_two']);
        $sign['poor_type_three'] = $this -> strLib -> convertIs($sign['poor_type_three']);
        $sign['poor_type_four'] = $this -> strLib -> convertIs($sign['poor_type_four']);
        $sign['poor_type_five'] = $this -> strLib -> convertIs($sign['poor_type_five']);
        $sign['poor_type_six'] = $this -> strLib -> convertIs($sign['poor_type_six']);
        $sign['poor_type_seven'] = $this -> strLib -> convertIs($sign['poor_type_seven']);
        $sign['poor_type_eight'] = $this -> strLib -> convertIs($sign['poor_type_eight']);
        return [
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

    private function getPoorSignIndexes(){
        $classIndex = Db::query("SHOW FULL FIELDS FROM api_class");
        $departmentIndex = Db::query("SHOW FULL FIELDS FROM api_department");
        $userIndex = Db::query("SHOW FULL FIELDS FROM api_user");
        $signIndex = Db::query("SHOW FULL FIELDS FROM api_synthesize_poor_sign");
        return [
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
    }

}