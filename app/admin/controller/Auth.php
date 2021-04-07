<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/10/1 11:12
 */


namespace app\admin\controller;


use app\BaseController;
use app\common\business\admin\Auth as Business;
use app\common\validate\admin\Auth as Validate;
use think\App;

class Auth extends BaseController
{

    protected $business = NULL;

    public function __construct(App $app, Business $business){
        parent::__construct($app);
        $this -> business = $business;
    }

    public function getRule(){
        $errCode = $this -> business -> getRule($this -> request -> param("id", ''));
        return $this -> success($errCode);
    }

    public function adminMenuAndView(){
        return $this -> success($this -> business -> adminMenuAndView($this -> getUser()));
    }

    public function viewRule(){
        $errCode = $this -> business -> viewRule($this -> request -> param("num", ''));
        return $this -> success($errCode);
    }

    public function updateRule(){
        $data['id'] = $this -> request -> param("id", '');
        $data['name'] = $this -> request -> param("name", '');
        $data['icon'] = $this -> request -> param("icon", '');
        $data['weigh'] = $this -> request -> param("weigh", '');
        $data['status'] = $this -> request -> param("status", '');
        try {
            validate(Validate::class) -> scene('updateRule') -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> updateRule($data);
        return $this -> success("操作成功！");
    }

    public function viewAllGroup(){
        $errCode = $this -> business -> viewAllGroup($this -> request -> param("num", ''));
        return $this -> success($errCode);
    }

    public function deleteGroup(){
        $id = $this -> request -> param("id", '');
        try {
            validate(Validate::class) -> scene('deleteGroup') -> check(['id' => $id]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> deleteGroup($id);
        return $this -> success("操作成功！");
    }

    public function addGroupComment(){
        return $this -> success($this -> business -> addGroupComment());
    }

    public function addGroup(){
        $data['name'] = $this -> request -> param("name", '');
        $data['rules'] = $this -> request -> param("rules", '');
        try {
            validate(Validate::class) -> scene('addGroup') -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> addGroup($data);
        return $this -> success("操作成功！");
    }

    public function viewAllAccess(){
        $errCode = $this -> business -> viewAllAccess($this -> request -> param("num", ''));
        return $this -> success($errCode);
    }

    public function deleteAccess(){
        $id = $this -> request -> param("id", '');
        try {
            validate(Validate::class) -> scene('deleteAccess') -> check(['id' => $id]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> deleteAccess($id);
        return $this -> success("操作成功！");
    }

    public function addAccessComment(){
        return $this -> success($this -> business -> addAccessComment());
    }

    public function addAccess(){
        $data['uid'] = $this -> request -> param("uid", '');
        $data['group'] = $this -> request -> param("group", '');
        try {
            validate(Validate::class) -> scene('addAccess') -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> addAccess($data);
        return $this -> success("操作成功！");
    }

}