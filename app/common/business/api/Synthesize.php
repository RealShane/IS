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
use think\facade\App;
use app\common\model\api\User;

class Synthesize
{

    private $config = NULL;
    private $synthesizePoorSignModel = NULL;
    private $userClassModel = NULL;
    private $userModel = NULL;
    private $strLib = NULL;

    public function __construct(){
        $this -> config = new Config();
        $this -> synthesizePoorSignModel = new SynthesizePoorSign();
        $this -> userClassModel = new UserClass();
        $this -> userModel = new User();
        $this -> strLib = new Str();
    }

    public function showPoorSignDetail($user, $target){
        try {
            $myClass =  $this -> userClassModel -> findByUid($user['id']);
            $targetClass = $this -> userClassModel -> findByUid($target);
            if ($myClass['class_id'] != $targetClass['class_id'] || $user['id'] == $target){
                return config('status.failed');
            }
            $sign = $this -> synthesizePoorSignModel -> findByUid($target);
            $target = $this -> userModel -> findById($target);
            return [
                'name' => $target['name'],
                'sex' => $this -> strLib -> convertSex($target['sex']),
                'student_id' => $target['student_id'],
                'confirm_reason_explain' => $sign['confirm_reason_explain']
            ];

        }catch (\Exception $exception){
            return config('status.failed');
        }
    }

    public function showPoorSignList($user){
        try {
            $temp =  $this -> userClassModel -> findByUid($user['id']);
            if (empty($temp)){
                return config('status.not_exist');
            }
            $ids = $this -> userClassModel -> findAllByClassId($temp['class_id']);
            $result = [];
            foreach ($ids as $id){
                $sign = $this -> synthesizePoorSignModel -> findByUid($id['uid']);
                if (empty($sign) || $sign['uid'] == $user['id']){
                    continue;
                }
                $name = $this -> userModel -> findById($id['uid']);
                $result[] = [
                    'id' => $name['id'],
                    'name' => $name['name']
                ];
            }
            return $result;
        }catch (\Exception $exception){
            return config('status.failed');
        }

    }

    public function poorSign($data, $user){
        if (!($this -> config -> getSynthesizePoorStatus())){
            return config("status.close");
        }
        $isJoin = $this -> userClassModel -> findByUid($user['id']);
        if (empty($isJoin)){
            return config("status.error");
        }
        $isExist = $this -> synthesizePoorSignModel -> findByUid($user['id']);
        if (empty($isExist)){
            $data['uid'] = $user['id'];
            $data['create_time'] = time();
            return $this -> synthesizePoorSignModel -> save($data) ? config("status.success") : config("status.failed");
        }
        if (file_exists(App::getRootPath() . 'public' . $isExist['supporting_document']) && !($data['supporting_document'] == $isExist['supporting_document'])){
            unlink(App::getRootPath() . 'public' . $isExist['supporting_document']);
        }
        return $this -> synthesizePoorSignModel -> updatePoorSign($data, $user['id']) ? config("status.update") : config("status.failed");
    }

    public function viewPoorOption(){
        try {
            return json_decode($this -> config -> getSynthesizePoorSignOption());
        }catch (\Exception $exception){
            return config("status.failed");
        }
    }

}