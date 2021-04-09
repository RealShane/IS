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
use app\common\business\lib\Redis;
use think\Exception;

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

    private $str = NULL;
    private $email = NULL;
    private $userModel = NULL;
    private $userClassModel = NULL;
    private $classesModel = NULL;
    private $departmentModel = NULL;
    private $config = NULL;
    private $redis = NULL;

    public function __construct(){
        $this -> str = new Str();
        $this -> email = new Email();
        $this -> userModel = new UserModel();
        $this -> userClassModel = new UserClass();
        $this -> classesModel = new Classes();
        $this -> departmentModel = new Department();
        $this -> config = new Config();
        $this -> redis = new Redis();
    }

    public function viewMe($user){
        $data = $this -> userClassModel -> findByUid($user['id']);
        $classes = $this -> classesModel -> findById($data['class_id']);
        $department = $this -> departmentModel -> findById($classes['depart_id']);
        return [
            'name' => $user['name'],
            'student_id' => $user['student_id'],
            'class' => $classes['name'],
            'department' => $department['name'],
        ];
    }

    public function joinClass($inviteCode, $user){
        $isExist = $this -> userClassModel -> findByUid($user['id']);
        if (!empty($isExist)){
            throw new Exception("已加入班级，加错班级请联系管理员！");
        }
        $classes = $this -> classesModel -> findByInviteCode($inviteCode);
        if (empty($classes)){
            throw new Exception("班级不存在或未开放加入！");
        }
        $this -> userClassModel -> save([
            'uid' => $user['id'],
            'class_id' => $classes['id']
        ]);
    }

    public function login($data){
        $isExist = $this -> userModel -> findByEmailWithStatus($data['email']);
        if (empty($isExist)){
            throw new Exception("用户不存在！");
        }
        if (strtoupper($data['login_type']) == 'TYPE_PASSWORD'){
            return $this -> loginByPassword($isExist, $data);
        }
        if (strtoupper($data['login_type']) == 'TYPE_EMAIL'){
            return $this -> loginByEmail($isExist, $data);
        }
        throw new Exception("登陆类型异常！");
    }

    public function logoff($token){
        $this -> redis -> delete(config('redis.token_pre') . $token);
    }

    public function sendRandom($email){
        $isExist = $this -> userModel -> findByEmailWithStatus($email);
        if (empty($isExist)){
            throw new Exception("用户不存在！");
        }
        $random = rand(100000, 999999);
        $this -> redis -> set(config("redis.code_pre") . $email, $random, config("redis.code_expire"));
        $this -> sendRandomEmail($email, $random);
    }

    public function activeRegister($token){
        $data = $this -> redis -> get(config("redis.active_pre") . $token);
        if (empty($data)){
            throw new Exception("注册过期，请重新注册！");
        }
        $studentId = $this -> userModel -> findByStudentId($data['student_id']);
        if (!empty($studentId)){
            throw new Exception("该学号已激活，请勿重复激活！");
        }
        $isExist = $this -> userModel -> findByEmail($data['email']);
        if (!empty($isExist)){
            throw new Exception("该邮箱已激活，请勿重复激活！");
        }
        $this -> userModel -> save($data);
    }

    public function register($data){
        $isExist = $this -> userModel -> findByEmail($data['email']);
        if (!empty($isExist)){
            throw new Exception("邮箱已被注册！");
        }
        $studentId = $this -> userModel -> findByStudentId($data['student_id']);
        if (!empty($studentId)){
            throw new Exception("学号已被注册！");
        }
        $data['password_salt'] = $this -> str -> salt(5);
        $data['password'] = md5($data['password_salt'] . $data['password'] . $data['password_salt']);
        $data['last_login_ip'] = request() -> ip();
        $data['last_login_time'] = time();
        $token = $this -> str -> createToken($data['email']);
        $this -> redis -> set(config("redis.active_pre") . $token, $data, config("redis.token_expire"));
        $this -> sendActiveEmail($data['email'], $token);
    }

    private function loginByPassword($isExist, $data){
        if ($isExist['last_login_ip'] != request() -> ip()){
            $this -> sendRandom($data['email']);
            throw new Exception(config('status.goto'));
        }
        $password = md5($isExist['password_salt'] . $data['password'] . $isExist['password_salt']);
        if ($password != $isExist['password']){
            throw new Exception("密码填写错误！");
        }
        return $this -> handleLogin($isExist);
    }

    private function loginByEmail($isExist, $data){
        $random = $this -> redis -> get(config("redis.code_pre") . $data['email']);
        if ($random != $data['random']){
            throw new Exception("邮件验证码填写错误，请仔细查看邮件！");
        }
        return $this -> handleLogin($isExist);
    }

    private function handleLogin($data){
        $token = $this -> str -> createToken($data['email']);
        $this -> redis -> delete(config('redis.token_pre') . $data['last_login_token']);
        $this -> userModel -> updateLoginInfo([
            'email' => $data['email'],
            'last_login_ip' => request() ->ip(),
            'last_login_time' => time(),
            'last_login_token' => $token
        ]);
        $this -> redis -> set(config('redis.token_pre') . $token, [
            'id' => $data['id'],
            'email' => $data['email'],
            'name' => $data['name']
        ]);
        return $token;
    }

    private function sendRandomEmail($target, $random){
        $title = $this -> config -> getRandomTitle();
        $body = ($this -> config -> getRandomBody()) . $random . ($this -> config -> getRandomAltBody());
        $this -> email -> sendEmail($target, $title, $body, $body);
    }

    private function sendActiveEmail($target, $token){
        $title = $this -> config -> getActiveTitle();
        $body = ($this -> config -> getActiveBody()) . $token . ($this -> config -> getActiveAltBody());
        $this -> email -> sendEmail($target, $title, $body, $body);
    }

}