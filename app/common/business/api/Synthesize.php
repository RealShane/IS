<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/25 9:51
 */


namespace app\common\business\api;


use app\common\business\lib\Config;

class Synthesize
{

    private $config = NULL;

    public function __construct(){
        $this -> config = new Config();
    }

    public function poorSign(){

    }

    public function viewPoorOption(){
        try {
            return json_decode($this -> config -> getSynthesizePoorSignOption());
        }catch (\Exception $exception){
            return config("status.failed");
        }
    }

}