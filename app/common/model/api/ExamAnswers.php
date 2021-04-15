<?php


namespace app\common\model\api;


use think\Model;

class ExamAnswers extends Model
{

    protected $table = 'api_exam_answers';

    protected $type = [
        'answer'    =>  'json',
    ];

    public function findByUidAndPaperId($data){
        return $this -> where('uid', $data['uid']) -> where('paper_id', $data['paper_id']) -> find();
    }

    public function findAll($paperId, $num){
        return self::with('classes')
            -> where('paper_id', $paperId)
            -> field(['id', 'uid', 'paper_id'])
            -> paginate($num);
    }

    public function classes(){
        return $this -> belongsTo(User::class, 'uid' ,'id');
    }


}