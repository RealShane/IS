<?php
/**
 *
 * @description: 永远爱颍
 *
 * @author: Shane
 *
 * @time: 2021/4/9 15:29
 */
use think\facade\Route;
use \app\api\middleware\IsLogin;


Route::group(function () {
    Route::rule('View/Exam/Papers/index', '/admin/View/examPapersManageView', 'GET');
    Route::rule('View/Exam/Papers/add', '/admin/View/examPapersAddView', 'GET');
    Route::rule('View/Exam/Papers/edit', '/admin/View/examPapersEditView', 'GET');
    Route::rule('Exam/showPaper', '/api/Exam/showPaper', 'POST');
});

Route::group('Exam', function () {
//    Route::rule('showPaper', '/api/Exam/showPaper', 'POST');

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
