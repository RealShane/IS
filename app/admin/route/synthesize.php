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
use \app\admin\middleware\Auth;
use \app\admin\middleware\IsLogin;

Route::group('View/Synthesize', function () {
    Route::rule('Cross/index', '/admin/View/crossView', 'GET');
    Route::rule('Poor/index', '/admin/View/poorView', 'GET');
    Route::rule('Leader/index', '/admin/View/leaderView', 'GET');
    Route::rule('Config/index', '/admin/View/configView', 'GET');
});

Route::group('Synthesize', function () {
    Route::rule('exportCrossExcel', '/admin/Synthesize/exportCrossExcel', 'GET');
    Route::rule('exportPoorSignExcel', '/admin/Synthesize/exportPoorSignExcel', 'GET');
    Route::rule('exportPoorSignScoreExcel', '/admin/Synthesize/exportPoorSignScoreExcel', 'GET');
    Route::rule('exportLeaderExcel', '/admin/Synthesize/exportLeaderExcel', 'GET');
});
Route::group('Synthesize', function () {
    Route::rule('getAllClass', '/admin/Synthesize/getAllClass', 'POST');
    Route::rule('getTargetClass', '/admin/Synthesize/getTargetClass', 'POST');
    Route::rule('getAllConfig', '/admin/Synthesize/getAllConfig', 'POST');
    Route::rule('setConfig', '/admin/Synthesize/setConfig', 'POST');
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