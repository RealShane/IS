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

    public function examPapersManageView(){
        return V::fetch('exam_papers/index');
    }

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