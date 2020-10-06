<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/10/6 8:32
 */


namespace app\admin\controller;


use app\BaseController;
use app\common\business\admin\Synthesize as SynthesizeBusiness;
use think\facade\View;

class Synthesize extends BaseController
{

    public function exportPoorSignExcel(){
        $type = $this -> request -> param("type", '', 'htmlspecialchars');
        $errCode = (new SynthesizeBusiness()) -> exportPoorSignExcel(strtoupper($type));
        if (empty($errCode)){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "内部异常，请稍候重试！"
            );
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            $errCode
        );
    }

    public function testView(){
        return View::fetch('synthesize/test');
    }

}