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

    public function indexView(){
        return V::fetch("index/index");
    }

    public function registerView(){
        return V::fetch("index/register");
    }

    public function loginView(){
        return V::fetch("index/login");
    }

}