<?php


namespace app\common\validate\api;


use think\Validate;

class Graduation extends Validate
{
    protected $rule =   [
        'examinee_number' => 'require',
        'destination_code'  => 'require|max:25',
        'unit_code' => 'require',
        'unit_name' => 'require',
        'unit_property_code' => 'require',
        'unit_location_code' => 'require',
        'job_category_code' => 'require',
        'unit_contact' => 'require',
        'contact_phone' => 'require',
    ];

    protected $message  =   [
        'examinee_number.require' => '考生号必须',
        'destination_code.require' => '毕业去向代码必须',
        'unit_code.require' => '单位组织机构代码必须',
        'unit_name.require' => '单位名称必须',
        'unit_property_code.require' => '单位性质代码必须',
        'unit_location_code.require' => '单位所在地代码必须',
        'job_category_code.require' => '工作职位类别代码必须',
        'unit_contact.require' => '单位联系人必须',
        'contact_phone.require' => '联系人电话必须',

    ];

    protected $scene = [
        'record_10'  =>  ['examinee_number', 'destination_code', 'unit_code', 'unit_name', 'unit_property_code', 'unit_location_code', 'job_category_code', 'unit_contact', 'contact_phone'],
        'record_11'  =>  ['examinee_number', 'destination_code', 'unit_code', 'unit_name', 'unit_property_code', 'unit_location_code', 'job_category_code', 'unit_contact', 'contact_phone'],
        'record_12'  =>  ['examinee_number', 'destination_code', 'unit_code', 'unit_name', 'unit_property_code', 'unit_location_code', 'job_category_code', 'unit_contact', 'contact_phone'],
        'record_27'  =>  ['examinee_number', 'destination_code', 'unit_code', 'unit_name', 'unit_property_code', 'unit_location_code', 'job_category_code', 'unit_contact', 'contact_phone'],
        'record_50'  =>  ['examinee_number', 'unit_name', 'unit_location_code', 'unit_contact', 'contact_phone'],
        'record_51'  =>  ['examinee_number', 'unit_name', 'unit_location_code', 'unit_contact', 'contact_phone'],
        'record_46'  =>  ['examinee_number'],
        'record_75'  =>  ['examinee_number', 'unit_name', 'unit_property_code', 'unit_location_code',],
        'record_80'  =>  ['examinee_number', 'unit_name'],
        'record_85'  =>  ['examinee_number', 'unit_name'],
    ];

}