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

/**班委报名模型
 * Class SynthesizePoorSign
 * @package app\common\model\api
 */

class SynthesizeLeaderSign extends Model
{

    protected $table = 'api_synthesize_leader_sign';

    protected $autoWriteTimestamp = false;

    public function updateLeaderSign($data, $uid){
        $result = $this -> findByUid($uid);
        return $result -> allowField([
            'job',
            'advantage'
        ]) -> save($data);
    }

    public function seletAll(){
        return $this ->  where('id', '>',  0) -> select();
    }


    public function signCount(){
        return $this ->  where('id', '>',  0) -> count();
    }

    public function findByUid($uid){
        return self::with('user')
            -> where('uid', $uid)
            -> find();
    }

    public function user(){
        return $this -> belongsTo(User::class, 'uid', 'id');
    }

}