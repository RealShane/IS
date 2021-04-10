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

    public function __construct(){
        $this -> excel = new Excel();
        $this -> examAnswersModel = new ExamAnswers();
        $this -> examPapersModel = new ExamPapers();
        $this -> userClassModel = new UserClass();
        $this -> crud = new CRUD();
        $this -> redis = new Redis();
        $this -> str = new Str();
    }

    public function showPaperTitle($uid, $num){
        $classId = $this -> userClassModel -> findByUid($uid);
        $papers = $this -> examPapersModel -> findByClassId($classId['class_id'], $num);
        foreach ($papers as $paper){
            $data[] = [
                'title' => $paper['title']
            ];
        }
        return $data;
    }

    public function showPaper($data){
        $paper = $this -> examPapersModel -> findById($data['paper_id']);
        $time = time();
        if ($time < $paper['close_time']['begin_time']){
            throw new Exception("未到答题时间");
        }
        if ($time > $paper['close_time']['close_time']){
            $user = $this -> examAnswersModel -> findByUidAndPaperId($data);
            return [
                'paper_answer' => $paper['paper_answer'],
                'answer' => $user['answer'],
                'score' => $user['score']
            ];
        }
        foreach ($paper['paper_answer'] as $key){
            $data[] = [$key['subject'], $key['option']];
        }
        return $data;
    }

    public function getAnswer($data){
        $user = $this -> examAnswersModel -> findByUidAndPaperId($data);
        $info = [
            'uid' => $data['uid'],
            'paper_id' => $data['paper_id'],
            'answer' => $data['answer'],
            'score' => NULL
        ];
        if (empty($user)){
            $this -> examAnswersModel -> save($info);
        }
        $user -> save($info);
    }

    public function calculateScore($data){
        $uid = $this -> userClassModel -> findByUid($data['uid']);
    }



}