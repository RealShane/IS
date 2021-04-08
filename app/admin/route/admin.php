<?php
use think\facade\Route;
use \app\admin\middleware\Auth;
use \app\admin\middleware\IsLogin;



/**
 * 无Token
 */
Route::group(function () {
    //登录
    Route::rule('login', '/admin/User/login', 'POST');
    /**
     * 页面
     */
    //登录
    Route::rule('loginView', '/admin/View/login', 'GET');
    //主页
    Route::rule('Index', '/admin/View/index', 'GET');
    //欢迎页
    Route::rule('welcome', '/admin/View/welcome', 'GET');
    /**
     * 权限管理
     */
    //管理员管理
    Route::rule('View/Admin/adminManageView', '/admin/View/adminManageView', 'GET');
    Route::rule('View/Admin/updateAdminView', '/admin/View/updateAdminView', 'GET');
    Route::rule('View/Admin/changePasswordView', '/admin/View/changePasswordView', 'GET');
    Route::rule('View/Admin/addAdminView', '/admin/View/addAdminView', 'GET');
    //权限分配
    Route::rule('View/Auth/authAccessManageView', '/admin/View/authAccessManageView', 'GET');
    Route::rule('View/Auth/addAuthAccessView', '/admin/View/addAuthAccessView', 'GET');
    //权限组
    Route::rule('View/Group/authGroupManageView', '/admin/View/authGroupManageView', 'GET');
    Route::rule('View/Group/addAuthGroupView', '/admin/View/addAuthGroupView', 'GET');
    //权限规则
    Route::rule('View/Rule/authRuleManageView', '/admin/View/authRuleManageView', 'GET');
    Route::rule('View/Rule/updateAuthRuleView', '/admin/View/updateAuthRuleView', 'GET');
    //试题系统
    Route::rule('View/Exam/Papers/index', '/admin/View/examPapersManageView', 'GET');
    Route::rule('View/Exam/Papers/add', '/admin/View/examPapersAddView', 'GET');
    Route::rule('View/Exam/Papers/edit', '/admin/View/examPapersEditView', 'GET');

});
/**
 * 有Token
 */
Route::group(function () {
    Route::rule('Admin/isLogin', '/admin/View/isLogin', 'POST');
    //目录
    Route::rule('adminMenuAndView', '/admin/Auth/adminMenuAndView', 'POST');
    //管理员信息
    Route::rule('adminInfo', '/admin/User/adminInfo', 'POST');
    //管理员退出
    Route::rule('quit', '/admin/User/quit', 'POST');
}) -> middleware(IsLogin::class);
/**
 * 有Token+鉴权
 */
Route::group(function () {

    /**
     * -----------------------------试题系统-----------------------------
     */
    Route::rule('Exam/getTarget', '/admin/Exam/getTarget', 'POST');
    Route::rule('Exam/commitPaper', '/admin/Exam/commitPaper', 'POST');



    /**
     * 超级权限
     */
    /**
     * -----------------------------权限-----------------------------
     */

    Route::rule('addGroupComment', '/admin/Auth/addGroupComment', 'POST');
    Route::rule('addAccessComment', '/admin/Auth/addAccessComment', 'POST');
    Route::rule('viewRule', '/admin/Auth/viewRule', 'POST');
    Route::rule('updateRule', '/admin/Auth/updateRule', 'POST');
    Route::rule('getRule', '/admin/Auth/getRule', 'POST');
    Route::rule('viewAllGroup', '/admin/Auth/viewAllGroup', 'POST');
    Route::rule('deleteGroup', '/admin/Auth/deleteGroup', 'POST');
    Route::rule('addGroup', '/admin/Auth/addGroup', 'POST');
    Route::rule('viewAllAccess', '/admin/Auth/viewAllAccess', 'POST');
    Route::rule('deleteAccess', '/admin/Auth/deleteAccess', 'POST');
    Route::rule('addAccess', '/admin/Auth/addAccess', 'POST');

    /**
     * -----------------------------管理员-----------------------------
     */
    Route::rule('getAdmin', '/admin/User/getAdmin', 'POST');
    Route::rule('deleteAdmin', '/admin/User/deleteAdmin', 'POST');
    Route::rule('getTargetAdmin', '/admin/User/getTargetAdmin', 'POST');
    Route::rule('viewAllAdmin', '/admin/User/viewAllAdmin', 'POST');
    Route::rule('updateAdmin', '/admin/User/updateAdmin', 'POST');
    Route::rule('changePassword', '/admin/User/changePassword', 'POST');
    Route::rule('addAdmin', '/admin/User/addAdmin', 'POST');
}) -> middleware(IsLogin::class) -> middleware(Auth::class);

//----------------------------------------------------------------------------------
/*
                          _ooOoo_
                         o8888888o
                         88" . "88
                         (| -_- |)
                         O\  =  /O
                      ____/`---'\____
                    .'  \\|     |//  `.
                   /  \\|||  :  |||//  \
                  /  _||||| -:- |||||-  \
                  |   | \\\  -  /// |   |
                  | \_|  ''\---/''  |   |
                  \  .-\__  `-`  ___/-. /
                ___`. .'  /--.--\  `. . __
             ."" '<  `.___\_<|>_/___.'  >'"".
            | | :  `- \`.;`\ _ /`;.`/ - ` : | |
            \  \ `-.   \_ __\ /__ _/   .-` /  /
       ======`-.____`-.___\_____/___.-`____.-'======
                          `=---='
       ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
                    佛祖保佑       永无BUG
       */
