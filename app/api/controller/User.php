<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/23 14:42
 */


namespace app\api\controller;


use app\BaseController;
use app\common\validate\api\User as Validate;
use app\common\business\api\User as Business;
use think\App;

class User extends BaseController
{

    protected $business = NULL;

    public function __construct(App $app, Business $business){
        parent::__construct($app);
        $this -> business = $business;
    }

    public function isLogin(){
        return $this -> success("合法登录");
    }

    public function changeSex(){
        $data['user'] = $this -> getUser();
        $data['sex'] = $this -> request -> param("sex", '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene("change_sex") -> check($data);
        } catch (\Exception $exception) {
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> changeSex($data);
        return $this -> success("修改成功!");
    }

    public function changePassword(){
        $data['user'] = $this -> getUser();
        $data['random'] = $this -> request -> param("random", '', 'htmlspecialchars');
        $data['password'] = $this -> request -> param("password", '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene("change_password") -> check($data);
        } catch (\Exception $exception) {
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> changePassword($data);
        return $this -> success("修改成功!");
    }

    public function sendUserRandom(){
        $user = $this -> getUser();
        $this -> business -> sendRandom($user['email']);
        return $this -> success("发送成功，请查看邮箱！");
    }

    public function userInfo(){
        return $this -> success($this -> business -> userInfo($this -> getUser()));
    }

    public function joinClass(){
        $user = $this -> getUser();
        $inviteCode = $this -> request -> param("invite_code", '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene("invite_code") -> check(['invite_code' => $inviteCode]);
        } catch (\Exception $exception) {
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> joinClass($inviteCode, $user);
        return $this -> success("加入班级成功！");
    }

    public function logoff(){
        $this -> business -> logoff($this -> getToken());
        return $this -> success("退出登录成功！");
    }

    public function sendRandom(){
        $data['email'] = $this -> request -> param("email", '', 'htmlspecialchars');
        $data['validate'] = $this -> request -> param("validate", '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene("send_email") -> check($data);
        } catch (\Exception $exception) {
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> sendRandom($data['email']);
        return $this -> success("发送成功，请查看邮箱！");
    }

    public function login(){
        $data['email'] = $this -> request -> param("email", '', 'htmlspecialchars');
        $data['password'] = $this -> request -> param("password", '', 'htmlspecialchars');
        $data['random'] = $this -> request -> param("random", '', 'htmlspecialchars');
        $data['validate'] = $this -> request -> param("validate", '', 'htmlspecialchars');
        $data['login_type'] = $this -> request -> param("login_type", '', 'htmlspecialchars');
        $data['login_type'] = strtolower($data['login_type']);
        try {
            validate(Validate::class) -> scene($data['login_type']) -> check($data);
        } catch (\Exception $exception) {
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success(['token' => $this -> business -> login($data)]);
    }

    public function activeRegister(){
        $token = $this -> request -> param("token", '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene("active_register") -> check(['token' => $token]);
        } catch (\Exception $exception) {
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> activeRegister($token);
        return $this -> success("激活成功！");
    }

    public function register(){
        $data['email'] = $this -> request -> param("email", '', 'htmlspecialchars');
        $data['password'] = $this -> request -> param("password", '', 'htmlspecialchars');
        $data['name'] = $this -> request -> param("name", '', 'htmlspecialchars');
        $data['student_id'] = $this -> request -> param("student_id", '', 'htmlspecialchars');
        $data['validate'] = $this -> request -> param("validate", '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene("register") -> check($data);
        } catch (\Exception $exception) {
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> register($data);
        return $this -> success("注册成功，等待邮件激活！");
    }

    public function menuAndView(){
        return $this -> success($this -> business -> menuAndView());
    }

}