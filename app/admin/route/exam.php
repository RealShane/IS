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
use \app\admin\middleware\Auth;
use \app\admin\middleware\IsLogin;


Route::group(function () {
    Route::rule('View/Exam/Papers/index', '/admin/View/examPapersManageView', 'GET');
    Route::rule('View/Exam/Papers/add', '/admin/View/examPapersAddView', 'GET');
    Route::rule('View/Exam/Papers/edit', '/admin/View/examPapersEditView', 'GET');
});

Route::group('Exam', function () {
    Route::rule('commitPaper', '/admin/Exam/commitPaper', 'POST');
    Route::rule('readPaper', '/admin/Exam/readPaper', 'POST');
    Route::rule('viewAllPapers', '/admin/Exam/viewAllPapers', 'POST');
    Route::rule('selectAllClass', '/admin/Exam/selectAllClass', 'POST');
    Route::rule('getTargetPapers', '/admin/Exam/getTargetPapers', 'POST');
    Route::rule('deletePaper', '/admin/Exam/deletePaper', 'POST');
    Route::rule('getPaper', '/admin/Exam/getPaper', 'POST');
    Route::rule('updatePaper', '/admin/Exam/updatePaper', 'POST');
    Route::rule('getTargetClass', '/admin/Exam/getTargetClass', 'POST');
    Route::rule('showPaperTitle', '/admin/Exam/showPaperTitle', 'POST');
    Route::rule('getTargetTitle', '/admin/Exam/getTargetTitle', 'POST');
    Route::rule('getPaperUsers', '/admin/Exam/getPaperUsers', 'POST');
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
