<?php


namespace app\api\controller;


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

    public function showPaper(){
        $paper_id = $this -> request -> param('paper_id', '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('showPaper') -> check(['paper_id' => $paper_id]);
        } catch (\Exception $exception) {
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> showPaper($paper_id));
    }



}