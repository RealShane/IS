<?php


namespace app\common\validate\api;


use think\Validate;

class Source extends Validate
{
    protected $rule =   [
        'id_number' => 'require',
        'graduate_school'  => 'require',
        'source' => 'require',
        'poor_code' => 'require',
        'mobile_phone' => 'require',
        'qq' => 'require',
        'home_address' => 'require',
        'home_phone' => 'require',
    ];

    protected $message  =   [
        'id_number.require' => '身份证号必须',
        'graduate_school.require' => '毕业中学必须',
        'source.require' => '生源所在地必须',
        'poor_code.require' => '困难生类别代码必须',
        'mobile_phone.require' => '移动电话必须',
        'qq.require' => 'qq必须',
        'home_address.require' => '家庭地址必须',
        'home_phone.require' => '家庭电话必须'
    ];

    protected $scene = [
        'insertData'  =>  ['id_number', 'graduate_school', 'source', 'poor_code', 'mobile_phone', 'qq', 'home_address', 'home_phone'],
    ];


}