<?php


namespace app\common\business\api;


use app\common\model\api\ForumArticle;
use app\common\model\api\ForumComment;
use app\common\model\api\ForumModular;

class Forum
{

    public $modular = NULL;
    public $article = NULL;
    public $comment = NULL;

    public function __construct(){
        $this -> modular = new ForumModular();
        $this -> article = new ForumArticle();
        $this -> comment = new ForumComment();
    }

    public function writeComment($data){
        $this -> comment -> save($data);
    }

    public function article($id){
        $article = $this -> article -> findById($id);
        $comments = $this -> comment -> findByArticleId($id);
        $data = [];
        foreach ($comments as $comment){
            if (!empty($comment['pid']) || $comment['pid'] != 0){
                continue;
            }
            $array = [];
            foreach ($comments as $item){
                if ($comment['id'] == $item['pid'] && $comment['id'] != $item['id']){
                    $array[] = $item;
                }
            }
            $data[] = [
                'master' => $comment,
                'slave' => $array
            ];
        }
        return [
            'article' => $article,
            'comments' => $data
        ];
    }
    public function articleList($id){
        return $this -> article -> articleList($id);
    }

    public function modular(){
        return $this -> modular -> findAll();
    }

}