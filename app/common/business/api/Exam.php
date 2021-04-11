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
        return $this -> examPapersModel -> pageList($classId['class_id'], $num);
    }

    public function saveJudegeAnswers($data){
        $data['type'] = strtoupper( $data['type']);
        if ($data['type'] == 'SAVE'){
            $info = [
                'uid' => $data['uid'],
                'paper_id' => $data['paper_id'],
                'answer' => $data['answer'],
                'score' => NULL,
                'status' => 1
            ];
            $user = $this -> examAnswersModel -> findByUidAndPaperId($data);
            if (empty($user)){
                $this -> examAnswersModel -> save($info);
            }
            $user -> save($info);
        }
        if ($data['type'] == 'JUDGE'){
            $paper = $this -> examPapersModel -> findById($data['paper_id']);
            foreach ($paper['paper_answer'] as $key) {
                $data[] = $key['answer'];
            }
            $this -> examAnswersModel -> save([
                'score' => NULL,
                'status' => 0
            ]);
        }
    }

    public function judgeScore($data){

    }

    public function showPaper($data)
    {
        $paper = $this -> examPapersModel -> findById($data['paper_id']);
        $user = $this -> examAnswersModel -> findByUidAndPaperId($data);
        $papers = [];
        foreach ($paper['paper_answer'] as $key) {
            if (strlen($key['answer']) == 1){
                $key['subjectType'] = "single";
            } else if (empty($key['answer'])){
                $key['subjectType'] = "input";
            } else{
                $key['subjectType'] = "multiple";
            }
            $papers[] = $key;
        }
        echo json_encode($papers);
        exit();
        $time = time();
        if ($time < $paper['close_time']['begin_time']) {
            throw new Exception("未到答题时间");
        }
        if ($time > $paper['close_time']['close_time']) {
            return [
                'paper_answer' => $paper['paper_answer'],
                'answer' => $user['answer'],
                'score' => $user['score'],
                'type' => false
            ];
        }
        if (($time >= $paper['close_time']['begin_time'] && empty($paper['close_time']['close_time'])) || (empty($paper['close_time']['begin_time']) && empty($paper['close_time']['close_time']))){


        }
        if ((empty($paper['close_time']['begin_time']) && $time <= $paper['close_time']['close_time']) || ($time >= $paper['close_time']['begin_time'] && $time <= $paper['close_time']['close_time'])) {
            if (!empty($user['answer'])) {
                foreach ($paper['paper_answer'] as $key) {
                    $data[] = [$key['subject'], $key['option'], $user['answer']];
                }
            }
            foreach ($paper['paper_answer'] as $key) {
                $data[] = [$key['subject'], $key['option']];
            }
            $data['type'] = true;
            return $data;
        }
    }




}