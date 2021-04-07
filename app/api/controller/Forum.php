<?php


namespace app\api\controller;


use app\BaseController;
use app\common\business\api\Forum as Business;
use app\common\validate\api\Forum as Validate;
use think\App;

class Forum extends BaseController
{

    protected $business = NULL;

    public function __construct(App $app, Business $business){
        parent::__construct($app);
        $this -> business = $business;
    }

    public function writeComment(){
        $data['article_id'] = $this -> request -> param('article_id', '', 'htmlspecialchars');
        $data['comment'] = $this -> request -> param('comment', '', 'htmlspecialchars');
        $data['pid'] = $this -> request -> param('pid', '', 'htmlspecialchars');
        $data['uid'] = $this -> getUid();
        try {
            validate(Validate::class) -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> writeComment($data);
        return $this -> success("评论成功");
    }

    public function modular(){
        return $this -> success($this -> business -> modular());
    }

    public function articleList(){
        $id = $this -> request -> param('id', '', 'htmlspecialchars');
        return $this -> success($this -> business -> articleList($id));
    }

    public function article(){
        $id = $this -> request -> param('id', '', 'htmlspecialchars');
        return $this -> success($this -> business -> article($id));
    }

}