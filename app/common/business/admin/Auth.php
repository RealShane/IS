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
use think\Exception;

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

    public function getRule($id){
        return $this -> ruleModel -> findById($id);
    }

    public function adminMenuAndView($user){
        $access = $this -> accessModel -> findByUid($user['id']);
        if (empty($access)){
            throw new Exception("该管理员账号未分配权限！");
        }
        $group = $this -> groupModel -> findByIdWithStatus($access['group']);
        if (empty($group)){
            throw new Exception("该管理员所在权限组已失效！");
        }
        if ($group['rules'] == '*'){
            return $this -> ruleModel -> superAdminMenuAndView();
        }
        return $this -> ruleModel -> otherAdminMenuAndView(explode(',', $group['rules']));
    }

    public function viewRule($num){
        $rules = $this -> ruleModel -> findMenuAndView($num);
        foreach ($rules as $rule){
            if (empty($rule['pid'])){
                $rule['pid'] = '无父级目录';
                continue;
            }
            $temp = $this -> ruleModel -> findById($rule['pid']);
            $rule['pid'] = $temp['name'];
        }
        return $rules;
    }

    public function updateRule($data){
        $rule = $this -> ruleModel -> findById($data['id']);
        if (empty($rule)){
            throw new Exception("权限规则不存在！");
        }
        $this -> ruleModel -> updateById($data);
    }

    public function viewAllGroup($num){
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
                $temp = $this -> ruleModel -> findById($rule);
                $str .= $temp['name'] . ',';
            }
            $group['rules_name'] = rtrim($str, ',');
        }
        return $groups;
    }

    public function deleteGroup($id){
        $isExist = $this -> groupModel -> findById($id);
        if (empty($isExist)){
            throw new Exception("权限组不存在！");
        }
        $isExist -> delete();
    }

    public function addGroupComment(){
        return $this -> ruleModel -> ruleComment();
    }

    public function addGroup($data){
        $rules = explode(',', $data['rules']);
        foreach ($rules as $rule){
            if (empty($rule)){
                continue;
            }
            $temp = $this -> ruleModel -> findByIdWithStatus($rule);
            if (empty($temp)){
                throw new Exception("部分权限规则不存在，请刷新页面！");
            }
        }
        $isExist = $this -> groupModel -> findByName($data['name']);
        if (empty($isExist)){
            $this -> groupModel -> save($data);
        }
        $this -> groupModel -> updateByName($data);
    }

    public function viewAllAccess($num){
        $accesses = $this -> accessModel -> findAll($num);
        foreach ($accesses as $access){
            $user = $this -> userModel -> findById($access['uid']);
            $group = $this -> groupModel -> findById($access['group']);
            $access['username'] = $user['username'];
            $access['group_name'] = $group['name'];
        }
        return $accesses;
    }

    public function deleteAccess($id){
        $isExist = $this -> accessModel -> findById($id);
        if (empty($isExist)){
            throw new Exception("权限分配记录不存在！");
        }
        $isExist -> delete();
    }

    public function addAccessComment(){
        return [
            'user' => $this -> userModel -> findAllWithOutPaginate(),
            'group' => $this -> groupModel -> findAllWithOutPaginate()
        ];
    }

    public function addAccess($data){
        $userExist = $this -> userModel -> findById($data['uid']);
        if (empty($userExist)){
            throw new Exception("管理员不存在！");
        }
        $groupExist = $this -> groupModel -> findByIdWithStatus($data['group']);
        if (empty($groupExist)){
            throw new Exception("权限组不存在！");
        }
        $isExist = $this -> accessModel -> findByUid($data['uid']);
        if (empty($isExist)){
            $this -> accessModel -> save($data);
        }
        $this -> accessModel -> updateByUid($data);
    }

}