<?php
declare (strict_types = 1);

namespace app\admin\middleware;

use app\BaseController;
use app\common\model\admin\User;

class IsLogin extends BaseController
{

    public function handle($request, \Closure $next){
        $token = $this -> getToken();
        if (empty($token)){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "非法请求！"
            );
        }
        $user = $this -> getUser();
        if (empty($user)){
            return $this -> show(
                config("status.goto"),
                config("message.goto"),
                "登录过期！"
            );
        }
        $user = (new User()) -> findByUserName($user['username']);
        if ($user['last_login_token'] != $token){
            cache(config('redis.token_pre') . $token, NULL);
            return $this -> show(
                config("status.goto"),
                config("message.goto"),
                "账号异地登录，请重新登录！"
            );
        }
        return $next($request);
    }
}
