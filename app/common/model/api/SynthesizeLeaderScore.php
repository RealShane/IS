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

/**班委投票模型
 * Class SynthesizePoorSign
 * @package app\common\model\api
 */

class SynthesizeLeaderScore extends Model
{

    protected $table = 'api_synthesize_leader_score';

    public function findByUidAndTarget($uid, $target){
        return $this -> where('uid', $uid) -> where('target', $target) -> find();
    }
}