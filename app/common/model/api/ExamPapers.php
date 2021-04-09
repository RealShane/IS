<?php


namespace app\common\model\api;


use think\Model;

class ExamPapers extends Model
{
    protected $table = 'api_exam_papers';

    protected $type = [
        'paper_answer'    =>  'json',
        'close_time'     =>  'json',
    ];

    public function selectTitle($title, $num){
        return $this -> where('title', 'LIKE', '%' . $title . '%') -> paginate($num);
    }

    public function findAll($num){
        return self::with('classes')
            -> field(['id', 'class_id', 'title', 'close_time', 'create_time', 'update_time', 'status'])
            -> paginate($num);
    }

    public function classes(){
        return $this -> belongsTo(Classes::class, 'class_id' ,'id');
    }


}