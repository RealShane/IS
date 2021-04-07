<?php


namespace app\api\controller;

use app\BaseController;
use app\common\business\api\Source as Business;
use app\common\validate\api\Source as Validate;
use think\App;

class Source extends BaseController
{

    protected $business = NULL;

    public function __construct(App $app, Business $business){
        parent::__construct($app);
        $this -> business = $business;
    }

    public function sourceRecord(){
        $data['id_number'] = $this -> request -> param('id_number', '', 'htmlspecialchars');
        $data['graduate_school'] = $this -> request -> param('graduate_school', '', 'htmlspecialchars');
        $data['source'] = $this -> request -> param('source', '', 'htmlspecialchars');
        $data['poor_code'] = $this -> request -> param('poor_code', '', 'htmlspecialchars');
        $data['mobile_phone'] = $this -> request -> param('mobile_phone', '', 'htmlspecialchars');
        $data['qq'] = $this -> request -> param('qq', '', 'htmlspecialchars');
        $data['home_address'] = $this -> request -> param('home_address', '', 'htmlspecialchars');
        $data['home_phone'] = $this -> request -> param('home_phone', '', 'htmlspecialchars');
        $data['uid'] = $this -> getUid();
        try {
            validate(Validate::class) -> scene('insertData') -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> sourceRecord($data);
        return $this -> success("记录成功!");

    }

    public function getSourceRecord(){
        return $this -> success($this -> business -> getSourceRecord($this -> getUid()));
    }

    public function pushExcel(){
        $depart_id = $this -> request -> param('depart_id', '', 'htmlspecialchars');
        $major = $this -> request -> param('major', '', 'htmlspecialchars');
        $this -> business -> pushExcel($depart_id, $major);
    }

}