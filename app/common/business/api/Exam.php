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

    public function judgeScore($data) {
        $answer = $this -> examAnswersModel -> findByUidAndPaperId($data);
        $paper = $this -> examPapersModel -> findById($data['paper_id']);
        $answer['score'] = 0;
        foreach ($paper['paper_answer'] as $key) {
            $res[] = $key['answer'];
            for ($i = 0; $i < count($res); $i++) {
                if ($res[$i] == $data['answer'][$i]) {
                    $answer['score']++;
                }
            }
        }
        $this -> examAnswersModel -> save([
            'score' => $answer['score'],
            'status' => 0
        ]);
    }

    public function showPaper($data) {
        $paper = $this -> examPapersModel -> findById($data['paper_id']);
        $answer = $this -> examAnswersModel -> findByUidAndPaperId($data);
        $time = time();
        if ($time < $paper['close_time']['begin_time']) {
            throw new Exception("未到答题时间");
        }
        if (($time >= $paper['close_time']['begin_time'] && $time <= $paper['close_time']['close_time']) || empty($paper['close_time']['close_time'])) {
//            return $this -> myAnswer($paper, $answer);
        }
        if ($time >= $paper['close_time']['close_time']){
            echo json_encode("答题时间不为空我显示");
            exit();
        }
        echo json_encode("答题时间为空我显示");
        exit();
    }

    private function myAnswer($paper, $answer){
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
        for ($i = 0; $i < count($answer['answer']); $i++){
            $temp[] = [
                'subject' => $paper['paper_answer'][$i]['subject'],
                'option' => $paper['paper_answer'][$i]['option'],
                'subjectType' => $this -> subjectType($paper['paper_answer'][$i]['answer']),
                'my_answer' => $answer['answer'][$i]
            ];
        }
        return [
            'id' => $paper['id'],
            'paper_answer' => $temp,
            'type' => true
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