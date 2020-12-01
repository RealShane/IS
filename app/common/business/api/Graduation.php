<?php


namespace app\common\business\api;
use app\common\business\lib\Config;
use app\common\model\api\GraduationDestination;
use app\common\model\api\User;
use app\common\model\api\UserClass;
use app\common\model\api\Classes;
use app\common\business\lib\Excel;
use app\common\business\lib\Str;
class Graduation
{
    private $graduationDestinationModel = NULL;
    private $userModel = NULL;
    private $userClassModel = NULL;
    private $classesModel = NULL;
    private $excelLib = NULL;
    private $strLib = NULL;
    private $config = NULL;

    public function __construct(){
        $this -> graduationDestinationModel = new GraduationDestination();
        $this -> userModel = new User();
        $this -> userClassModel = new UserClass();
        $this -> classesModel = new Classes();
        $this -> excelLib = new Excel();
        $this -> strLib = new Str();
        $this -> config = new Config();
    }
    public function graduationRecord($data){
        if ($this -> config -> getGraduationSignStatus()){
            return config('status.close');
        }
        $uid = $this -> graduationDestinationModel -> findByUid($data['uid']);
        if (empty($uid)){
            return $this -> graduationDestinationModel -> save($data) ? config('status.success') : config('status.failed');
        }
        return $this -> graduationDestinationModel -> updateRecord($data) ? config('status.success') : config('status.failed');
    }

    public function getGraduationRecord($user){
        try {
            $data = $this -> graduationDestinationModel -> findByUid($user['id']);
            if (empty($data)){
                return config('status.not_exist');
            }
            $user = $this -> userModel -> findById($user['id']);
            return [
                'examinee_number' => $data['examinee_number'],
                'name' => $user['name'],
                'sex' => $this -> strLib -> convertSex($user['sex']),
                'destination_code' => $data['destination_code'],
                'unit_code' => $data['unit_code'],
                'unit_name' => $data['unit_name'],
                'unit_property_code' => $data['unit_property_code'],
                'unit_location_code' => $data['unit_location_code'],
                'job_category_code' => $data['job_category_code'],
                'unit_contact' => $data['unit_contact'],
                'contact_phone' => $data['contact_phone']
            ];
        }catch (\Exception $exception){
            return config('status.failed');
        }
    }

    public function downExcel($class_id){
        $title = "毕业生去向查询表";$res = [];
        if (empty($class_id)){
            $res = $this -> packAll();
        }
        if (!empty($class_id)){
            $class = $this -> classesModel -> findById($class_id);
            if (empty($class)){
                return config('status.not_exist');
            }
            $title = $class['name'] . "毕业生去向查询表";
            $res = $this -> packClass($class_id);
        }
        if (empty($res) || $res == config('status.failed')){
            return config('status.not_exist');
        }
        return $this -> excelLib -> push($title, $this -> setIndex(), $res);
    }

    public function getGraduationDestinationCode(){
        try {
            return $this -> config -> getGraduationDestinationCode();
        }catch (\Exception $exception){
            return config('status.failed');
        }
    }

    private function packAll(){
        $infos = $this -> graduationDestinationModel -> findAll();
        $id = 1;$res = [];
        foreach ($infos as $info){
            $userInfo = $this -> userModel -> findById($info['uid']);//姓名和性别
            $classId = $this -> userClassModel -> findByUid($info['uid']);
            $major = $this -> classesModel -> findById($classId['class_id']);//专业
            $res[] = $this -> setData($id, $info, $userInfo, $major);
            $id++;
        }
        return $res;
    }

    private function packClass($class_id){
        $major = $this -> classesModel -> findById($class_id);//专业
        $userIds = $this -> userClassModel -> findAllByClassId($class_id);
        if (empty($userIds -> toArray())){
            return config('status.failed');
        }
        $id = 1;$res = [];
        foreach ($userIds as $userId){
            $userInfo = $this -> userModel -> findById($userId['uid']);//姓名和性别
            $info = $this -> graduationDestinationModel -> findByUid($userInfo['id']);
            if (empty($info)){
                return config('status.failed');
            }
            $res[] = $this -> setData($id, $info, $userInfo, $major);
            $id++;
        }
        return $res;
    }

    private function setData($id, $info, $userInfo, $major){
        return [
            'id' => $id,
            'examinee_number' => $info['examinee_number'],
            'name' => $userInfo['name'],
            'sex' => $this -> strLib -> convertSex($userInfo['sex']),
            'major' => $major['major'],
            'destination_code' => $info['destination_code'],
            'unit_code' => $info['unit_code'],
            'unit_name' => $info['unit_name'],
            'unit_property_code' => $info['unit_property_code'],
            'unit_location_code' => $info['unit_location_code'],
            'job_category_code' => $info['job_category_code'],
            'unit_contact' => $info['unit_contact'],
            'contact_phone' => $info['contact_phone']
        ];
    }

    private function setIndex(){
        return [
            '序号',
            '考生号',
            '姓名',
            '性别',
            '专业',
            '毕业去向代码',
            '单位组织机构代码',
            '单位名称',
            '单位性质代码',
            '单位所在地代码',
            '工作职位类别代码',
            '单位联系人',
            '联系人电话',
        ];
    }

}