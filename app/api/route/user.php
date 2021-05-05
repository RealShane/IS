<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/23 14:22
 */

use think\facade\Route;
use \app\api\middleware\IsLogin;

Route::group('User', function () {
    Route::rule('activeRegister', '/api/User/activeRegister', 'GET');
    Route::rule('sendRandom', '/api/User/sendRandom', 'POST');
    Route::rule('register', '/api/User/register', 'POST');
    Route::rule('login', '/api/User/login', 'POST');
});

Route::group('User', function () {
    Route::rule('menuAndView', '/api/User/menuAndView', 'POST');
    Route::rule('logoff', '/api/User/logoff', 'POST');
    Route::rule('isLogin', '/api/User/isLogin', 'POST');
    Route::rule('userInfo', '/api/User/userInfo', 'POST');
    Route::rule('joinClass', '/api/User/joinClass', 'POST');
    Route::rule('sendUserRandom', '/api/User/sendUserRandom', 'POST');
    Route::rule('changePassword', '/api/User/changePassword', 'POST');
}) -> middleware(IsLogin::class);
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