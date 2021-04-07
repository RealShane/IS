<?php


namespace app\common\model\api;


use think\Model;

class ForumComment extends Model
{

    protected $table = 'api_forum_comment';

    public function findByArticleId($id){
        return $this -> where('article_id', $id) -> where('status', 1) -> select();
    }

}