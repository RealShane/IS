<?php


namespace app\common\business\api;

use app\common\model\api\DormitoryScore;
use app\common\model\api\DormitoryNumber;
use app\common\model\api\DormitoryScorer;
use app\common\model\api\DormitoryFloor;
use app\common\model\api\User;
use app\common\model\api\Classes;
use app\common\business\lib\Excel;

class Dormitory
{
    private $scoreModel = NULL;
    private $numberModel = NULL;
    private $scorerModel = NULL;
    private $floorModel = NULL;
    private $userModel = NULL;
    private $classModel = NULL;
    private $excelLib = NULL;

    public function __construct(){
        $this -> scoreModel = new DormitoryScore();
        $this -> numberModel = new DormitoryNumber();
        $this -> scorerModel = new DormitoryScorer();
        $this -> floorModel = new DormitoryFloor();
        $this -> userModel = new User();
        $this -> classModel = new Classes();
        $this -> excelLib = new Excel();
    }

    public function dormitoryRecord($data, $user){
        $data['scorer_id'] = $user['id'];
        $data['time_index'] = date('Y-m-d');
        $isExist = $this -> scoreModel -> findToday($data);
        if (empty($isExist)){
            $this -> scoreModel -> save($data);
        }
        $this -> scoreModel -> updateGrade($data);
    }

    public function getDormitoryRecord($data){
        $dorNums = $this -> numberModel -> findByClassId($data['class_id']);
        $class = $this -> classModel -> findById($data['class_id']);
        $res = [];
        foreach ($dorNums as $dorNum){
            $score = $this -> scoreModel -> findToday([
                'number_id' => $dorNum['id'],
                'time_index' => $data['time_index']
            ]);
            if (empty($score)){
                continue;
            }
            $res[] = [
                'class' => $class['name'],
                'time' => $data['time_index'],
                'dormitory' => $dorNum['number'],
                'grade' => $score['grade']
            ];
        }
        return $res;
    }

    public function pushExcel($data){
        $results = $this -> getDormitoryRecord($data);
        $class = $this -> classModel -> findById($data['class_id']);
        $title = $class['name'] . "宿舍评分表";
        $indexes = ['序号', '班级', '时间', '宿舍', '成绩'];
        $id = 1;
        $res = [];
        foreach ($results as $result){
            $res[] = [
                'id' => $id,
                'class' => $result['class'],
                'time' => $result['time'],
                'dormitory' => $result['dormitory'],
                'grade' => $result['grade']
            ];
            $id++;
        }
        $this -> excelLib -> push($title, $indexes, $res);
    }

    public function showAllFloorAndDormitory(){
        $floors = $this -> floorModel -> findAll();
        $data = [];
        foreach ($floors as $floor){
            $info = [];
            $res = $this -> numberModel -> findByFloor($floor['id']);
            foreach ($res as $re){
                $info[] = [
                    'id' => $re['id'],
                    'number' => $re['number']
                ];

            }
            $data[] = [
                'floor' => $floor['name'],
                'dormitory' => $info
            ];
        }
        return $data;
    }

}
