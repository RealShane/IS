<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/23 15:25
 */


namespace app\common\business\api;

use app\common\business\lib\Config;
use app\common\business\lib\Email;
use app\common\business\lib\Str;
use app\common\model\api\Classes;
use app\common\model\api\Department;
use app\common\model\api\User as UserModel;
use app\common\model\api\UserClass;

/**
 * Class User
 * @package app\common\business\api
 *
 * ----------------------------------------
 * 1.公有方法register：接收用户数据，将数据处理后存入Redis，向用户填写邮箱发送激活邮件(链接包含token)
 * 2.公有方法activeRegister：用户点击邮件中的激活链接将携带token发送至此方法进行数据入库(账号激活)
 * 3.公有方法login：传统密码登录和发送邮件验证码登录，密码登录检测此次登录IP和上次登录IP是否一致，如不一致跳转至邮件验证码登录，发送邮件验证码，两种登录类型统一调用私有方法进行登录信息更新以及创建用户登录凭证Token
 * 4.公有方法sendRandom：将随机生成的6位数字缓存至Redis之后，给用户发送邮件验证码
 * ----------------------------------------
 */

class User
{

    private $strLib = NULL;
    private $emailLib = NULL;
    private $userModel = NULL;
    private $userClassModel = NULL;
    private $classesModel = NULL;
    private $departmentModel = NULL;
    private $config = NULL;

    public function __construct(){
        $this -> strLib = new Str();
        $this -> emailLib = new Email();
        $this -> userModel = new UserModel();
        $this -> userClassModel = new UserClass();
        $this -> classesModel = new Classes();
        $this -> departmentModel = new Department();
        $this -> config = new Config();
    }

    public function viewMe($user){
        try {
            $data = $this -> userClassModel -> findByUid($user['id']);
            $classes = $this -> classesModel -> findById($data['class_id']);
            $department = $this -> departmentModel -> findById($classes['depart_id']);
            return [
                'name' => $user['name'],
                'student_id' => $user['student_id'],
                'class' => $classes['name'],
                'department' => $department['name'],
            ];
        }catch (\Exception $exception){
            return config("status.failed");
        }
    }

    public function joinClass($inviteCode, $user){
        $isExist = $this -> userClassModel -> findByUid($user['id']);
        if (!empty($isExist)){
            return config("status.exist");
        }
        $classes = $this -> classesModel -> findByInviteCode($inviteCode);
        if (empty($classes)){
            return config('status.not_exist');
        }
        return $this -> userClassModel -> save([
            'uid' => $user['id'],
            'class_id' => $classes['id']
        ]) ? config("status.success") : config("status.failed");
    }

    public function login($data){
        if ($data['login_type'] == 'type_password'){
            return $this -> loginByPassword($data);
        }
        if ($data['login_type'] == 'type_email'){
            return $this -> loginByEmail($data);
        }
        return config("status.failed");
    }

    public function sendRandom($email){
        try {
            $isExist = $this -> userModel -> findByEmail($email);
            if (empty($isExist)){
                return config('status.not_exist');
            }
            $random = rand(100000, 999999);
            cache(config("redis.code_pre") . $email, $random, config("redis.code_expire"));
            return $this -> sendRandomEmail($email, $random) ? config("status.success") : config("status.failed");
        }catch (\Exception $exception){
            return config("status.failed");
        }
    }

    public function activeRegister($token){
        $data = $this -> getDataFromRedis(config("redis.active_pre"), $token);
        if (empty($data)){
            return config("status.not_exist");
        }
        $isExist = $this -> userModel -> findByEmailWithOutStatus($data['email']);
        if (!empty($isExist)){
            return config("status.exist");
        }
        return $this -> userModel -> save($data) ? config("status.success") : config("status.failed");
    }

    public function register($data){
        try {
            $isExist = $this -> userModel -> findByEmailWithOutStatus($data['email']);
            if (!empty($isExist)){
                return config("status.exist");
            }
            $data['password_salt'] = $this -> strLib -> salt(5);
            $data['password'] = md5($data['password_salt'] . $data['password'] . $data['password_salt']);
            $data['last_login_ip'] = request() -> ip();
            $data['last_login_time'] = time();
            $token = $this -> strLib -> createToken($data['email']);
            cache(config("redis.active_pre") . $token, $data, config("redis.token_expire"));
            return $this -> sendActiveEmail($data['email'], $token) ? config("status.success") : config("status.failed");
        }catch (\Exception $exception){
            return config("status.failed");
        }
    }
    private function loginByPassword($data){
        $isExist = $this -> userModel -> findByEmail($data['email']);
        if (empty($isExist)){
            return config('status.not_exist');
        }
        if ($isExist['last_login_ip'] != request() -> ip()){
            return $this -> sendRandom($data['email']) ? config("status.goto") : config("status.failed");
        }
        $password = md5($isExist['password_salt'] . $data['password'] . $isExist['password_salt']);
        if ($password != $isExist['password']){
            return config('status.password_error');
        }
        return $this -> handleLogin($isExist);
    }

    private function loginByEmail($data){
        $isExist = $this -> userModel -> findByEmail($data['email']);
        if (empty($isExist)){
            return config('status.not_exist');
        }
        $random = cache(config("redis.code_pre") . $data['email']);
        if ($random != $data['random']){
            return config("status.random_error");
        }
        return $this -> handleLogin($isExist);
    }

    private function handleLogin($data){
        $token = $this -> strLib -> createToken($data['email']);
        $this -> clearExpireToken($data['last_login_token']);
        $this -> updateLoginInfo($data['email'], $token);
        return $this -> keepToken($token, [
            'id' => $data['id'],
            'email' => $data['email'],
            'name' => $data['name'],
            'student_id' => $data['student_id']
        ]) ? $token : config('status.failed');
    }

    private function clearExpireToken($token){
        return cache(config('redis.token_pre') . $token, NULL);
    }

    private function updateLoginInfo($email, $token){
        $data = [
            'email' => $email,
            'last_login_ip' => request() ->ip(),
            'last_login_time' => time(),
            'last_login_token' => $token
        ];
        return $this -> userModel -> updateLoginInfo($data);
    }

    private function keepToken($token, $data){
        return cache(config('redis.token_pre') . $token, $data, config('redis.token_expire'));
    }

    private function sendRandomEmail($target, $random){
        $title = $this -> config -> getRandomTitle();
        $body = $this -> config -> getRandomBody() . $random;
        $alt_body = $this -> config -> getRandomAltBody() . $random;
        return $this -> emailLib -> sendEmail($target, $title, $body, $alt_body);
    }

    private function sendActiveEmail($target, $token){
        $title = $this -> config -> getActiveTitle();
        $body = $this -> config -> getActiveBody() . $token;
        $alt_body = $this -> config -> getActiveAltBody() . $token;
        return $this -> emailLib -> sendEmail($target, $title, $body, $alt_body);
    }

    private function getDataFromRedis($pre, $token){
        return cache($pre . $token);
    }
}