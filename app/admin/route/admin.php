<?php
use think\facade\Route;
use \app\admin\middleware\Auth;
use \app\admin\middleware\IsLogin;



/**
 * 无Token
 */
Route::group(function () {
    Route::rule('login', '/admin/User/login', 'POST');
});
/**
 * 有Token
 */
Route::group(function () {
    /**
     * 目录
     */
    Route::rule('adminMenuAndView', '/admin/Auth/adminMenuAndView', 'POST');
}) -> middleware(IsLogin::class);
/**
 * 有Token+鉴权
 */
Route::group(function () {
    /**
     * 超级权限
     */
    /**
     * -----------------------------权限-----------------------------
     */

    Route::rule('addGroupComment', '/admin/Auth/addGroupComment', 'POST');
    Route::rule('addAccessComment', '/admin/Auth/addAccessComment', 'POST');
    Route::rule('adminMenuAndView', '/admin/Auth/adminMenuAndView', 'POST');
    Route::rule('viewRule', '/admin/Auth/viewRule', 'POST');
    Route::rule('updateRule', '/admin/Auth/updateRule', 'POST');
    Route::rule('viewAllGroup', '/admin/Auth/viewAllGroup', 'POST');
    Route::rule('deleteGroup', '/admin/Auth/deleteGroup', 'POST');
    Route::rule('addGroup', '/admin/Auth/addGroup', 'POST');
    Route::rule('viewAllAccess', '/admin/Auth/viewAllAccess', 'POST');
    Route::rule('deleteAccess', '/admin/Auth/deleteAccess', 'POST');
    Route::rule('addAccess', '/admin/Auth/addAccess', 'POST');

    /**
     * -----------------------------管理员-----------------------------
     */
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
