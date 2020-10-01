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
use app\common\business\admin\Auth as AuthBusiness;
use app\common\validate\admin\Auth as AuthValidate;

class Auth extends BaseController
{

    public function addAccess(){
        $data['uid'] = $this -> request -> param("uid", '', 'htmlspecialchars');
        $data['group'] = $this -> request -> param("group", '', 'htmlspecialchars');
        try {
            validate(AuthValidate::class) -> scene('addAccess') -> check($data);
        }catch (\Exception $exception){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                $exception -> getMessage()
            );
        }
        $errCode = (new AuthBusiness()) -> addAccess($data);
        if ($errCode == config("status.not_exist")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "管理员或权限组不存在！"
            );
        }
        if ($errCode == config("status.failed")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "内部异常，请稍候重试！"
            );
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            "操作成功！"
        );
    }

}