<?php


namespace app\common\validate\api;


use think\Validate;

class Source extends Validate
{

    protected $rule =   [
        'id_number|身份证号' => ['require'],
        'graduate_school|毕业中学'  => ['require'],
        'source|生源所在地' => ['require'],
        'poor_code|困难生类别代码' => ['require'],
        'mobile_phone|移动电话' => ['require'],
        'qq' => ['require'],
        'home_address|家庭地址' => ['require'],
        'home_phone|家庭电话' => ['require'],
    ];

    protected $scene = [
        'insertData'  =>  ['id_number', 'graduate_school', 'source', 'poor_code', 'mobile_phone', 'qq', 'home_address', 'home_phone'],
    ];

}