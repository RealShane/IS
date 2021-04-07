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

/**综合测评设置模型
 * Class SynthesizePoorSign
 * @package app\common\model\api
 */

class SynthesizeConfig extends Model
{

    protected $table = 'api_synthesize_config';

    public function keyValue($key){
        return $this -> field('value') -> where('key', $key) -> where('status', 1) -> find();
    }

}