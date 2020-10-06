<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/10/6 8:36
 */


namespace app\common\model\admin;


use think\Model;

class Synthesize extends Model
{

    protected $name = 'api_synthesize_poor_sign';

    public function findAll(){
        return $this -> where('id', '>', 0) -> where('status', 1) -> select();
    }

}