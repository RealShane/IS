<?php


namespace app\common\validate\api;


use think\Validate;

class Graduation extends Validate
{

    protected $rule =   [
        'examinee_number|考生号' => ['require'],
        'destination_code|毕业去向代码'  => ['require', 'max:25'],
        'unit_code|单位组织机构代码' => ['require'],
        'unit_name|单位名称' => ['require'],
        'unit_property_code|单位性质代码' => ['require'],
        'unit_location_code|单位所在地代码' => ['require'],
        'job_category_code|工作职位类别代码' => ['require'],
        'unit_contact|单位联系人' => ['require'],
        'contact_phone|联系人电话' => ['require'],
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