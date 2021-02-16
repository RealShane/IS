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
    //试听列表
    Route::rule('View/Audio/index', '/admin/View/audioManageView', 'GET');
    Route::rule('View/Audio/add', '/admin/View/audioAddView', 'GET');
    Route::rule('View/Audio/edit', '/admin/View/audioEditView', 'GET');
    //视频列表
    Route::rule('View/Video/index', '/admin/View/videoManageView', 'GET');
    Route::rule('View/Video/add', '/admin/View/videoAddView', 'GET');
    Route::rule('View/Video/edit', '/admin/View/videoEditView', 'GET');
    //设置
    Route::rule('View/Config/index', '/admin/View/configManageView', 'GET');
    Route::rule('View/Config/edit', '/admin/View/configEditView', 'GET');
    //订单
    Route::rule('View/Order/index', '/admin/View/orderManageView', 'GET');
    Route::rule('View/Order/add', '/admin/View/orderAddView', 'GET');
    Route::rule('View/Order/edit', '/admin/View/orderEditView', 'GET');
    //分类
    Route::rule('View/Sort/index', '/admin/View/sortManageView', 'GET');
    Route::rule('View/Sort/add', '/admin/View/sortAddView', 'GET');
    Route::rule('View/Sort/edit', '/admin/View/sortEditView', 'GET');
    //老师
    Route::rule('View/Teacher/index', '/admin/View/teacherManageView', 'GET');
    Route::rule('View/Teacher/add', '/admin/View/teacherAddView', 'GET');
    Route::rule('View/Teacher/edit', '/admin/View/teacherEditView', 'GET');
    //用户
    Route::rule('View/WxUser/index', '/admin/View/wxUserManageView', 'GET');
    Route::rule('View/WxUser/add', '/admin/View/wxUserAddView', 'GET');
    Route::rule('View/WxUser/edit', '/admin/View/wxUserEditView', 'GET');
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
     * -----------------------------试听列表-----------------------------
     */
    Route::rule('Audio/getTarget', '/admin/Audio/getTarget', 'POST');
    Route::rule('Audio/create', '/admin/Audio/create', 'POST');
    Route::rule('Audio/delete', '/admin/Audio/delete', 'POST');
    Route::rule('Audio/update', '/admin/Audio/update', 'POST');
    Route::rule('Audio/retrieve', '/admin/Audio/retrieve', 'POST');
    Route::rule('Audio/showAll', '/admin/Audio/showAll', 'POST');
    Route::rule('Audio/uploadAudio', '/admin/Audio/uploadAudio', 'POST');
    /**
     * -----------------------------视频列表-----------------------------
     */
    Route::rule('Video/getTarget', '/admin/Video/getTarget', 'POST');
    Route::rule('Video/create', '/admin/Video/create', 'POST');
    Route::rule('Video/delete', '/admin/Video/delete', 'POST');
    Route::rule('Video/update', '/admin/Video/update', 'POST');
    Route::rule('Video/retrieve', '/admin/Video/retrieve', 'POST');
    Route::rule('Video/showAll', '/admin/Video/showAll', 'POST');
    Route::rule('Video/uploadVideo', '/admin/Video/uploadVideo', 'POST');
    /**
     * -----------------------------设置-----------------------------
     */
    Route::rule('Config/getTarget', '/admin/Config/getTarget', 'POST');
    Route::rule('Config/update', '/admin/Config/update', 'POST');
    Route::rule('Config/showAll', '/admin/Config/showAll', 'POST');
    /**
     * -----------------------------订单-----------------------------
     */
    Route::rule('Order/getTarget', '/admin/Order/getTarget', 'POST');
    Route::rule('Order/delete', '/admin/Order/delete', 'POST');
    Route::rule('Order/update', '/admin/Order/update', 'POST');
    Route::rule('Order/retrieve', '/admin/Order/retrieve', 'POST');
    Route::rule('Order/showAll', '/admin/Order/showAll', 'POST');
    /**
     * -----------------------------分类-----------------------------
     */
    Route::rule('Sort/getTarget', '/admin/Sort/getTarget', 'POST');
    Route::rule('Sort/create', '/admin/Sort/create', 'POST');
    Route::rule('Sort/delete', '/admin/Sort/delete', 'POST');
    Route::rule('Sort/update', '/admin/Sort/update', 'POST');
    Route::rule('Sort/retrieve', '/admin/Sort/retrieve', 'POST');
    Route::rule('Sort/showAll', '/admin/Sort/showAll', 'POST');
    Route::rule('Sort/parentSort', '/admin/Sort/parentSort', 'POST');
    /**
     * -----------------------------老师-----------------------------
     */
    Route::rule('Teacher/getTarget', '/admin/Teacher/getTarget', 'POST');
    Route::rule('Teacher/create', '/admin/Teacher/create', 'POST');
    Route::rule('Teacher/delete', '/admin/Teacher/delete', 'POST');
    Route::rule('Teacher/update', '/admin/Teacher/update', 'POST');
    Route::rule('Teacher/retrieve', '/admin/Teacher/retrieve', 'POST');
    Route::rule('Teacher/showAll', '/admin/Teacher/showAll', 'POST');
    /**
     * -----------------------------微信用户-----------------------------
     */
    Route::rule('WxUser/getTarget', '/admin/WxUser/getTarget', 'POST');
    Route::rule('WxUser/delete', '/admin/WxUser/delete', 'POST');
    Route::rule('WxUser/update', '/admin/WxUser/update', 'POST');
    Route::rule('WxUser/retrieve', '/admin/WxUser/retrieve', 'POST');
    Route::rule('WxUser/showAll', '/admin/WxUser/showAll', 'POST');

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
