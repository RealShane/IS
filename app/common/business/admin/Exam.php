<?php


namespace app\common\business\admin;


use app\common\business\lib\Excel;
use app\common\model\api\ExamPapers;
use app\common\business\admin\CRUD;
use app\common\business\lib\Redis;
use app\common\business\lib\Str;
use think\Exception;
use app\common\model\api\Classes;
use app\common\model\api\ExamAnswers;
use app\common\model\api\User;
class Exam
{

    private $excel = NULL;
    private $examPapersModel = NULL;
    private $classesModel = NULL;
    private $examAnswersModel = NULL;
    private $userModel = NULL;
    private $crud = NULL;
    private $redis = NULL;
    private $str = NULL;

    public function __construct(){
        $this -> excel = new Excel();
        $this -> examPapersModel = new ExamPapers();
        $this -> classesModel = new Classes();
        $this -> examAnswersModel = new ExamAnswers();
        $this -> userModel = new User();
        $this -> crud = new CRUD();
        $this -> redis = new Redis();
        $this -> str = new Str();
    }

    public function updatePaper($data){
        $paper = $this -> redis -> get($data['token']);
        if (empty($paper)){
            return $this -> examPapersModel -> updatePaper($data, [
                'title',
                'class_id',
                'begin_time',
                'close_time',
                'update_time',
                'status'
            ]);
        }
        $data['paper_answer'] = $paper['data'];
        return $this -> examPapersModel -> updatePaper($data, [
            'title',
            'class_id',
            'paper_answer',
            'begin_time',
            'close_time',
            'update_time',
            'status'
        ]);

    }

    public function getPaper($id){
        return $this -> examPapersModel -> findById($id);
    }

    public function deletePaper($id){
        $this -> examPapersModel -> deletePaper($id);
    }

    public function getTargetPapers($title, $num){
        return $this -> examPapersModel -> selectTitle($title, $num);
    }

    public function viewAllPapers($num){
        return $this -> examPapersModel -> findAll($num);
    }

    public function readPaper($file){
        $token = $this -> str -> createToken($file -> getOriginalName());
        $this -> redis -> set($token, [
            'name' => explode(".", $file -> getOriginalName())[0],
            'data' => $this -> excel -> read($file)
        ], config('redis.file_expire'));
        return $token;
    }

    public function commitPaper($data){
        $redis = $this -> redis -> get($data['token']);
        $this -> examPapersModel -> save([
            'class_id' => $data['class_id'],
            'title' => $redis['name'],
            'paper_answer' => $redis['data'],
            'close_time' => [
                'begin_time' => $data['begin_time'],
                'close_time' => $data['close_time']
            ]
        ]);
    }

    public function selectAllClass(){
        return $this -> crud -> setStore('api_class') -> all(['id', 'name']);
    }

    public function getAllClass($num){
        return $this -> classesModel -> getAllClasses($num);
    }

    public function getTargetClass($class, $num){
        return $this -> classesModel -> getClasses($class, $num);
    }

    public function showPaperTitle($classId, $num) {
        return $this -> examPapersModel -> pageList($classId, $num);
    }

    public function getTargetTitle($title, $num){
        return $this -> examPapersModel -> getTitle($title, $num);
    }

    public function getPaperUsers($paperId, $num){
        return $this -> examAnswersModel -> findAll($paperId, $num);
    }

    public function showPaper($paperId, $answerId){
        $paper = $this -> examPapersModel -> findById($paperId);
        $answer = $this -> examAnswersModel -> findById($answerId);
        $temp = [];
        for ($i = 0; $i < count($answer['answer']); $i++){
            $temp[] = [
                'subject' => $paper['paper_answer'][$i]['subject'],
                'option' => $paper['paper_answer'][$i]['option'],
                'answer' => $paper['paper_answer'][$i]['answer'],
                'analysis' => $paper['paper_answer'][$i]['analysis'],
                'subjectType' => $this -> subjectType($paper['paper_answer'][$i]['answer']),
                'myAnswer' => $answer['answer'][$i]
            ];
        }
        return [
            'id' => $paper['id'],
            'paper_answer' => $temp,
            'score' => $answer['score'],
            'close_time' => "答题时间已过！"
        ];
    }

    public function commitScore($answerId, $inputScore){
        $answer = $this -> examAnswersModel -> findById($answerId);
        $paper = $this -> examPapersModel -> findById($answer['paper_id']);
        $this -> judgeScore($paper, $answer, $inputScore);
        return $this -> showPaper($answer['paper_id'], $answerId);
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

    private function judgeScore($paper, $answer,  $inputScore) {
        $score = 0;
        for ($i = 0; $i < count($paper['paper_answer']); $i++) {
            $isInput = $this -> subjectType($paper['paper_answer'][$i]['answer']);
            if ($isInput == "input"){
                $score += $inputScore;
            }
        }
        $answer -> save([
            'score' => $score,
            'status' => 0
        ]);
        return $answer;
    }


}
