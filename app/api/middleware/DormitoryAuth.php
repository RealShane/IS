<?php


namespace app\api\middleware;


use app\BaseController;
use app\common\model\api\DormitoryScorer;
class DormitoryAuth extends BaseController
{
    public function handle($request, \Closure $next){
        $user = $this -> getUser();
        $auth = (new DormitoryScorer()) -> findById($user['id']);
        if (empty($userId)){
            return $this -> show(
                config('status.goto'),
                config('message.goto'),
                '非法请求'
            );
        }


        return $next($request);
    }

}