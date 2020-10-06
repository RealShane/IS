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

/**
 * 无Token
 */
Route::group(function () {
    Route::rule('activeRegister', '/api/User/activeRegister', 'GET');
    Route::rule('sendRandom', '/api/User/sendRandom', 'POST');
    Route::rule('register', '/api/User/register', 'POST');
    Route::rule('login', '/api/User/login', 'POST');
});
/**
 * 有Token
 */
Route::group(function () {
    //用户接口
    Route::rule('logoff', '/api/User/logoff', 'GET');
    Route::rule('viewMe', '/api/User/viewMe', 'POST');
    Route::rule('joinClass', '/api/User/joinClass', 'POST');
    //综测接口
    Route::rule('poorSign', '/api/Synthesize/poorSign', 'POST');
    Route::rule('viewPoorOption', '/api/Synthesize/viewPoorOption', 'POST');
    Route::rule('uploadProve', '/api/Synthesize/uploadProve', 'POST');
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