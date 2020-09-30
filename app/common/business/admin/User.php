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

use app\common\business\lib\Str;
use app\common\model\admin\User as UserModel;

class User
{

    private $strLib = NULL;
    private $userModel = NULL;

    public function __construct(){
        $this -> userModel = new UserModel();
        $this -> strLib = new Str();
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