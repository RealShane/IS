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

/**贫困生打分/投票模型
 * Class SynthesizePoorSign
 * @package app\common\model\api
 */

class SynthesizePoorScore extends Model
{

    protected $table = 'api_synthesize_poor_score';

    public function findByUidAndTarget($uid, $target){
        return $this -> where('uid', $uid) -> where('target', $target) -> find();
    }

    public function findByUid($uid){
        return $this -> where('uid', $uid) -> count();
    }


}