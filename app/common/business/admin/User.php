<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/30 14:29
 */


namespace app\common\business\admin;

use app\common\business\lib\Redis;
use app\common\business\lib\Str;
use app\common\model\admin\AuthAccess;
use app\common\model\admin\AuthGroup;
use app\common\model\admin\User as UserModel;
use app\common\model\api\User as ApiUserModel;
use app\common\model\api\UserClass;
use app\common\model\api\Classes;
use app\common\model\api\Department;
use think\Exception;

class User
{

    private $str = NULL;
    private $userModel = NULL;
    private $accessModel = NULL;
    private $groupModel = NULL;
    private $redis = NULL;
    private $apiUserModel = NULL;
    private $userClassModel = NULL;
    private $classesModel = NULL;
    private $departmentModel = NULL;

    public function __construct(){
        $this -> str = new Str();
        $this -> userModel = new UserModel();
        $this -> accessModel = new AuthAccess();
        $this -> groupModel = new AuthGroup();
        $this -> redis = new Redis();
        $this -> apiUserModel = new ApiUserModel();
        $this -> userClassModel = new UserClass();
        $this -> classesModel = new Classes();
        $this -> departmentModel = new Department();
    }

    public function getUser($id){
        $data = $this -> apiUserModel -> findById($id);
        return [
            'email' => $data['email'],
            'name' => $data['name'],
            'sex' => $this -> str -> convertSex($data['sex']),
            'student_id' => $data['student_id'],
            'class_id' => $this -> userClassModel -> findByUid($data['id'])['class_id'],
            'status' => $data['status'],
        ];
    }

    public function getTargetUser($name){
        $data = $this -> apiUserModel -> getTargetUser($name);
        foreach ($data as $item){
            $classId = $this -> userClassModel -> findByUid($item['id'])['class_id'];
            $item['sex'] = $this -> str -> convertSex($item['sex']);
            if (empty($classId)){
                $item['class'] = '未加入';
                $item['charge'] = '未加入';
                $item['department'] = '未加入';
                continue;
            }
            $class = $this -> classesModel -> findById($classId);
            $department = $this -> departmentModel -> findById($class['depart_id'])['name'];
            $item['class'] = $class['name'];
            $item['charge'] = $class['charge'];
            $item['department'] = $department;
        }
        return $data;
    }

    public function viewAllUser($num){
        return $this -> apiUserModel -> findAll($num) -> each(function($item, $key){
            $classId = $this -> userClassModel -> findByUid($item['id'])['class_id'];
            $item['sex'] = $this -> str -> convertSex($item['sex']);
            if (empty($classId)){
                $item['class'] = '未加入';
                $item['charge'] = '未加入';
                $item['department'] = '未加入';
                return $item;
            }
            $class = $this -> classesModel -> findById($classId);
            $department = $this -> departmentModel -> findById($class['depart_id'])['name'];
            $item['class'] = $class['name'];
            $item['charge'] = $class['charge'];
            $item['department'] = $department;
            return $item;
        });
    }

    public function getAdmin($id){
        return $this -> userModel -> findById($id);
    }

    public function quit($token){
        $this -> redis -> delete(config('redis.token_pre') . $token);
    }

    public function adminInfo($token){
        $data = $this -> redis -> get(config('redis.token_pre') . $token);
        $access = $this -> accessModel -> findByUid($data['id']);
        if (empty($access)){
            throw new Exception("权限分配异常，请联系超管！");
        }
        $group = $this -> groupModel -> findByIdWithStatus($access['group']);
        if (empty($group)){
            throw new Exception("权限组失效，请联系超管！");
        }
        return $group['name'] . ' -- ' . $data['username'];
    }

    public function deleteAdmin($target){
        $isExist = $this -> userModel -> findById($target);
        if (empty($isExist)){
            throw new Exception("管理员不存在！");
        }
        $this -> userModel -> deleteAdmin($target);
    }

    public function getTargetAdmin($username){
        return $this -> userModel -> getTargetAdmin($username);
    }

    public function viewAllAdmin($num){
        return $this -> userModel -> findAll($num);
    }

    public function updateAdmin($data){
        $isExist = $this -> userModel -> findById($data['target']);
        if (empty($isExist)){
            throw new Exception("管理员不存在！");
        }
        $data['update_time'] = time();
        $this -> userModel -> updateAdmin($data);
    }

    public function changePassword($data){
        $isExist = $this -> userModel -> findById($data['target']);
        if (empty($isExist)){
            throw new Exception("管理员不存在！");
        }
        $data['password_salt'] = $this -> str -> salt(5);
        $data['password'] = md5($data['password_salt'] . $data['password'] . $data['password_salt']);
        $data['update_time'] = time();
        $this -> userModel -> changePassword($data);
    }

    public function addAdmin($data){
        $isExist = $this -> userModel -> findByUserName($data['username']);
        if (!empty($isExist)){
            throw new Exception("管理员已存在！");
        }
        $data['password_salt'] = $this -> str -> salt(5);
        $data['password'] = md5($data['password_salt'] . $data['password'] . $data['password_salt']);
        $data['last_login_ip'] = request() -> ip();
        $data['last_login_time'] = time();
        $this -> userModel -> save($data);
    }

    public function login($data){
        $isExist = $this -> userModel -> findByUserNameWithStatus($data['username']);
        if (empty($isExist)){
            throw new Exception("管理员不存在！");
        }
        $password = md5($isExist['password_salt'] . $data['password'] . $isExist['password_salt']);
        if ($password != $isExist['password']){
            throw new Exception("密码填写错误！");
        }
        $token = $this -> str -> createToken($isExist['username']);
        $this -> redis -> delete(config('redis.token_pre') . $isExist['last_login_token']);
        $this -> userModel -> updateLoginInfo([
            'username' => $isExist['username'],
            'last_login_ip' => request() ->ip(),
            'last_login_time' => time(),
            'last_login_token' => $token
        ]);
        $this -> redis -> set(config('redis.token_pre') . $token, [
            'id' => $isExist['id'],
            'username' => $isExist['username']
        ]);
        return $token;
    }

}