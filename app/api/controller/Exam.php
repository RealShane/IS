<?php


namespace app\api\controller;
error_reporting( E_ALL&~E_NOTICE );

use app\BaseController;
use app\common\business\api\Exam as Business;
use app\common\validate\api\Exam as Validate;
use think\App;

class Exam extends BaseController
{

    protected $business = NULL;

    public function __construct(App $app, Business $business){
        parent::__construct($app);
        $this -> business = $business;
    }

    public function showPaperTitle(){
        $uid = $this -> getUid();
        $num = $this -> request -> param("num", 10, 'htmlspecialchars');
        return $this -> success($this -> business -> showPaperTitle($uid, $num));
    }

    public function saveJudgeAnswers(){
        $data['answer'] = $this -> request -> param("answer", '', 'htmlspecialchars');
        $data['type'] = $this -> request -> param("type", '', 'htmlspecialchars');
        $data['uid'] = $this -> getUid();
        $data['paper_id'] = $this -> request -> param('paper_id', '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('saveJudgeAnswers') -> check($data);
        } catch (\Exception $exception) {
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> saveJudgeAnswers($data));
    }

    public function showPaper(){
        $data['uid'] = $this -> getUid();
        $data['paper_id'] = $this -> request -> param('paper_id', '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('showPaper') -> check(['paper_id' => $data['paper_id']]);
        } catch (\Exception $exception) {
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> showPaper($data));
    }

    public function returnGradeExcel(){

    }



}