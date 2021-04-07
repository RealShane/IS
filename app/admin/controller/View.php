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
     * 试听列表
     */

    public function audioManageView(){
        return V::fetch('audio/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function audioAddView(){
        return V::fetch('audio/add', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function audioEditView(){
        return V::fetch('audio/edit', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    /**
     * 试听列表
     */
    
    /**
     * 视频列表
     */
     
    public function videoManageView(){
        return V::fetch('video/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function videoAddView(){
        return V::fetch('video/add', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function videoEditView(){
        return V::fetch('video/edit', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }
     
     /**
     * 视频列表
     */
     
    /**
     * 设置
     */

    public function configManageView(){
        return V::fetch('config/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function configEditView(){
        return V::fetch('config/edit', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    /**
     * 设置
     */

    /**
     * 订单
     */

    public function orderManageView(){
        return V::fetch('order/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function orderAddView(){
        return V::fetch('order/add', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function orderEditView(){
        return V::fetch('order/edit', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    /**
     * 订单
     */

    /**
     * 分类
     */

    public function sortManageView(){
        return V::fetch('sort/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function sortAddView(){
        return V::fetch('sort/add', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function sortEditView(){
        return V::fetch('sort/edit', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    /**
     * 分类
     */

    /**
     * 老师
     */

    public function teacherManageView(){
        return V::fetch('teacher/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function teacherAddView(){
        return V::fetch('teacher/add', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function teacherEditView(){
        return V::fetch('teacher/edit', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    /**
     * 老师
     */

    /**
     * 用户
     */

    public function wxUserManageView(){
        return V::fetch('wxUser/index', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function wxUserAddView(){
        return V::fetch('wxUser/add', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    public function wxUserEditView(){
        return V::fetch('wxUser/edit', [
            'secret' => Env::get('ADMIN.FILE', '')
        ]);
    }

    /**
     * 用户
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