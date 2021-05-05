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

class Synthesize
{

    private $config = NULL;
    private $synthesizePoorSignModel = NULL;
    private $userClassModel = NULL;
    private $userModel = NULL;
    private $str = NULL;

    public function __construct(){
        $this -> config = new Config();
        $this -> synthesizePoorSignModel = new SynthesizePoorSign();
        $this -> userClassModel = new UserClass();
        $this -> userModel = new User();
        $this -> str = new Str();
    }

    public function showCrossList($user){
        $temp = $this -> userClassModel -> findByUid($user['id']);
        if (empty($temp)){
            throw new Exception("未加入班级！");
        }
        $ids = $this -> userClassModel -> findAllByClassId($temp['class_id']);
        $result = [];
        foreach ($ids as $id){
            $sign = $this -> userClassModel -> findByUidWithUser($id['uid']);
            echo json_encode($sign);exit();
            if (empty($sign) || $sign['uid'] == $user['id']){
                continue;
            }
            $result[] = [
                'id' => $sign['uid'],
                'name' => $sign['user']['name']
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
        $isExist = $this -> synthesizePoorSignModel -> findByUid($user['id']);
        if (empty($isExist)){
            $data['uid'] = $user['id'];
            $data['create_time'] = time();
            $this -> synthesizePoorSignModel -> save($data);
        }
        $this -> synthesizePoorSignModel -> updatePoorSign($data, $user['id']);
    }

    public function viewPoorOption(){
        return json_decode($this -> config -> getSynthesizePoorSignOption());
    }

}