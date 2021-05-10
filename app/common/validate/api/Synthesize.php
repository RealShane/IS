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
        'political_outlook|政治面貌' => ['require'],
        'id_card_number|身份证件号' => ['require'],
        'poor_type_one|选项是否建档立卡贫困家庭' => ['require'],
        'poor_type_two|选项是否低保家庭' => ['require'],
        'poor_type_three|选项是否特困供养学生' => ['require'],
        'poor_type_four|选项是否孤残学生' => ['require'],
        'poor_type_five|选项是否烈士子女' => ['require'],
        'poor_type_six|选项本人是否残疾' => ['require'],
        'poor_type_seven|选项是否家庭经济困难残疾人子女' => ['require'],
        'poor_type_eight|选项是否单亲家庭' => ['require'],
        'confirm_reason|选项认定原因' => ['require'],
        'confirm_reason_explain|认定原因补充说明' => ['require', 'max:200'],
        'address|家庭住址' => ['require'],
        'home_phone|家庭电话' => ['require'],
        'contact_phone|联系方式' => ['require'],
        'remark|备注' => ['require'],
        'supporting_document|证明文件' => ['require'],
        'target|被评分人id' => ['require'],
        'score|被评分人分数' => ['require', 'between:70,100'],
        'uid|用户id' => ['require'],
        'job|班委职务' => ['require'],
        'advantage|述职' => ['require'],
    ];

    protected $scene = [
        'poor_sign' => ['political_outlook', 'id_card_number', 'poor_type_one', 'poor_type_two', 'poor_type_three', 'poor_type_four', 'poor_type_five', 'poor_type_six', 'poor_type_seven', 'poor_type_eight', 'confirm_reason', 'confirm_reason_explain', 'address', 'home_phone', 'contact_phone', 'supporting_document'],
        'cross_score' => ['target', 'score'],
        'get_cross_score' => ['target'],
        'get_poor_score' => ['target'],
        'poor_score' => ['target', 'score'],
        'download_prove' => ['target', 'uid'],
        'leader_Sign' => ['job', 'advantage'],
        'leader_score' => ['target', 'score'],
        'get_leader_score' => ['target'],
    ];

}