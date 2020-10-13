<?php


namespace app\common\validate\api;


use think\Validate;

class Forum extends Validate
{
    protected $rule = [
        'article_id' => 'require',
        'comment' => 'require|max:80'
    ];

    protected $message = [
        'article_id.require' => '文章id是必须的!',
        'comment.require' => '评论是必须的!',
        'comment.max' => '评论字符不能超过80个!'

    ];


}