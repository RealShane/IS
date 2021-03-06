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

use app\common\business\lib\Config;
use app\common\business\lib\Excel;
use app\common\business\lib\Str;
use app\common\model\api\Classes;
use app\common\model\api\SynthesizePoorScore;
use app\common\model\api\SynthesizeLeaderSign;
use app\common\model\api\SynthesizeLeaderScore;
use think\facade\Db;
use app\common\model\api\SynthesizeCross;
use app\common\model\api\SynthesizePoorSign;
use app\common\model\api\UserClass;
use app\common\model\api\SynthesizeConfig;
use app\common\model\api\Department;
class Synthesize
{
    private $config = NULL;
    private $strLib = NULL;
    private $excelLib = NULL;
    private $classesModel = NULL;
    private $synthesizeCrossModel = NULL;
    private $synthesizePoorSignModel = NULL;
    private $synthesizePoorScoreModel = NULL;
    private $synthesizeLeaderScoreModel = NULL;
    private $synthesizeLeaderSignModel = NULL;
    private $userClassModel = NULL;
    private $synthesizeConfigModel = NULL;
    private $departmentModel = NULL;

    public function __construct() {
        $this -> config = new Config();
        $this -> strLib = new Str();
        $this -> excelLib = new Excel();
        $this -> classesModel = new Classes();
        $this -> synthesizeCrossModel = new SynthesizeCross();
        $this -> synthesizePoorSignModel = new SynthesizePoorSign();
        $this -> synthesizePoorScoreModel = new SynthesizePoorScore();
        $this -> synthesizeLeaderScoreModel = new SynthesizeLeaderScore();
        $this -> synthesizeLeaderSignModel = new SynthesizeLeaderSign();
        $this -> userClassModel = new UserClass();
        $this -> synthesizeConfigModel = new SynthesizeConfig();
        $this -> departmentModel = new Department();
    }

    public function setConfig($data){
        foreach ($data as $key => $value){
            $info = $this -> synthesizeConfigModel -> findByKey($key);
            if ($key == 'POOR_SIGN_OPTION'){
                $info -> save(['value' => $value]);
                continue;
            }
            $info -> save(['value' => (int)$value]);
        }
    }

    public function getAllConfig(){
        $value = [];
        $infos =  $this -> synthesizeConfigModel -> selectAll();
        foreach ($infos as $info){
            $value[] = $info['value'];
        }
        return [
            'POOR_SIGN_OPTION' => $value[0],
            'POOR_SIGN_STATUS' => $value[1],
            'CROSS_STATUS' => $value[2],
            'POOR_SIGN_MARK_STATUS' => $value[3],
            'POOR_SCORE_STATUS' => $value[4],
            'POOR_MARK_COUNT_STATUS' => $value[5],
            'LEADER_SIGN_STATUS' => $value[6],
            'LEADER_SCORE_STATUS' => $value[7],
        ];
    }

    public function exportCrossExcel($classId) {
        $class = $this -> classesModel -> findById($classId);
        $title = $class['name'] . "综测评分表";
        $id = 1;
        $res = [];
        $infos = $this -> userClassModel -> findAllByClassId($classId);
        $cout = $this -> userClassModel -> countByClass($classId);
        foreach ($infos as $info) {
            $userName = $this -> userClassModel -> findByUidWithUser($info['uid'])['user']['name'];
            $tem = [];
            $sum = 0;
            $avgScore = 0;
            $notScore = [];
            foreach ($infos as $item) {
                $results = $this -> synthesizeCrossModel -> findByUidAndTarget($item['uid'], $info['uid']);
                if ($info['uid'] == $item['uid']) {
                    $results['score'] = null;
                }
                if (empty($results)) {
                    $name = $this -> userClassModel -> findByUidWithUser($item['uid'])['user']['name'];
                    $notScore[] = $name;
                    $results['score'] = null;
                }
                $tem[] = $results['score'];
                $sum += $results['score'];
                $avgScore = $sum / ($cout - 1);
            }
            $temp = [
                'id' => $id,
                'target' => $userName,
            ];
            $temp['notScore'] = implode(",", $notScore);
            for ($i = 0; $i < $cout; $i++) {
                $temp['rater' . $i] = $tem[$i];
            }
            $temp['avgScore'] = $avgScore;
            $temp['sumScore'] = $sum;
            $res[] = $temp;
            $id++;
        }
        $this -> excelLib -> push($title, $this -> packScoreData($infos, $cout)['indexes'], $res);
    }

    public function getTargetClass($key, $num) {
        return $this -> classesModel -> getClasses($key, $num);
    }

    public function getAllClass($num) {
        return $this -> classesModel -> getAllClasses($num);
    }

    public function exportLeaderExcel($classId) {
        $class = $this -> classesModel -> findById($classId);
        $title = $class['name'] . "班委打分表";
        $id = 1;
        $res = [];
        $infos = $this -> userClassModel -> findAllByClassId($classId);
        $cout = $this -> userClassModel -> countByClass($classId);
        $signs = $this -> synthesizeLeaderSignModel -> seletAll();
        foreach ($signs as $item) {
            $notScore = [];
            $tem = [];
            $avgScore = 0;
            $sum = 0;
            if ($this -> userClassModel -> findByUid($item['uid'])['class_id'] != $class['id']){
                continue;
            }
            $userName = $this -> synthesizeLeaderSignModel -> findByUid($item['uid']);
            foreach ($infos as $info) {
                $results = $this -> synthesizeLeaderScoreModel -> findByUidAndTarget($info['uid'], $item['uid']);
                if ($item['uid'] == $info['uid']) {
                    $results['mark'] = null;
                }
                if (empty($results)) {
                    $name = $this -> userClassModel -> findByUidWithUser($info['uid'])['user']['name'];
                    $notScore[] = $name;
                    $results['mark'] = null;
                }
                $tem[] = $results['mark'];
                $sum += $results['mark'];
                $avgScore = $sum / ($cout - 1);
            }
            $temp = [
                'id' => $id,
                'target' => $userName['user']['name'],
                'job' => $userName['job'],
                'notScore' => implode(",", $notScore)
            ];
            for ($i = 0; $i < $cout; $i++) {
                $temp['rater' . $i] = $tem[$i];
            }
            $temp['avgScore'] = $avgScore;
            $temp['sumScore'] = $sum;
            $id++;
            $res[] = $temp;
        }

        $user = [];
        foreach ($infos as $info) {
            $user[] = $this -> userClassModel -> findByUidWithUser($info['uid'])['user']['name'];
        }
        $count = $cout + 4;
        $indexes[0] = '序号';
        $indexes[1] = '被评分人';
        $indexes[2] = '职位';
        $indexes[3] = '未打分人';
        for ($i = 4, $j = 0; $i < $count; $i++) {
            $indexes[$i] = $user[$j++];
        }
        $indexes[$count + 1] = '平均分';
        $indexes[$count + 2] = '总分';

        $this -> excelLib -> push($title, $indexes, $res);

    }



    public function exportPoorSignScoreExcel($classId) {
        $class = $this -> classesModel -> findById($classId);
        $title = $class['name'] . "贫困生投票/打分表";
        $id = 1;
        $res = [];
        $user = [];
        $infos = $this -> userClassModel -> findAllByClassId($classId);
        $cout = $this -> userClassModel -> countByClass($classId);
        $signs = $this -> synthesizePoorSignModel -> seletAll();
        $type = $this -> config -> getSynthesizePoorSignMarkOption();
        if ($type == 0) {
            foreach ($signs as $item) {
                $notScore = [];
                $tem = [];
                $avgScore = 0;
                $sum = 0;
                if ($this -> userClassModel -> findByUid($item['uid'])['class_id'] != $class['id']){
                    continue;
                }
                $userName = $this -> synthesizePoorSignModel -> findByUid($item['uid'])['user']['name'];
                foreach ($infos as $info) {
                    $results = $this -> synthesizePoorScoreModel -> findByUidAndTarget($info['uid'], $item['uid']);
                    if ($item['uid'] == $info['uid']) {
                        $results['mark'] = null;
                    }
                    if (empty($results)) {
                        $name = $this -> userClassModel -> findByUidWithUser($info['uid'])['user']['name'];
                        $notScore[] = $name;
                        $results['mark'] = null;
                    }
                    $tem[] = $results['mark'];
                    $sum += $results['mark'];
                    $avgScore = $sum / ($cout - 1);
                }
                $temp = [
                    'id' => $id,
                    'target' => $userName,
                    'notScore' => implode(",", $notScore)
                ];
                for ($i = 0; $i < $cout; $i++) {
                    $temp['rater' . $i] = $tem[$i];
                }
                $temp['avgScore'] = $avgScore;
                $temp['sumScore'] = $sum;
                $id++;
                $res[] = $temp;
        }
            $this -> excelLib -> push($title, $this -> packScoreData($infos, $cout)['indexes'], $res);
        }
        if ($type == 1) {
            foreach ($signs as $item) {
                $tem = [];
                $num = 0;
                if ($this -> userClassModel -> findByUid($item['uid'])['class_id'] != $class['id']){
                    continue;
                }
                $userName = $this -> synthesizePoorSignModel -> findByUid($item['uid'])['user']['name'];
                foreach ($infos as $info) {
                    $results = $this -> synthesizePoorScoreModel -> findByUidAndTarget($info['uid'], $item['uid']);
                    if (empty($results) || $results['mark'] == 0) {
                        $results['mark'] = '×';
                    }
                    if ($results['mark'] == 1){
                        $results['mark'] = '√';
                        $num ++;
                    }
                    if ($item['uid'] == $info['uid']) {
                        $results['mark'] = null;
                    }
                    $tem[] = $results['mark'];
                }
                $temp = [
                    'id' => $id,
                    'target' => $userName,
                ];
                for ($i = 0; $i < $cout; $i++) {
                    $temp['rater' . $i] = $tem[$i];
                }
                $temp['score_num'] = $num;
                $id++;
                $res[] = $temp;
            }
            foreach ($infos as $info){
                $user[] = $this -> userClassModel -> findByUidWithUser($info['uid'])['user']['name'];
            }
            $count = $cout + 2;
            $indexes[0] = '序号';
            $indexes[1] = '被评分人';
            for ($i = 2, $j = 0; $i < $count; $i++) {
                $indexes[$i] = $user[$j++];
            }
            $indexes[$count + 1] = '票数';

            $this -> excelLib -> push($title, $indexes, $res);
        }
    }


    public function exportPoorSignExcel($class_id){
        $class = $this -> classesModel -> findByIdWithStatus($class_id);
        if (empty($class)){
          throw new \think\Exception("导出班级不存在或内部异常");
        }
        $this -> exportPoorSignExcelByClass($class);
    }

    public function showClasses(){
        try {
            return $this -> classesModel -> findAll();
        }catch (\Exception $exception){
            return NULL;
        }
    }

    private function packScoreData($infos, $cout){
        $user = [];
        foreach ($infos as $info) {
            $user[] = $this -> userClassModel -> findByUidWithUser($info['uid'])['user']['name'];
        }
        $count = $cout + 3;
        $indexes[0] = '序号';
        $indexes[1] = '被评分人';
        $indexes[2] = '未打分人';
        for ($i = 3, $j = 0; $i < $count; $i++) {
            $indexes[$i] = $user[$j++];
        }
        $indexes[$count + 1] = '平均分';
        $indexes[$count + 2] = '总分';
        return[
            'indexes' => $indexes
        ];

    }

    private function exportPoorSignExcelByClass($class){
        $indexes = $this -> getPoorSignIndexes();
        $temp = $this -> userClassModel -> findAllByClassId($class['id']);
        $department = $this -> departmentModel -> findById($class['depart_id']);
        $data = [];
        $id = 1;
        foreach ($temp as $key){
            $user = (new \app\common\model\api\User()) -> findById($key['uid']);
            $sign = $this -> synthesizePoorSignModel -> findByUid($key['uid']);
            if (empty($sign) || empty($key) || empty($department) || empty($user)){
                continue;
            }
            $sign['confirm_reason'] = implode(",", $sign['confirm_reason']);
            $data[] = $this -> packPoorSignData($department, $user, $sign, $class, $id);
            $id++;
        }
        $this -> excelLib -> push('贫困生报名-' . $class['name'], $indexes, $data);
    }

    private function packPoorSignData($department, $user, $sign, $class, $id){
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
            'id' => $id,
            'department' => $department['name'],
            'grade' => $class['grade'],
            'charge' => $class['charge'],
            'class' => $class['name'],
            'major' => $class['major'],
            'name' => $user['name'],
            'sex' => $user['sex'],
            'political_outlook' => $sign['political_outlook'],
            'student_id' => $user['student_id'],
            'id_card_type' => $sign['id_card_type'],
            'id_card_number' => $sign['id_card_number'],

            'poor_type_one' => $sign['poor_type_one'],
            'poor_type_two' => $sign['poor_type_two'],
            'poor_type_three' => $sign['poor_type_three'],
            'poor_type_four' => $sign['poor_type_four'],
            'poor_type_five' => $sign['poor_type_five'],
            'poor_type_six' => $sign['poor_type_six'],
            'poor_type_seven' => $sign['poor_type_seven'],
            'poor_type_eight' => $sign['poor_type_eight'],

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
            $classIndex[4]['Comment'],
            $classIndex[2]['Comment'],
            $classIndex[3]['Comment'],
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
            //$signIndex[19]['Comment'],
        ];
    }

}