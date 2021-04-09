<?php


namespace app\common\business\api;


use app\common\business\admin\CRUD;
use app\common\business\lib\Excel;
use app\common\business\lib\Redis;
use app\common\business\lib\Str;
use app\common\model\api\ExamAnswers;
use app\common\model\api\ExamPapers;
use think\Exception;

class Exam
{

    private $excel = NULL;
    private $examAnswersModel = NULL;
    private $examPapersModel = NULL;
    private $crud = NULL;
    private $redis = NULL;
    private $str = NULL;

    public function __construct(){
        $this -> excel = new Excel();
        $this -> examAnswersModel = new ExamAnswers();
        $this -> examPapersModel = new ExamPapers();
        $this -> crud = new CRUD();
        $this -> redis = new Redis();
        $this -> str = new Str();
    }

    public function showPaper($paper_id){
        $paper = $this -> examPapersModel -> findById($paper_id);
        if (time() < $paper['close_time']['begin_time'] || time() > $paper['close_time']['close_time']){
            throw new Exception("未到答题时间或答题时间已过");
        }
        foreach ($paper['paper_answer'] as $key){
            $data[] = [$key['subject'], $key['option']];
        }
        return $data;
    }



}