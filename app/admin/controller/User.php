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
use app\common\business\admin\User as Business;
use app\common\validate\admin\User as Validate;
use think\App;

class User extends BaseController
{

    protected $business = NULL;

    public function __construct(App $app, Business $business){
        parent::__construct($app);
        $this -> business = $business;
    }

    public function getUser(){
        $errCode = $this -> business -> getUser($this -> request -> param("id", '', 'htmlspecialchars'));
        return $this -> success($errCode);
    }

    public function getTargetUser(){
        $errCode = $this -> business -> getTargetUser($this -> request -> param("name", '', 'htmlspecialchars'));
        return $this -> success($errCode);
    }

    public function viewAllUser(){
        $errCode = $this -> business -> viewAllUser($this -> request -> param("num", 10, 'htmlspecialchars'));
        return $this -> success($errCode);
    }

    public function getAdmin(){
        $errCode = $this -> business -> getAdmin($this -> request -> param("id", '', 'htmlspecialchars'));
        return $this -> success($errCode);
    }

    public function deleteAdmin(){
        $data['target'] = $this -> request -> param("target", '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('deleteAdmin') -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> deleteAdmin($data['target']);
        return $this -> success("删除管理员成功！");
    }

    public function getTargetAdmin(){
        $errCode = $this -> business -> getTargetAdmin($this -> request -> param("username", '', 'htmlspecialchars'));
        return $this -> success($errCode);
    }

    public function viewAllAdmin(){
        $errCode = $this -> business -> viewAllAdmin($this -> request -> param("num", 10, 'htmlspecialchars'));
        return $this -> success($errCode);
    }

    public function updateAdmin(){
        $data['target'] = $this -> request -> param("target", '', 'htmlspecialchars');
        $data['username'] = $this -> request -> param("username", '', 'htmlspecialchars');
        $data['status'] = $this -> request -> param("status", '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('updateAdmin') -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> updateAdmin($data);
        return $this -> success("修改成功！");
    }

    public function changePassword(){
        $data['target'] = $this -> request -> param("target", '', 'htmlspecialchars');
        $data['password'] = $this -> request -> param("password", '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('changePassword') -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> changePassword($data);
        return $this -> success("修改密码成功！");
    }

    public function addAdmin(){
        $data['username'] = $this -> request -> param("username", '', 'htmlspecialchars');
        $data['password'] = $this -> request -> param("password", '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('addAdmin') -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> addAdmin($data);
        return $this -> success("添加管理员成功！");
    }

    public function quit(){
        $this -> business -> quit($this -> getToken());
        return $this -> success("退出成功！");
    }

    public function adminInfo(){
        return $this -> success($this -> business -> adminInfo($this -> getToken()));
    }

    public function login(){
        $data['username'] = $this -> request -> param("username", '', 'htmlspecialchars');
        $data['password'] = $this -> request -> param("password", '', 'htmlspecialchars');
        $data['validate'] = $this -> request -> param("validate", '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('login') -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success(['token' => $this -> business -> login($data)]);
    }

}