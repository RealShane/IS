<?php


namespace app\common\model\api;


use think\Model;

class ForumArticle extends Model
{
    protected $name = 'api_forum_article';
    public function articleList($id){
        return $this -> where('modular_id',$id) -> where('status',1) -> field('id,name,modular_id,create_time,update_time') -> paginate(1);
    }
    public function findById($id){
        return $this -> where('id',$id) -> where('status',1) -> find();
    }

}