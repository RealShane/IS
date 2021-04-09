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

    public function findAll($num){
        $classes = Classes::find(1);
        return $this -> where('id', '>', 0)
            -> field(['id', $classes['name'], 'title', 'close_time', 'create_time', 'update_time', 'status'])
            -> paginate($num);
    }

    public function classes(){
        return $this -> belongsTo(Classes::class, 'class_id' ,'id');
    }


}