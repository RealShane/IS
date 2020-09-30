<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/30 14:20
 */


namespace app\admin\controller;


use app\BaseController;
use app\common\business\admin\User as UserBusiness;
use app\common\validate\admin\User as UserValidate;

class User extends BaseController
{

    public function addAdmin(){
        $data['username'] = $this -> request -> param("username", '', 'htmlspecialchars');
        $data['password'] = $this -> request -> param("password", '', 'htmlspecialchars');
        try {
            validate(UserValidate::class) -> scene('addAdmin') -> check($data);
        }catch (\Exception $exception){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                $exception -> getMessage()
            );
        }
        $errCode = (new UserBusiness()) -> addAdmin($data);
        if ($errCode == config("status.exist")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "用户名已有！"
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
            "添加管理员成功！"
        );
    }

    public function login(){
        $data['username'] = $this -> request -> param("username", '', 'htmlspecialchars');
        $data['password'] = $this -> request -> param("password", '', 'htmlspecialchars');
        $data['validate'] = $this -> request -> param("password", '', 'htmlspecialchars');
        try {
            validate(UserValidate::class) -> scene('login') -> check($data);
        }catch (\Exception $exception){
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
        if ($errCode == config('status.password_error')){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "密码填写错误！"
            );
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            ['token' => $errCode]
        );
    }

}