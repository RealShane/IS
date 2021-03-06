<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2021/1/15 10:16
 */


namespace app\admin\controller;


use app\BaseController;

use think\facade\View as V;
use think\facade\Env;

class View extends BaseController
{

    /**
     * 用户
     */

    public function userView(){
        return V::fetch('user/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function userEditView(){
        return V::fetch('user/edit', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    /**
     * 用户
     */

    /**
     * 综合测评
     */

    public function crossView(){
        return V::fetch('synthesize/cross/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function poorView(){
        return V::fetch('synthesize/poor/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function leaderView(){
        return V::fetch('synthesize/leader/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function configView(){
        return V::fetch('synthesize/config/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    /**
     * 综合测评
     */

    /**
     * 试题系统
     */

    public function examAnswersManageView(){
        return V::fetch('exam_answers/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function examPapersManageView(){
        return V::fetch('exam_papers/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function examPapersAddView(){
        return V::fetch('exam_papers/add', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function examPapersEditView(){
        return V::fetch('exam_papers/edit', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    /**
     * 试题系统
     */

    /**
     * 权限管理
     */

    public function authRuleManageView(){
        return V::fetch('rule/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function updateAuthRuleView(){
        return V::fetch('rule/edit', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function authGroupManageView(){
        return V::fetch('group/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function addAuthGroupView(){
        return V::fetch('group/add', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function authAccessManageView(){
        return V::fetch('auth/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function addAuthAccessView(){
        return V::fetch('auth/add', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }


    public function adminManageView(){
        return V::fetch('admin/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function updateAdminView(){
        return V::fetch('admin/edit', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function changePasswordView(){
        return V::fetch('admin/password', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function addAdminView(){
        return V::fetch('admin/add', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }


    /**
     * 权限管理
     */

    //欢迎页
    public function welcome(){
        return V::fetch('index/welcome', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    //主页
    public function index(){
        return V::fetch('index/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    //登录
    public function login(){
        return V::fetch('index/login', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function isLogin(){
        return $this -> success(true);
    }

}