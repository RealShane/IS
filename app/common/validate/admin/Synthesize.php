<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/30 14:37
 */


namespace app\common\validate\admin;


use think\Validate;

class Synthesize extends Validate
{

    protected $rule = [
        'classId|班级id' => ['require'],
        'key|查找关键字' => ['require'],
        'token|token' => ['require'],
        'target|目标班级' => ['require'],
        'POOR_SIGN_OPTION|贫困生认定原因选项' => ['require'],
        'POOR_SIGN_STATUS|贫困生报名开关' => ['require'],
        'CROSS_STATUS|综测评分开关' => ['require'],
        'POOR_SIGN_MARK_STATUS|贫困生打分/投票切换' => ['require'],
        'POOR_SCORE_STATUS|贫困生打分/投票开关' => ['require'],
        'POOR_MARK_COUNT_STATUS|贫困生投票次数限制' => ['require'],
        'LEADER_SIGN_STATUS|班委报名开关' => ['require'],
        'LEADER_SCORE_STATUS|班委打分开关' => ['require'],
    ];

    protected $scene = [
        'exportCrossExcel' => ['classId', 'token'],
        'exportPoorSignScoreExcel' => ['classId', 'token'],
        'exportLeaderExcel' => ['classId', 'token'],
        'getTargetClass' => ['key'],
        'exportPoorSignExcel' => ['target', 'token'],
        'setConfig' => ['POOR_SIGN_OPTION', 'POOR_SIGN_STATUS', 'CROSS_STATUS', 'POOR_SIGN_MARK_STATUS', 'POOR_SCORE_STATUS', 'POOR_MARK_COUNT_STATUS', 'LEADER_SIGN_STATUS', 'LEADER_SCORE_STATUS'],
    ];

}