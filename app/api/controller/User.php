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
use app\common\validate\api\User as UserValidate;
use app\common\business\api\User as UserBusiness;

class User extends BaseController
{

    public function isLogin(){
        return $this -> show(
            config("status.success"),
            config("message.success"),
            "合法登录"
        );
    }

    public function changePassword(){

    }

    public function viewMe(){
        $errCode = (new UserBusiness()) -> viewMe($this -> getUser());
        if ($errCode == config("status.failed")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "内部异常，请稍候重试！"
            );
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $errCode
        );
    }

    public function joinClass(){
        $user = $this -> getUser();
        $inviteCode = $this -> request -> param("invite_code", '', 'htmlspecialchars');
        try {
            validate(UserValidate::class) -> scene("invite_code") -> check(['invite_code' => $inviteCode]);
        } catch (\Exception $exception) {
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                $exception -> getMessage()
            );
        }
        $errCode = (new UserBusiness()) -> joinClass($inviteCode, $user);
        if ($errCode == config('status.exist')){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "已加入班级，请勿加入其他班级或重复加入！"
            );
        }
        if ($errCode == config('status.not_exist')){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "班级不存在或未开放加入！"
            );
        }
        if ($errCode == config('status.failed')){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "内部异常，请稍候重试！"
            );
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            "加入班级成功！"
        );
    }

    public function logoff(){
        return cache(config('redis.token_pre') . $this -> getToken(), NULL) ? $this -> show(
            config("status.success"),
            config("message.success"),
            "退出登录成功！"
        ) : $this -> show(
            config("status.failed"),
            config("message.failed"),
            "退出登录失败！"
        );
    }

    public function sendRandom(){
        $data['email'] = $this -> request -> param("email", '', 'htmlspecialchars');
        $data['validate'] = $this -> request -> param("validate", '', 'htmlspecialchars');
        try {
            validate(UserValidate::class) -> scene("send_email") -> check($data);
        } catch (\Exception $exception) {
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                $exception -> getMessage()
            );
        }
        $errCode = (new UserBusiness()) -> sendRandom($data['email']);
        if ($errCode == config('status.not_exist')){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "用户不存在！"
            );
        }
        if ($errCode == config('status.failed')){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "内部异常，请稍候重试！"
            );
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            "发送成功，请查看邮箱！"
        );
    }

    public function login(){
        $data['email'] = $this -> request -> param("email", '', 'htmlspecialchars');
        $data['password'] = $this -> request -> param("password", '', 'htmlspecialchars');
        $data['random'] = $this -> request -> param("random", '', 'htmlspecialchars');
        $data['validate'] = $this -> request -> param("validate", '', 'htmlspecialchars');
        $data['login_type'] = $this -> request -> param("login_type", '', 'htmlspecialchars');
        $data['login_type'] = strtolower($data['login_type']);
        try {
            validate(UserValidate::class) -> scene($data['login_type']) -> check($data);
        } catch (\Exception $exception) {
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                $exception -> getMessage()
            );
        }
        $errCode = (new UserBusiness()) -> login($data);
        if ($errCode == config('status.failed')){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "内部异常，请稍候重试！"
            );
        }
        if ($errCode == config('status.not_exist')){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "用户不存在！"
            );
        }
        if ($errCode == config('status.goto')){
            return $this -> show(
                config("status.goto"),
                config("message.goto"),
                "检测到异地登录，已发送验证邮件！"
            );
        }
        if ($errCode == config('status.password_error')){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "密码填写错误！"
            );
        }
        if ($errCode == config('status.random_error')){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "邮件验证码填写错误，请仔细查看邮件！"
            );
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            ['token' => $errCode]
        );
    }

    public function activeRegister(){
        $token = $this -> request -> param("token", '', 'htmlspecialchars');
        try {
            validate(UserValidate::class) -> scene("active_register") -> check(['token' => $token]);
        } catch (\Exception $exception) {
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                $exception -> getMessage()
            );
        }
        $errCode = (new UserBusiness()) -> activeRegister($token);
        if ($errCode == config("status.not_exist")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "注册过期，请重新注册！"
            );
        }
        if ($errCode == config("status.exist")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "已激活，请勿重复激活！"
            );
        }
        if ($errCode == config("status.failed")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "内部异常，请稍候重试！"
            );
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            "激活成功！"
        );
    }

    public function register(){
        $data['email'] = $this -> request -> param("email", '', 'htmlspecialchars');
        $data['password'] = $this -> request -> param("password", '', 'htmlspecialchars');
        $data['name'] = $this -> request -> param("name", '', 'htmlspecialchars');
        $data['sex'] = $this -> request -> param("sex", '', 'htmlspecialchars');
        $data['student_id'] = $this -> request -> param("student_id", '', 'htmlspecialchars');
        $data['validate'] = $this -> request -> param("validate", '', 'htmlspecialchars');
        try {
            validate(UserValidate::class) -> scene("register") -> check($data);
        } catch (\Exception $exception) {
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                $exception -> getMessage()
            );
        }
        $errCode = (new UserBusiness()) -> register($data);
        if ($errCode == config("status.exist")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "邮箱已被注册！"
            );
        }
        if ($errCode == config("status.failed")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "内部异常，请稍候重试！"
            );
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            "注册成功，等待邮件激活！"
        );
    }

}