<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/25 9:51
 */


namespace app\common\business\api;


use app\common\business\lib\Config;
use app\common\business\lib\Str;
use app\common\model\api\SynthesizePoorSign;
use app\common\model\api\SynthesizePoorScore;
use app\common\model\api\UserClass;
use think\Exception;
use app\common\model\api\User;
use app\common\model\api\SynthesizeCross;

class Synthesize
{

    private $config = NULL;
    private $synthesizePoorSignModel = NULL;
    private $synthesizePoorScoreModel = NULL;
    private $synthesizeCrossModel = NULL;
    private $userClassModel = NULL;
    private $userModel = NULL;
    private $str = NULL;

    public function __construct(){
        $this -> config = new Config();
        $this -> synthesizePoorSignModel = new SynthesizePoorSign();
        $this -> synthesizePoorScoreModel = new SynthesizePoorScore();
        $this -> synthesizeCrossModel = new SynthesizeCross();
        $this -> userClassModel = new UserClass();
        $this -> userModel = new User();
        $this -> str = new Str();
    }

    public function getCrossScore($uid, $target){
        $this -> check($uid, $target);
        $data = $this -> synthesizeCrossModel -> findByUidAndTarget($uid, $target);
        if (empty($data['score'])){
            return NULL;
        }
        return [
            'score' => $data['score'],
            'time' => $data['update_time']
        ];
    }

    public function crossScore($data){
        $this -> check($data['uid'], $data['target']);
        $info = $this -> synthesizeCrossModel -> findByUidAndTarget($data['uid'], $data['target']);
        $result = [
            'uid' => $data['uid'],
            'target_uid' => $data['target'],
            'score' => $data['score']
        ];
        if (empty($info)){
            return $this -> synthesizeCrossModel -> save($result);
        }
        $info -> save($result);
    }

    public function showCrossList($user){
        if (!(int)$this -> config -> getSynthesizeCrossStatus()){
            throw new Exception("综测评分功能已关闭！");
        }
        $class = $this -> userClassModel -> findByUid($user['id']);
        if (empty($class)){
            throw new Exception("未加入班级！");
        }
        $ids = $this -> userClassModel -> findAllByClassId($class['class_id']);
        $result = [];
        foreach ($ids as $id){
            $sign = $this -> userClassModel -> findByUidWithUser($id['uid']);
            if (empty($sign) || $sign['uid'] == $user['id']){
                continue;
            }
            $isEmpty = $this -> synthesizeCrossModel -> findByUidAndTarget($user['id'], $id['uid']);
            $status = false;
            if (!empty($isEmpty)){
                $status = true;
            }
            $result[] = [
                'id' => $sign['uid'],
                'name' => $sign['user']['name'],
                'status' => $status
            ];
        }
        return $result;
    }

    public function getPoorScore($uid, $id){
        $mark = $this -> synthesizePoorScoreModel -> findByUidAndTarget($uid, $id);
        $type = $this -> config -> getSynthesizePoorSignMarkOption();
        $scoreStart = $this -> config ->  getSynthesizePoorSignScoreOption();
        $sign = $this -> synthesizePoorSignModel -> findByUid($uid);
        return [
            'mark' => $mark['mark'],
            'type' => $type,
            'data' => [
                'confirm_reason' => $sign['confirm_reason'],
                'confirm_reason_explain' => $sign['confirm_reason_explain'],
                'remark' => $sign['remark'],
                'status' => $scoreStart
            ],
            'time' => $mark['update_time']
        ];
    }

    public function poorScore($data){
        $this -> check($data['uid'], $data['target']);
        $type = $this -> config -> getSynthesizePoorSignMarkOption();
        $scoreStart = $this -> config ->  getSynthesizePoorSignScoreOption();
        if ($scoreStart == 0){
            throw new Exception("打分未开始！");
        }
        if ($type == 0){
            if ($data['score'] < 70 || $data['score'] > 100){
                throw new Exception("请在70~100之间评分！");
            }
        }
        if ($type == 1){
            if ($data['score'] <= 0){
                $data['score'] = 0;
            }else{
                $data['score'] = 1;
            }
        }
        $info = $this -> synthesizePoorScoreModel -> findByUidAndTarget($data['uid'], $data['target']);
        $result = [
            'uid' => $data['uid'],
            'target' => $data['target'],
            'mark' => $data['score']
        ];
        if (empty($info)){
            return $this -> synthesizePoorScoreModel -> save($result);
        }
        $info -> save($result);
    }

    public function showPoorSignDetail($user, $target){
        $myClass =  $this -> userClassModel -> findByUid($user['id']);
        $targetClass = $this -> userClassModel -> findByUid($target);
        if ($myClass['class_id'] != $targetClass['class_id'] || $user['id'] == $target){
            throw new Exception("禁止查看自己及以外的班级！");
        }
        $sign = $this -> synthesizePoorSignModel -> findByUid($target);
        $target = $this -> userModel -> findByIdWithStatus($target);
        return [
            'name' => $target['name'],
            'sex' => $this -> str -> convertSex($target['sex']),
            'student_id' => $target['student_id'],
            'confirm_reason_explain' => $sign['confirm_reason_explain']
        ];
    }

    public function showPoorSignList($user){
        $temp =  $this -> userClassModel -> findByUid($user['id']);
        if (empty($temp)){
            throw new Exception("未加入班级！");
        }
        $ids = $this -> userClassModel -> findAllByClassId($temp['class_id']);
        $result = [];
        foreach ($ids as $id){
            $sign = $this -> synthesizePoorSignModel -> findByUid($id['uid']);
            if (empty($sign) || $sign['uid'] == $user['id']){
                continue;
            }
            $isEmpty = $this -> synthesizePoorScoreModel -> findByUidAndTarget($user['id'], $id['uid']);
            $status = false;
            if (!empty($isEmpty)){
                $status = true;
            }
            $result[] = [
                'id' => $sign['uid'],
                'name' => $sign['user']['name'],
                'status' => $status
            ];
        }
        return $result;
    }

    public function getPoorSign($uid){
        $isExist = $this -> synthesizePoorSignModel -> findByUid($uid);
        if (empty($isExist)){
            return NULL;
        }
        return [
            'political_outlook' => $isExist['political_outlook'],
            'id_card_number' => $isExist['id_card_number'],
            'poor_type_one' => $isExist['poor_type_one'],
            'poor_type_two' => $isExist['poor_type_two'],
            'poor_type_three' => $isExist['poor_type_three'],
            'poor_type_four' => $isExist['poor_type_four'],
            'poor_type_five' => $isExist['poor_type_five'],
            'poor_type_six' => $isExist['poor_type_six'],
            'poor_type_seven' => $isExist['poor_type_seven'],
            'poor_type_eight' => $isExist['poor_type_eight'],
            'confirm_reason' => $isExist['confirm_reason'],
            'confirm_reason_explain' => $isExist['confirm_reason_explain'],
            'address' => $isExist['address'],
            'home_phone' => $isExist['home_phone'],
            'contact_phone' => $isExist['contact_phone'],
            'remark' => $isExist['remark'],
            'supporting_document' => $isExist['supporting_document'],

        ];
    }

    public function poorSign($data, $user){
        if (!($this -> config -> getSynthesizePoorStatus())){
            throw new Exception("贫困生报名处于关闭状态！");
        }
        $isJoin = $this -> userClassModel -> findByUid($user['id']);
        if (empty($isJoin)){
            throw new Exception("贫困生报名请先加入班级！");
        }
        if (!in_array($data['political_outlook'], ['群众', '共青团员', '中共党员'])){
            throw new Exception("无此政治面貌！");
        }
        $isExist = $this -> synthesizePoorSignModel -> findByUid($user['id']);
        if (empty($isExist)){
            $data['uid'] = $user['id'];
            $data['create_time'] = time();
            return $this -> synthesizePoorSignModel -> save($data);
        }
        $this -> synthesizePoorSignModel -> updatePoorSign($data, $user['id']);
    }

    public function viewPoorOption(){
        $options = json_decode($this -> config -> getSynthesizePoorSignOption());
        $result = [];
        foreach ($options as $option){
            $result[] = ['option' => $option];
        }
        return $result;
    }

    public function downloadProve($uid, $targetId) {
        $isExist = $this -> synthesizePoorSignModel -> findByUid($targetId);
        if (empty($isExist)){
            throw new Exception("该学生未报名贫困生！");
        }
        return download($isExist['supporting_document'], $isExist['id'], true);
    }

    private function check($uid, $target){
        $myClass =  $this -> userClassModel -> findByUid($uid);
        $targetClass = $this -> userClassModel -> findByUid($target);
        if ($myClass['class_id'] != $targetClass['class_id']){
            throw new Exception("非所在班级！");
        }
        if ($uid == $target){
            throw new Exception("不能给自己评分！");
        }
    }

}