<?php
declare (strict_types = 1);

namespace app\admin\middleware;

use app\BaseController;
use app\common\model\admin\AuthAccess;
use app\common\model\admin\AuthRule;
use app\common\model\admin\AuthGroup;


class Auth extends BaseController
{

    public function handle($request, \Closure $next){
        $user = $this -> getUser();
        $authAccess = (new AuthAccess()) -> findByUid($user['id']);
        if (empty($authAccess)){
            return $this -> fail("超级管理员未给此管理员分配权限，请联系超级管理员！");
        }
        $authGroup = (new AuthGroup()) -> findByIdWithStatus($authAccess['group']);
        if (empty($authGroup)){
            return $this -> fail("权限被禁用！");
        }
        if ($authGroup['rules'] == '*'){
            return $next($request);
        }
        $rules = explode(',', $authGroup['rules']);
        $authRule = new AuthRule();
        foreach ($rules as $rule){
            if (empty($rule)){
                continue;
            }
            $api = $authRule -> findById($rule);
            if (empty($api)){
                continue;
            }
            if (($request -> pathinfo()) == $api['path']){
                return $next($request);
            }
        }
        return $this -> fail("你没有权限访问！");
    }

}