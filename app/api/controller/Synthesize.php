<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/25 9:49
 */


namespace app\api\controller;


use app\BaseController;
use app\common\business\api\Synthesize as SynthesizeBusiness;
use app\common\business\lib\Config;
use app\common\validate\api\Synthesize as SynthesizeValidate;
use app\common\validate\lib\Upload as UploadValidate;
use app\common\business\lib\Upload as UploadBusiness;

class Synthesize extends BaseController
{

    public function poorSign(){
        $user = $this -> getUser();
        $data['sex'] = $this -> request -> param("sex", '', 'htmlspecialchars');
        $data['sex'] = $this -> request -> param("sex", '', 'htmlspecialchars');
    }

    public function viewPoorOption(){
        $errCode = (new SynthesizeBusiness()) -> viewPoorOption();
        if ($errCode == config("status.failed")){
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

    public function uploadProve(){
        try {
            $user = $this -> getUser();
            $file = $this -> request -> file("file");
            validate(UploadValidate::class) -> checkRule(['file' => $file], 'checkFile');
        } catch (\Exception $exception) {
            $message = $exception -> getMessage();
            if ($exception -> getCode() == 4){
                $message = '未上传文件！';
            }
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                $message
            );
        }
        $errCode = (new UploadBusiness()) -> upload($user, $file, 'synthesize_poor', 'synthesize/poor/');
        if ($errCode == config("status.failed")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "内部异常，请稍候重试！"
            );
        }
        return $this -> show(
            config("status.success"),
            config("message.success"),
            ['path' => $errCode]
        );
    }

}