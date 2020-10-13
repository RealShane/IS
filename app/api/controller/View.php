<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/10/13 10:54
 */


namespace app\api\controller;


use app\BaseController;
use think\facade\View as ViewEngine;

class View extends BaseController
{

    public function login(){
        return ViewEngine::fetch('public/login');
    }

    public function register(){
        return ViewEngine::fetch('public/register');
    }

}