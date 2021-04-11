<?php


namespace app\common\business\api;


use app\common\business\admin\CRUD;
use app\common\business\lib\Excel;
use app\common\business\lib\Redis;
use app\common\business\lib\Str;
use app\common\model\api\ExamAnswers;
use app\common\model\api\ExamPapers;
use app\common\model\api\UserClass;
use think\Exception;

class Exam
{

    private $excel = NULL;
    private $examAnswersModel = NULL;
    private $examPapersModel = NULL;
    private $userClassModel = NULL;
    private $crud = NULL;
    private $redis = NULL;
    private $str = NULL;

    public function __construct() {
        $this -> excel = new Excel();
        $this -> examAnswersModel = new ExamAnswers();
        $this -> examPapersModel = new ExamPapers();
        $this -> userClassModel = new UserClass();
        $this -> crud = new CRUD();
        $this -> redis = new Redis();
        $this -> str = new Str();
    }

    public function showPaperTitle($uid, $num) {
        $classId = $this -> userClassModel -> findByUid($uid);
        return $this -> examPapersModel -> pageList($classId['class_id'], $num);
    }

    public function saveJudgeAnswers($data) {
        $data['type'] = strtoupper($data['type']);
        if ($data['type'] == 'SAVE') {
            $info = [
                'uid' => $data['uid'],
                'paper_id' => $data['paper_id'],
                'answer' => $data['answer'],
                'score' => NULL,
                'status' => 1
            ];
            $answer = $this -> examAnswersModel -> findByUidAndPaperId($data);
            if (empty($answer)) {
                $this -> examAnswersModel -> save($info);
            }
            $answer -> save($info);
        }
        if ($data['type'] == 'JUDGE') {
            $this -> judgeScore($data);
        }
    }

    private function judgeScore($data, $type = true) {
        $answer = $this -> examAnswersModel -> findByUidAndPaperId($data);
        $paper = $this -> examPapersModel -> findById($data['paper_id']);
        $score = 0;
        if ($type){
            for ($i = 0; $i < count($paper['paper_answer']['answer']); $i++) {
                if ($paper['paper_answer']['answer'][$i] == $data['answer'][$i]) {
                    $score++;
                }
            }
            if (empty($answer)){
                return $this -> examAnswersModel -> save([
                    'uid' => $data['uid'],
                    'paper_id' => $data['paper_id'],
                    'answer' => $data['answer'],
                    'score' => $score,
                    'status' => 0
                ]);
            }
            return $answer -> save([
                'answer' => $data['answer'],
                'score' => $score,
                'status' => 0
            ]);
        }
        for ($i = 0; $i < count($paper['paper_answer']['answer']); $i++) {
            if ($paper['paper_answer']['answer'][$i] == $answer['answer'][$i]) {
                $score++;
            }
        }
        $answer -> save([
            'score' => $score,
            'status' => 0
        ]);
        return $answer;
    }

    public function showPaper($data) {
        $paper = $this -> examPapersModel -> findById($data['paper_id']);
        $answer = $this -> examAnswersModel -> findByUidAndPaperId($data);
        $time = time();
        if ($time < $paper['close_time']['begin_time']) {
            throw new Exception("未到答题时间");
        }
        if (($time >= $paper['close_time']['begin_time'] && $time <= $paper['close_time']['close_time']) || empty($paper['close_time']['close_time'])) {
            return $this -> myData($paper, $answer);
        }
        if ($time >= $paper['close_time']['close_time']){
            return $this -> myAnswer($paper, $answer, $data);
        }
    }

    private function myAnswer($paper, $answer, $data){
        $temp = [];
        if (empty($answer)){
            foreach ($paper['paper_answer'] as $value){
                $temp[] = [
                    'subject' => $value['subject'],
                    'option' => $value['option'],
                    'answer' => $value['answer'],
                    'analysis' => $value['analysis'],
                    'subjectType' => $this -> subjectType($value['answer'])
                ];
            }
            return [
                'id' => $paper['id'],
                'paper_answer' => $temp,
                'score' => "未答题",
                'type' => true
            ];
        }
        if ((int)$answer['status']){
            $answer = $this -> judgeScore($data, false);
        }
        $type = true;
        for ($i = 0; $i < count($answer['answer']); $i++){
            $temp[] = [
                'subject' => $paper['paper_answer'][$i]['subject'],
                'option' => $paper['paper_answer'][$i]['option'],
                'answer' => $paper['paper_answer'][$i]['answer'],
                'analysis' => $paper['paper_answer'][$i]['analysis'],
                'subjectType' => $this -> subjectType($paper['paper_answer'][$i]['answer']),
                'my_answer' => $answer['answer'][$i]
            ];
            $type = false;
        }
        return [
            'id' => $paper['id'],
            'paper_answer' => $temp,
            'score' => $answer['score'],
            'type' => $type
        ];
    }

    private function myData($paper, $answer){
        $temp = [];
        if (empty($answer)){
            foreach ($paper['paper_answer'] as $value){
                $temp[] = [
                    'subject' => $value['subject'],
                    'option' => $value['option'],
                    'subjectType' => $this -> subjectType($value['answer'])
                ];
            }
            return [
                'id' => $paper['id'],
                'paper_answer' => $temp,
                'type' => true
            ];
        }
        $type = true;
        for ($i = 0; $i < count($answer['answer']); $i++){
            if ((int)$answer['status']){
                $temp[] = [
                    'subject' => $paper['paper_answer'][$i]['subject'],
                    'option' => $paper['paper_answer'][$i]['option'],
                    'subjectType' => $this -> subjectType($paper['paper_answer'][$i]['answer']),
                    'my_answer' => $answer['answer'][$i]
                ];
                continue;
            }
            $temp[] = [
                'subject' => $paper['paper_answer'][$i]['subject'],
                'option' => $paper['paper_answer'][$i]['option'],
                'answer' => $paper['paper_answer'][$i]['answer'],
                'analysis' => $paper['paper_answer'][$i]['analysis'],
                'subjectType' => $this -> subjectType($paper['paper_answer'][$i]['answer']),
                'my_answer' => $answer['answer'][$i]
            ];
            $type = false;
        }
        return [
            'id' => $paper['id'],
            'paper_answer' => $temp,
            'score' => $answer['score'],
            'type' => $type
        ];
    }

    public function subjectType($answer) {
        if (strlen($answer) == 1) {
            return "single";
        } else if (empty($answer)) {
            return "input";
        } else {
            return "multiple";
        }
    }


    public function rebackQuitAnswer($paper, $papers, $user) {
        return [
            'id' => $paper['id'],
            'paper_answer' => $papers,
            'score' => $user['score'],
            'type' => false
        ];
    }

    public function rebackAnswer($papers, $paper) {
        $res = [];
        if (!empty($user['answer'])) {
            foreach ($papers as $key) {
                $res['paper_answer'][] = [
                    'subject' => $key['subject'],
                    'option' => $key['option'],
                    'myAnswer' => $key['myAnswer'],
                    'subjectType' => $key['subjectType']
                ];
            }
        } else {
            foreach ($papers as $key) {
                $res['paper_answer'][] = [
                    'subject' => $key['subject'],
                    'option' => $key['option'],
                    'subjectType' => $key['subjectType']
                ];
            }
            $res['type'] = true;
            $res['id'] = $paper['id'];
            return $res;
        }


    }
}