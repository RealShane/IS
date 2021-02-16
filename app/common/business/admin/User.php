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

class User
{

    private $strLib = NULL;
    private $userModel = NULL;
    private $accessModel = NULL;
    private $groupModel = NULL;
    private $redis = NULL;

    public function __construct(){
        $this -> strLib = new Str();
        $this -> userModel = new UserModel();
        $this -> accessModel = new AuthAccess();
        $this -> groupModel = new AuthGroup();
        $this -> redis = new Redis();
    }

    public function getAdmin($id){
        try {
            return $this -> userModel -> findById($id);
        }catch (\Exception $exception){
            return NULL;
        }
    }

    public function quit($token){
        return $this -> redis -> delete(config('redis.token_pre') . $token) ? config('status.success') : config('status.failed');
    }

    public function adminInfo($token){
        $data = $this -> redis -> get(config('redis.token_pre') . $token);
        $access = $this -> accessModel -> findByUid($data['id']);
        if (empty($access)){
            return config("status.failed");
        }
        $group = $this -> groupModel -> findById($access['group']);
        if (empty($group)){
            return config("status.failed");
        }
        return $group['name'] . ' -- ' . $data['username'];
    }

    public function deleteAdmin($target){
        try {
            $isExist = $this -> userModel -> findById($target);
            if (empty($isExist)){
                return config("status.not_exist");
            }
            $this -> userModel -> deleteAdmin($target);
            return config("status.success");
        }catch (\Exception $exception){
            return config("status.failed");
        }
    }

    public function getTargetAdmin($username){
        try {
            return $this -> userModel -> getTargetAdmin($username);
        }catch (\Exception $exception){
            return NULL;
        }
    }

    public function viewAllAdmin($num){
        try {
            return $this -> userModel -> findAll($num);
        }catch (\Exception $exception){
            return NULL;
        }
    }

    public function updateAdmin($data){
        try {
            $isExist = $this -> userModel -> findById($data['target']);
            if (empty($isExist)){
                return config("status.not_exist");
            }
            $data['update_time'] = time();
            return $this -> userModel -> updateAdmin($data) ? config("status.success") : config("status.failed");
        }catch (\Exception $exception){
            return config("status.failed");
        }
    }

    public function changePassword($data){
        try {
            $isExist = $this -> userModel -> findById($data['target']);
            if (empty($isExist)){
                return config("status.not_exist");
            }
            $data['password_salt'] = $this -> strLib -> salt(5);
            $data['password'] = md5($data['password_salt'] . $data['password'] . $data['password_salt']);
            $data['update_time'] = time();
            return $this -> userModel -> changePassword($data) ? config("status.success") : config("status.failed");
        }catch (\Exception $exception){
            return config("status.failed");
        }
    }

    public function addAdmin($data){
        try {
            $isExist = $this -> userModel -> findByUserNameWithOutStatus($data['username']);
            if (!empty($isExist)){
                return config("status.exist");
            }
            $data['password_salt'] = $this -> strLib -> salt(5);
            $data['password'] = md5($data['password_salt'] . $data['password'] . $data['password_salt']);
            $data['last_login_ip'] = request() -> ip();
            $data['last_login_time'] = time();
            return $this -> userModel -> save($data) ? config("status.success") : config("status.failed");
        }catch (\Exception $exception){
            return config("status.failed");
        }
    }

    public function login($data){
        $isExist = $this -> userModel -> findByUserName($data['username']);
        if (empty($isExist)){
            return config('status.not_exist');
        }
        $password = md5($isExist['password_salt'] . $data['password'] . $isExist['password_salt']);
        if ($password != $isExist['password']){
            return config('status.password_error');
        }
        $token = $this -> strLib -> createToken($isExist['username']);
        $this -> clearExpireToken($isExist['last_login_token']);
        $this -> updateLoginInfo($isExist['username'], $token);
        return $this -> keepToken($token, [
            'id' => $isExist['id'],
            'username' => $isExist['username']
        ]) ? $token : config('status.failed');
    }

    private function clearExpireToken($token){
        return cache(config('redis.token_pre') . $token, NULL);
    }

    private function updateLoginInfo($username, $token){
        $data = [
            'username' => $username,
            'last_login_ip' => request() ->ip(),
            'last_login_time' => time(),
            'last_login_token' => $token
        ];
        return $this -> userModel -> updateLoginInfo($data);
    }

    private function keepToken($token, $data){
        return cache(config('redis.token_pre') . $token, $data, config('redis.token_expire'));
    }

}