<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/10/1 11:12
 */


namespace app\admin\controller;


use app\BaseController;
use app\common\business\admin\Auth as AuthBusiness;
use app\common\validate\admin\Auth as AuthValidate;

class Auth extends BaseController
{

    public function adminMenuAndView(){
        $errCode = (new AuthBusiness()) -> adminMenuAndView($this -> getUser());
        if (empty($errCode)){
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

    public function viewRule(){
        $errCode = (new AuthBusiness()) -> viewRule($this -> request -> param("num", '', 'htmlspecialchars'));
        if (empty($errCode)){
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

    public function updateRule(){
        $data['id'] = $this -> request -> param("id", '', 'htmlspecialchars');
        $data['name'] = $this -> request -> param("name", '', 'htmlspecialchars');
        $data['icon'] = $this -> request -> param("icon", '', 'htmlspecialchars');
        $data['weigh'] = $this -> request -> param("weigh", '', 'htmlspecialchars');
        $data['status'] = $this -> request -> param("status", '', 'htmlspecialchars');
        try {
            validate(AuthValidate::class) -> scene('updateRule') -> check($data);
        }catch (\Exception $exception){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                $exception -> getMessage()
            );
        }
        $errCode = (new AuthBusiness()) -> updateRule($data);
        if ($errCode == config("status.not_exist")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "权限规则不存在！"
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
            "操作成功！"
        );
    }

    public function viewAllGroup(){
        $errCode = (new AuthBusiness()) -> viewAllGroup($this -> request -> param("num", '', 'htmlspecialchars'));
        if (empty($errCode)){
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

    public function deleteGroup(){
        $id = $this -> request -> param("id", '', 'htmlspecialchars');
        try {
            validate(AuthValidate::class) -> scene('deleteGroup') -> check(['id' => $id]);
        }catch (\Exception $exception){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                $exception -> getMessage()
            );
        }
        $errCode = (new AuthBusiness()) -> deleteGroup($id);
        if ($errCode == config("status.not_exist")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "权限分配记录不存在！"
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
            "操作成功！"
        );
    }

    public function addGroup(){
        $data['name'] = $this -> request -> param("name", '', 'htmlspecialchars');
        $data['rules'] = $this -> request -> param("rules", '', 'htmlspecialchars');
        try {
            validate(AuthValidate::class) -> scene('addGroup') -> check($data);
        }catch (\Exception $exception){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                $exception -> getMessage()
            );
        }
        $errCode = (new AuthBusiness()) -> addGroup($data);
        if ($errCode == config("status.not_exist")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "权限规则不存在！"
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
            "操作成功！"
        );
    }

    public function viewAllAccess(){
        $errCode = (new AuthBusiness()) -> viewAllAccess($this -> request -> param("num", '', 'htmlspecialchars'));
        if (empty($errCode)){
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

    public function deleteAccess(){
        $id = $this -> request -> param("id", '', 'htmlspecialchars');
        try {
            validate(AuthValidate::class) -> scene('deleteAccess') -> check(['id' => $id]);
        }catch (\Exception $exception){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                $exception -> getMessage()
            );
        }
        $errCode = (new AuthBusiness()) -> deleteAccess($id);
        if ($errCode == config("status.not_exist")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "权限分配记录不存在！"
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
            "操作成功！"
        );
    }

    public function addAccess(){
        $data['uid'] = $this -> request -> param("uid", '', 'htmlspecialchars');
        $data['group'] = $this -> request -> param("group", '', 'htmlspecialchars');
        try {
            validate(AuthValidate::class) -> scene('addAccess') -> check($data);
        }catch (\Exception $exception){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                $exception -> getMessage()
            );
        }
        $errCode = (new AuthBusiness()) -> addAccess($data);
        if ($errCode == config("status.not_exist")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "管理员或权限组不存在！"
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
            "操作成功！"
        );
    }

}