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
        try {
            return $this -> comment -> save($data) ? config('status.success') : config('status.failed');
        }catch (\Exception $exception){
            return config('status.failed');
        }
    }
    public function article($id){
        try {
            $article = $this -> article -> findById($id);
            $comments = $this -> comment -> findByArticleId($id);
            $data = [];
            foreach ($comments as $comment){ //楼主
                if (!empty($comment['pid']) || $comment['pid'] != 0){
                    continue;
                }
                $array = [];
                foreach ($comments as $item){ //下挂
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
        }catch (\Exception $exception){
            return NULL;
        }
    }
    public function articleList($id){
        try {
            return $this -> article -> articleList($id);
//            $result = [];
//            foreach ($lists as $list){
//                $result[] = [
//                    'id' => $list['id'],
//                    'name' => $list['name'],
//                    'modular_id' => $list['modular_id'],
//                    'create_time' => $list['create_time'],
//                    'update_time' => $list['update_time']
//                ];
//
//            }
//            return $result;
        }catch (\Exception $exception){
            return NULL;
        }
    }
    public function modular(){
        try {
            return $this -> modular -> findAll();
        }catch (\Exception $exception){
            return NULL;
        }
    }

}