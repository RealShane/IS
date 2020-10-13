<?php


namespace app\api\controller;


use app\BaseController;
use app\common\business\api\Forum as ForumBusiness;
use app\common\validate\api\Forum as ForumValidate;
class Forum extends BaseController
{
    public function writeComment(){
        $data['article_id'] = $this -> request -> param('article_id');
        $data['comment'] = $this -> request -> param('comment');
        $data['pid'] = $this -> request -> param('pid');
        $user = $this -> getUser();
        $data['uid'] = $user['id'];
        try {
            validate(ForumValidate::class) -> check($data);
        }catch (\Exception $exception){
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                $exception -> getMessage()
            );
        }
        $errCode = (new ForumBusiness()) -> writeComment($data);
        if ($errCode == config('status.failed')){
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                '内部异常'
            );
        }
        return $this -> show(
            config('status.success'),
            config('message.success'),
            '评论成功'
        );
    }
    public function modular(){
        $errCode = (new ForumBusiness()) -> modular();
        if (empty($errCode)){
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                '内部异常'
            );
        }
        return $this -> show(
            config('status.success'),
            config('message.success'),
            $errCode
        );
    }

    public function articleList(){
        $id = $this -> request ->param('id');
        $errCode = (new ForumBusiness()) -> articleList($id);
        if (empty($errCode)){
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                '内部异常'
            );
        }
        return $this -> show(
            config('status.success'),
            config('message.success'),
            $errCode
        );
    }
    public function article(){
        $id = $this -> request ->param('id');
        $errCode = (new ForumBusiness()) -> article($id);
        if (empty($errCode)){
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                '内部异常'
            );
        }
        return $this -> show(
            config('status.success'),
            config('message.success'),
            $errCode
        );
    }
}