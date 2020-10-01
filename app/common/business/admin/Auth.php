<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/10/1 11:17
 */


namespace app\common\business\admin;


use app\common\model\admin\User;
use app\common\model\admin\AuthAccess;
use app\common\model\admin\AuthGroup;

class Auth
{

    private $userModel = NULL;
    private $accessModel = NULL;
    private $groupModel = NULL;

    public function __construct(){
        $this -> userModel = new User();
        $this -> accessModel = new AuthAccess();
        $this -> groupModel = new AuthGroup();
    }

    public function addAccess($data){
        $userExist = $this -> userModel -> findById($data['uid']);
        if (empty($userExist)){
            return config("status.not_exist");
        }
        $groupExist = $this -> groupModel -> findById($data['group']);
        if (empty($groupExist)){
            return config("status.not_exist");
        }
        $isExist = $this -> accessModel -> findByUid($data['uid']);
        if (empty($isExist)){
            return $this -> accessModel -> save($data) ? config("status.success") : config("status.failed");
        }
        return $this -> accessModel -> updateByUid($data) ? config("status.success") : config("status.failed");
    }

}