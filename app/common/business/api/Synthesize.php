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
use app\common\model\api\UserClass;
use think\Exception;
use app\common\model\api\User;
use app\common\model\api\SynthesizeCross;

class Synthesize
{

    private $config = NULL;
    private $synthesizePoorSignModel = NULL;
    private $synthesizeCrossModel = NULL;
    private $userClassModel = NULL;
    private $userModel = NULL;
    private $str = NULL;

    public function __construct(){
        $this -> config = new Config();
        $this -> synthesizePoorSignModel = new SynthesizePoorSign();
        $this -> synthesizeCrossModel = new SynthesizeCross();
        $this -> userClassModel = new UserClass();
        $this -> userModel = new User();
        $this -> str = new Str();
    }

    public function getCrossScore($uid, $target){
        $this -> check($uid, $target);
        $data = $this -> synthesizeCrossModel -> findByUidAndTarget($uid, $target);
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
            $result[] = $sign;
        }
        return $result;
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
            echo json_encode($data);exit();
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