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
        $uid = $this -> getUser();
        return $this -> success($this -> business -> showPaperTitle($uid));
    }

    public function getAnswer(){
        $data['paper_id'] = $this -> request -> param('paper_id', '', 'htmlspecialchars');
        $data['uid'] = $this -> getUser();
        $data['answer'] = $this -> request -> param('answer', '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('getAnswer') -> check(['paper_id' => $data['paper_id']]);
        } catch (\Exception $exception) {
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> getAnswer($data);
        return $this -> success('保存成功！');
    }

    public function calculateScore(){
        $data['uid'] = $this -> getUser();
        $data['answer'] = $this -> request -> param('answer', '', 'htmlspecialchars');
        return $this -> success($this -> business -> calculateScore($data));
    }

    public function showPaper(){
        $data['uid'] = $this -> getUser();
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