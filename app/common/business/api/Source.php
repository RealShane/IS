<?php


namespace app\common\business\api;

use app\common\business\lib\Config;
use app\common\business\lib\Excel;
use app\common\model\api\User;
use app\common\model\api\UserClass;
use app\common\model\api\Classes;
use app\common\model\api\Department;
use app\common\model\api\Source as SourceModel;

class Source
{
    private $userModel = NULL;
    private $userClassModel = NULL;
    private $classesModel = NULL;
    private $departmentModel = NULL;
    private $sourceModel = NULL;
    private $config = NULL;
    private $excelLib = NULL;

    public function __construct(){
        $this -> userModel = new User();
        $this -> userClassModel = new UserClass();
        $this -> classesModel = new Classes();
        $this -> departmentModel = new Department();
        $this -> sourceModel = new SourceModel();
        $this -> config = new Config();
        $this -> excelLib = new Excel();
    }

    public function sourceRecord($data){
        if ($this -> config -> getSourceSignStatus()){
            return config('status.close');
        }
        $isExist = $this -> sourceModel -> findByUid($data['uid']);
        if (empty($isExist)){
            return $this -> sourceModel -> save($data) ? config('status.success') : config('status.failed');
        }
        return $this -> sourceModel -> updateRecord($data) ? config('status.success') : config('status.failed');
    }

    public function getSourceRecord($uid){
        try {
            $isExist = $this -> sourceModel -> findByUid($uid);
            if (empty($isExist)){
                return config('status.not_exist');
            }
            $data = $this -> getInfo($uid);
            return [
                'id_number' => $isExist['id_number'],
                'name' => $data['name'],
                'sex' => $data['sex'],
                'departName' => $data['departName'],
                'major' => $data['major'],
                'className' => $data['className'],
                'graduate_school' => $isExist['graduate_school'],
                'source' => $isExist['source'],
                'poor_code' => $isExist['poor_code'],
                'mobile_phone' => $isExist['mobile_phone'],
                'email' => $data['email'],
                'qq' => $isExist['qq'],
                'home_address' => $isExist['home_address'],
                'home_phone' => $isExist['home_phone']
            ];
        }catch (\Exception $exception){
            return config('status.failed');
        }
    }

    public function pushExcel($depart_id, $major){
        $title = "生源库"; $res = [];
        if (empty($depart_id) && empty($major)){
            $departs = $this -> departmentModel -> findAll();
            foreach ($departs as $depart){
                $data = $this -> packInfo($depart['id']);
                foreach ($data as $item){
                    $res[] = $item;
                }
            }
        }
        if (!empty($depart_id) && empty($major)){
            $department = $this -> departmentModel -> findById($depart_id);
            $title = $department['name'] . "生源库";
            $res = $this -> packInfo($depart_id);
        }
        if (!empty($depart_id) && !empty($major)){
            
        }

        return $this -> excelLib -> push($title, $this -> setIndex(), $res);
    }

    private function packInfo($depart_id){
        $datas = $this -> classesModel -> findByDepartId($depart_id);
        $res = [];
        $id = 1;
        foreach ($datas as $data){
            $uids = $this -> userClassModel -> findAllByClassId($data['id']);
            foreach ($uids as $uid){
                $sourceInfo = $this -> sourceModel -> findByUid($uid['uid']);
                if (empty($sourceInfo)){
                    continue;
                }
                $info = $this -> getInfo($uid['uid']);
                $res[] = [
                    'id' => $id,
                    'id_number' => $sourceInfo['id_number'],
                    'name' => $info['name'],
                    'sex' => $info['sex'],
                    'departName' => $info['departName'],
                    'major' => $info['major'],
                    'className' => $info['className'],
                    'graduate_school' => $sourceInfo['graduate_school'],
                    'source' => $sourceInfo['source'],
                    'poor_code' => $sourceInfo['poor_code'],
                    'mobile_phone' => $sourceInfo['mobile_phone'],
                    'email' => $info['email'],
                    'qq' => $sourceInfo['qq'],
                    'home_address' => $sourceInfo['home_address'],
                    'home_phone' => $sourceInfo['home_phone']
                ];
                $id++;
            }
        }
        return $res;
    }

    private function getInfo($uid){
        $user = $this -> userModel -> findById($uid);//name sex email
        $userClass = $this -> userClassModel -> findByUid($user['id']);
        $classes = $this -> classesModel -> findById($userClass['class_id']);//major name
        $department = $this -> departmentModel -> findById($classes['depart_id']); //name
        return [
            'name' => $user['name'],
            'sex' => $user['sex'],
            'email' => $user['email'],
            'major' => $classes['major'],
            'className' => $classes['name'],
            'departName' => $department['name']
        ];
    }

    private function setIndex(){
        return [
            '序号',
            '身份证号',
            '姓名',
            '性别',
            '学部',
            '专业',
            '班级',
            '毕业中学',
            '生源所在地',
            '困难生类别代码',
            'mobilePhone',
            'email',
            'qq',
            '家庭地址',
            '家庭电话（父母）'
        ];
    }
}