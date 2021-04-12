<?php


namespace app\common\validate\api;


use think\Validate;

class Exam extends Validate
{

    protected $rule = [
        'paper_id|试卷id' => ['require'],
        'answer|答案' => ['require'],
        'title|试卷名称' => ['require']
    ];

    protected $scene = [
        'showPaper' => ['paper_id'],
        'saveJudgeAnswers' => ['answer', 'paper_id', 'type'],
        'getTargetPapers' => ['title']
    ];

}