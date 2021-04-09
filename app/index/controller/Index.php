<?php
/**
 *
 * @description: 永远爱颍
 *
 * @author: Shane
 *
 * @time: 2021/4/9 21:46
 */


namespace app\index\controller;


use app\BaseController;

class Index extends BaseController
{

    public function index(){
        return redirect('/api/View/login');
    }

}