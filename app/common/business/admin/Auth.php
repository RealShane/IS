<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/10/1 11:17
 */


namespace app\common\business\admin;


use app\common\business\lib\Str;
use app\common\model\admin\AuthRule;
use app\common\model\admin\User;
use app\common\model\admin\AuthAccess;
use app\common\model\admin\AuthGroup;

class Auth
{

    private $userModel = NULL;
    private $accessModel = NULL;
    private $groupModel = NULL;
    private $ruleModel = NULL;
    private $strLib = NULL;

    public function __construct(){
        $this -> userModel = new User();
        $this -> accessModel = new AuthAccess();
        $this -> groupModel = new AuthGroup();
        $this -> ruleModel = new AuthRule();
        $this -> strLib = new Str();
    }

    public function adminMenuAndView($user){
        try {
            $access = $this -> accessModel -> findByUid($user['id']);
            if (empty($access)){
                return config("status.not_exist");
            }
            $group = $this -> groupModel -> findById($access['group']);
            if (empty($group)){
                return config("status.not_exist");
            }
            if ($group['rules'] == '*'){
                return $this -> ruleModel -> superAdminMenuAndView();
            }
            return $this -> ruleModel -> otherAdminMenuAndView(explode(',', $group['rules']));
        }catch (\Exception $exception){
            return NULL;
        }
    }

    public function viewRule($num){
        try {
            $rules = $this -> ruleModel -> findMenuAndView($num);
            foreach ($rules as $rule){
                if (empty($rule['pid'])){
                    $rule['pid'] = '无父级目录';
                    continue;
                }
                $temp = $this -> ruleModel -> findByIdWithOutStatus($rule['pid']);
                $rule['pid'] = $temp['name'];
            }
            return $rules;
        }catch (\Exception $exception){
            return NULL;
        }
    }

    public function updateRule($data){
        $rule = $this -> ruleModel -> findByIdWithOutStatus($data['id']);
        if (empty($rule)){
            return config("status.not_exist");
        }
        return $this -> ruleModel -> updateById($data) ? config("status.success") : config("status.failed");
    }

    public function viewAllGroup($num){
        try {
            $groups = $this -> groupModel -> findAll($num);
            foreach ($groups as $group){
                if ($group['rules'] == '*'){
                    $group['rules_name'] = '超级权限';
                    continue;
                }
                $rules = explode(',', $group['rules']);
                $str = NULL;
                foreach ($rules as $rule){
                    if (empty($rule)){
                        continue;
                    }
                    $temp = $this -> ruleModel -> findByIdWithOutStatus($rule);
                    $str .= $temp['name'] . ',';
                }
                $group['rules_name'] = rtrim($str, ',');
            }
            return $groups;
        }catch (\Exception $exception){
            return NULL;
        }
    }

    public function deleteGroup($id){
        $isExist = $this -> groupModel -> findByIdWithOutStatus($id);
        if (empty($isExist)){
            return config("status.not_exist");
        }
        return $this -> groupModel -> deleteById($id) ? config("status.success") : config("status.failed");
    }

    public function addGroup($data){
        $rules = explode(',', $data['rules']);
        foreach ($rules as $rule){
            if (empty($rule)){
                continue;
            }
            $temp = $this -> ruleModel -> findById($rule);
            if (empty($temp)){
                return config("status.not_exist");
            }
        }
        $isExist = $this -> groupModel -> findByName($data['name']);
        if (empty($isExist)){
            return $this -> groupModel -> save($data) ? config("status.success") : config("status.failed");
        }
        return $this -> groupModel -> updateByName($data) ? config("status.success") : config("status.failed");
    }

    public function viewAllAccess($num){
        try {
            $accesses = $this -> accessModel -> findAll($num);
            foreach ($accesses as $access){
                $user = $this -> userModel -> findById($access['uid']);
                $group = $this -> groupModel -> findByIdWithOutStatus($access['group']);
                $access['username'] = $user['username'];
                $access['group_name'] = $group['name'];
            }
            return $accesses;
        }catch (\Exception $exception){
            return NULL;
        }
    }

    public function deleteAccess($id){
        $isExist = $this -> accessModel -> findById($id);
        if (empty($isExist)){
            return config("status.not_exist");
        }
        return $this -> accessModel -> deleteById($id) ? config("status.success") : config("status.failed");
    }

    public function addAccess($data){
        $userExist = $this -> userModel -> findById($data['uid']);
        if (empty($userExist)){
            return config("status.not_exist");
        }
        $groupExist = $this -> groupModel -> findById($data['group']);
        if (empty($groupExist)){
            return config("status.not_exist");
        }
        $isExist = $this -> accessModel -> findByUid($data['uid']);
        if (empty($isExist)){
            return $this -> accessModel -> save($data) ? config("status.success") : config("status.failed");
        }
        return $this -> accessModel -> updateByUid($data) ? config("status.success") : config("status.failed");
    }

}