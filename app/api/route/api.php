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
use app\api\middleware\DormitoryAuth;

/**
 * 前端页面路由
 */
Route::group('View', function () {
    Route::rule('welcome', 'api/View/welcomeView', 'GET');
    Route::rule('index', 'api/View/indexView', 'GET');
    Route::rule('register', 'api/View/registerView', 'GET');
    Route::rule('activeRegister', 'api/View/activeRegisterView', 'GET');
    Route::rule('login', 'api/View/loginView', 'GET');
});
/**
 * 无Token
 */
Route::group(function () {
    //论坛
    Route::rule('forumModular', '/api/Forum/modular', 'POST');
    Route::rule('articleList', '/api/Forum/articleList', 'POST');
    Route::rule('article', '/api/Forum/article', 'POST');

    Route::rule('pushSourceExcel', 'api/Source/pushExcel', 'GET');
});
/**
 * 有Token
 */
Route::group(function () {
    //综测接口
    Route::rule('showPoorSignDetail', '/api/Synthesize/showPoorSignDetail', 'POST');
    Route::rule('showPoorSignList', '/api/Synthesize/showPoorSignList', 'POST');
    Route::rule('poorSign', '/api/Synthesize/poorSign', 'POST');
    Route::rule('viewPoorOption', '/api/Synthesize/viewPoorOption', 'POST');
    Route::rule('uploadProve', '/api/Synthesize/uploadProve', 'POST');
    //论坛
    Route::rule('writeComment', '/api/Forum/writeComment', 'POST');
    //毕业生去向
    Route::rule('graduationRecord', 'api/Graduation/graduationRecord', 'POST');
    Route::rule('getGraduationRecord', 'api/Graduation/getGraduationRecord', 'POST');
    Route::rule('getGraduationDestinationCode', 'api/Graduation/getGraduationDestinationCode', 'POST');
    Route::rule('downExcel', 'api/Graduation/downExcel', 'GET');
    //生源地
    Route::rule('sourceRecord', 'api/Source/sourceRecord', 'POST');
    Route::rule('getSourceRecord', 'api/Source/getSourceRecord', 'POST');
}) -> middleware(IsLogin::class);

/**
 * 查宿舍
 */
Route::group(function () {
    Route::rule('dormitoryRecord', 'api/Dormitory/dormitoryRecord', 'POST');
    Route::rule('dormitoryUpload', 'api/Dormitory/dormitoryUpload', 'POST');
    Route::rule('getDormitoryRecord', 'api/Dormitory/getDormitoryRecord', 'POST');
    Route::rule('pushExcel', 'api/Dormitory/pushExcel', 'GET');
    Route::rule('showAllFloorAndDormitory', 'api/Dormitory/showAllFloorAndDormitory', 'POST');
}) -> middleware(IsLogin::class) -> middleware(DormitoryAuth::class);

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