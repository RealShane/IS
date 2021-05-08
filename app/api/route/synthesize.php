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

Route::group('View/Synthesize', function () {
    Route::rule('Cross/index', '/api/View/crossView', 'GET');
    Route::rule('Cross/add', '/api/View/crossAddView', 'GET');
    Route::rule('Poor/index', '/api/View/poorView', 'GET');
    Route::rule('Poor/sign', '/api/View/poorSignView', 'GET');
    Route::rule('Poor/add', '/api/View/poorAddView', 'GET');
    Route::rule('Poor/download', '/api/View/poorDownloadView', 'GET');
    Route::rule('Leader/index', '/api/View/leaderView', 'GET');
});


Route::group('Synthesize', function () {
    Route::rule('downloadProve', '/api/Synthesize/downloadProve', 'GET');
});
Route::group('Synthesize', function () {
    //综测评分
    Route::rule('showCrossList', '/api/Synthesize/showCrossList', 'POST');
    Route::rule('crossScore', '/api/Synthesize/crossScore', 'POST');
    Route::rule('getCrossScore', '/api/Synthesize/getCrossScore', 'POST');
    //贫困生
    Route::rule('showPoorSignDetail', '/api/Synthesize/showPoorSignDetail', 'POST');
    Route::rule('showPoorSignList', '/api/Synthesize/showPoorSignList', 'POST');
    Route::rule('poorSign', '/api/Synthesize/poorSign', 'POST');
    Route::rule('viewPoorOption', '/api/Synthesize/viewPoorOption', 'POST');
    Route::rule('uploadProve', '/api/Synthesize/uploadProve', 'POST');

    Route::rule('getPoorSign', '/api/Synthesize/getPoorSign', 'POST');
    Route::rule('getPoorScore', '/api/Synthesize/getPoorScore', 'POST');
    Route::rule('poorScore', '/api/Synthesize/poorScore', 'POST');
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