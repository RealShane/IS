<?php
/**
 *
 * @description: 永远爱颍
 *
 * @author: Shane
 *
 * @time: 2021/2/14 14:32
 */


namespace app\api\controller;
use think\facade\View as V;

class View
{

    //Exam类

    public function examPapersManageView(){
        return V::fetch('exam_papers/index');
    }

    //Exam类

    //Synthesize类

    public function crossView(){
        return V::fetch('synthesize/cross/index');
    }

    public function crossAddView(){
        return V::fetch('synthesize/cross/add');
    }

    public function poorView(){
        return V::fetch('synthesize/poor/index');
    }

    public function poorSignView(){
        return V::fetch('synthesize/poor/sign');
    }

    public function poorAddView(){
        return V::fetch('synthesize/poor/add');
    }

    public function poorDownloadView(){
        return V::fetch('synthesize/poor/download');
    }

    public function leaderView(){
        return V::fetch('synthesize/leader/index');
    }

    public function leaderSignView(){
        return V::fetch('synthesize/leader/sign');
    }

    public function leaderAddView(){
        return V::fetch('synthesize/leader/add');
    }

    //Synthesize类

    //User类

    public function changeSexView(){
        return V::fetch('index/sex');
    }

    public function changePasswordView(){
        return V::fetch('index/password');
    }

    //User类

    public function welcomeView(){
        return V::fetch('index/welcome');
    }

    public function indexView(){
        return V::fetch("index/index");
    }

    public function registerView(){
        return V::fetch("index/register");
    }

    public function activeRegisterView(){
        return V::fetch('index/active-register');
    }

    public function loginView(){
        return V::fetch("index/login");
    }

}