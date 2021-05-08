<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/25 9:44
 */


namespace app\common\model\api;


use think\Model;


class SynthesizeAuth extends Model
{

    protected $table = 'api_synthesize_auth';

    public function findByUid($uid){
        return $this -> where('uid', $uid) -> where('status', 1) -> find();
    }

}