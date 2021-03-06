<?php


namespace app\common\business\api;
use app\common\business\lib\Config;
use app\common\model\api\GraduationDestination;
use app\common\model\api\User;
use app\common\model\api\UserClass;
use app\common\model\api\Classes;
use app\common\business\lib\Excel;
use app\common\business\lib\Str;
use think\Exception;

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
            throw new Exception("该功能处于关闭状态！");
        }
        $uid = $this -> graduationDestinationModel -> findByUid($data['uid']);
        if (empty($uid)){
            $this -> graduationDestinationModel -> save($data);
        }
        $this -> graduationDestinationModel -> updateRecord($data);
    }

    public function getGraduationRecord($user){
        $data = $this -> graduationDestinationModel -> findByUid($user['id']);
        if (empty($data)){
            throw new Exception("此毕业生信息不存在！");
        }
        $user = $this -> userModel -> findByIdWithStatus($user['id']);
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
    }

    public function downExcel($class_id){
        $title = "毕业生去向查询表";$res = [];
        if (empty($class_id)){
            $res = $this -> packAll();
        }
        if (!empty($class_id)){
            $class = $this -> classesModel -> findById($class_id);
            if (empty($class)){
                throw new Exception("该班级不存在！");
            }
            $title = $class['name'] . "毕业生去向查询表";
            $res = $this -> packClass($class_id);
        }
        if (empty($res) || $res == config('status.failed')){
            throw new Exception("没有班级学生数据！");
        }
        $this -> excelLib -> push($title, $this -> setIndex(), $res);
    }

    public function getGraduationDestinationCode(){
        return $this -> config -> getGraduationDestinationCode();
    }

    private function packAll(){
        $infos = $this -> graduationDestinationModel -> select();
        $id = 1;$res = [];
        foreach ($infos as $info){
            $userInfo = $this -> userModel -> findByIdWithStatus($info['uid']);//姓名和性别
            if (empty($userInfo)){
                continue;
            }
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
        if ($userIds -> isEmpty()){
            return config('status.failed');
        }
        $id = 1;$res = [];
        foreach ($userIds as $userId){
            $userInfo = $this -> userModel -> findByIdWithStatus($userId['uid']);//姓名和性别
            $info = $this -> graduationDestinationModel -> findByUid($userInfo['id']);
            if (empty($info)){
                continue;
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