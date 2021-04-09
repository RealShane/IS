<?php


namespace app\common\validate\api;


use think\Validate;

class Forum extends Validate
{

    protected $rule = [
        'article_id|文章id' => ['require'],
        'comment|评论' => ['require', 'max:80']
    ];

}