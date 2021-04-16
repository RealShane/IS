<?php


namespace app\admin\controller;


use app\BaseController;
use app\common\business\admin\Exam as Business;
use app\common\validate\admin\Exam as Validate;
use think\App;

class Exam extends BaseController
{

    protected $business = NULL;

    public function __construct(App $app, Business $business){
        parent::__construct($app);
        $this -> business = $business;
    }

    public function rebackClassId(){

    }

    public function updatePaper(){
        $data['id'] = $this -> request -> param('id', '', 'htmlspecialchars');
        $data['title'] = $this -> request -> param('title', '', 'htmlspecialchars');
        $data['class_id'] = $this -> request -> param('class_id', '', 'htmlspecialchars');
        $data['token'] = $this -> request -> param('token', '', 'htmlspecialchars');
        $data['close_time']['begin_time'] = $this -> request -> param('begin_time', NULL, 'htmlspecialchars');
        $data['close_time']['close_time'] = $this -> request -> param('close_time', NULL, 'htmlspecialchars');
        $data['status'] = $this -> request -> param('status', '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('updatePaper') -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> updatePaper($data);
        return $this -> success("更改试卷成功！");

    }

    public function getPaper(){
        $id = $this -> request -> param('id', '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('getPaper') -> check(['id' => $id]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> getPaper($id));
    }

    public function deletePaper(){
        $id = $this -> request -> param('id', '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('deletePaper') -> check(['id' => $id]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> deletePaper($id);
        return $this -> success("删除成功！");
    }

    public function getTargetPapers(){
        $title = $this -> request -> param('title', '', 'htmlspecialchars');
        $num = $this -> request -> param("num", 10, 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('getTargetPapers') -> check(['title' => $title]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> getTargetPapers($title, $num));
    }

    public function viewAllPapers(){
        $errCode = $this -> business -> viewAllPapers($this -> request -> param("num", 10, 'htmlspecialchars'));
        return $this -> success($errCode);
    }

    public function readPaper(){
        $file = $this -> request -> file('file');
        try {
            validate(Validate::class) -> scene('readPaper') -> check(['file' => $file]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> readPaper($file));
    }

    public function commitPaper(){
        $data['class_id'] = $this -> request -> param('class_id', '', 'htmlspecialchars');
        $data['token'] = $this -> request -> param('token', '', 'htmlspecialchars');
        $data['begin_time'] = $this -> request -> param('begin_time', NULL, 'htmlspecialchars');
        $data['close_time'] = $this -> request -> param('close_time', NULL, 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('commitPaper') -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> commitPaper($data);
        return $this -> success("添加试卷成功！");
    }

    public function selectAllClass(){
        return $this -> success($this -> business -> selectAllClass());
    }

    public function getAllClass(){
        $num = $this -> request -> param("num", 10, 'htmlspecialchars');
        return $this -> success($this -> business -> getAllClass($num));
    }

    public function getTargetClass(){
        $class = $this -> request -> param('key', '', 'htmlspecialchars');
        $num = $this -> request -> param("num", 10, 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('getTargetClass') -> check(['class' => $class]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> getTargetClass($class, $num));
    }

    public function showPaperTitle(){
        $classId = $this -> request -> param('class_id', '', 'htmlspecialchars');
        $num = $this -> request -> param("num", 10, 'htmlspecialchars');
        return $this -> success($this -> business -> showPaperTitle($classId, $num));
    }

    public function getTargetTitle(){
        $title = $this -> request -> param('key', '', 'htmlspecialchars');
        $num = $this -> request -> param("num", 10, 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('getTargetPapers') -> check(['title' => $title]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> getTargetTitle($title, $num));
    }

    public function getPaperUsers(){
        $paperId = $this -> request -> param('paper_id', '', 'htmlspecialchars');
        $num = $this -> request -> param("num", 10, 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('getPaperUsers') -> check(['paperId' => $paperId]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> getPaperUsers($paperId, $num));
    }

    public function showPaper(){
        $paperId = $this -> request -> param('paper_id', '', 'htmlspecialchars');
        $answerId = $this -> request -> param('answer_id', '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('showPaper') -> check(['paperId' => $paperId, 'answerId' => $answerId]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> showPaper($paperId, $answerId));
    }

    public function commitScore(){
        $paperId = $this -> request -> param('paperId', '', 'htmlspecialchars');
        $answerId = $this -> request -> param('answerId', '', 'htmlspecialchars');
        $inputScore = $this -> request -> param('inputScore', '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('commitScore') -> check(['paperId' => $paperId, 'answerId' => $answerId, 'inputScore' => $inputScore]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> commitScore($paperId, $answerId, $inputScore));
    }


}