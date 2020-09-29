<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/25 9:52
 */


namespace app\common\validate\api;


use think\Validate;

class Synthesize extends Validate
{

    protected $rule = [
        'political_outlook' => 'require',
        'id_card_number' => 'require',
        'poor_type_one' => 'require',
        'poor_type_two' => 'require',
        'poor_type_three' => 'require',
        'poor_type_four' => 'require',
        'poor_type_five' => 'require',
        'poor_type_six' => 'require',
        'poor_type_seven' => 'require',
        'poor_type_eight' => 'require',
        'confirm_reason' => 'require',
        'confirm_reason_explain' => 'require|max:200',
        'address' => 'require',
        'home_phone' => 'require',
        'contact_phone' => 'require',
        'remark' => 'require',
        'supporting_document' => 'require'
    ];

    protected $message = [
        'political_outlook.require' => '政治面貌不为空!',
        'id_card_number.require' => '身份证件号不为空!',
        'poor_type_one.require' => '未选择是否建档立卡贫困家庭!',
        'poor_type_two.require' => '未选择是否低保家庭!',
        'poor_type_three.require' => '未选择是否特困供养学生!',
        'poor_type_four.require' => '未选择是否孤残学生!',
        'poor_type_five.require' => '未选择是否烈士子女!',
        'poor_type_six.require' => '未选择本人是否残疾!',
        'poor_type_seven.require' => '未选择是否家庭经济困难残疾人子女!',
        'poor_type_eight.require' => '未选择是否单亲家庭!',
        'confirm_reason.require' => '未选择认定原因!',
        'confirm_reason_explain.require' => '认定原因补充说明不为空!',
        'confirm_reason_explain.max' => '认定原因补充说明不超过200字符!',
        'address.require' => '家庭住址不为空!',
        'home_phone.require' => '家庭电话不为空!',
        'contact_phone.require' => '联系方式不为空!',
        'remark.require' => '联系方式不为空!',
        'supporting_document.require' => '请上传证明文件!'
    ];

    protected $scene = [
        'poor_sign' => ['political_outlook', 'id_card_number', 'poor_type_one', 'poor_type_two', 'poor_type_three', 'poor_type_four', 'poor_type_five', 'poor_type_six', 'poor_type_seven', 'poor_type_eight', 'confirm_reason', 'confirm_reason_explain', 'address', 'home_phone', 'contact_phone', 'supporting_document'],
    ];

}