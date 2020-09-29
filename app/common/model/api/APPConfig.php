<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/23 15:33
 */


namespace app\common\model\api;


use think\Model;

/**全局设置模型
 * Class APPConfig
 * @package app\common\model\api
 */

class APPConfig extends Model
{

    protected $name = "api_app_config";

    public function findByKey($key){
        return $this -> field('value') -> where('key', $key) -> where('status', 1) -> find();
    }

}