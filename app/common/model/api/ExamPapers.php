<?php


namespace app\common\model\api;


use think\Model;

class ExamPapers extends Model
{
    protected $table = 'api_exam_papers';

    protected $type = [
        'paper_answer'    =>  'json',
        'close_time'     =>  'json',
        'class_id'     =>  'json'
    ];

    public function updatePaper($data, $field){
        $paper = $this -> findById($data['id']);
        $paper -> allowField($field) -> save($data);
    }

    public function findById($id){
        return $this -> where('id', $id) -> find();
    }

    public function pageList($class_id, $num){
        return $this -> where('class_id', 'LIKE', '%' . $class_id . '%') -> order('id', 'DESC') -> field(['id', 'title']) -> paginate($num);
    }

    public function deletePaper($id){
        return $this -> where('id', $id) -> delete();
    }

    public function getTitle($title, $num){
        return $this -> where('title', 'LIKE', '%' . $title . '%') -> field(['id', 'title']) -> paginate($num);
    }

    public function selectTitle($title, $num){
        return $this -> where('title', 'LIKE', '%' . $title . '%') -> paginate($num);
    }

    public function searchTitleList($classId, $title, $num){
        return $this -> where('class_id', 'LIKE', '%' . $classId . '%') -> where('title', 'LIKE', '%' . $title . '%') -> field(['id', 'title']) -> paginate($num);
    }

    public function findAll($num){
        return $this -> field(['id', 'class_id', 'title', 'close_time', 'create_time', 'update_time', 'status']) -> paginate($num);
    }

    public function classes(){
        return $this -> belongsTo(Classes::class, 'class_id' ,'id');
    }


}