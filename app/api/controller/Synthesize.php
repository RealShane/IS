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
use app\common\validate\api\Synthesize as SynthesizeValidate;
use app\common\validate\lib\Upload as UploadValidate;
use app\common\business\lib\Upload as UploadBusiness;
use think\facade\View;

class Synthesize extends BaseController
{

    public function poorSign(){
        $user = $this -> getUser();
        $data['political_outlook'] = $this -> request -> param("political_outlook", '', 'htmlspecialchars');
        $data['id_card_number'] = $this -> request -> param("id_card_number", '', 'htmlspecialchars');
        $data['poor_type_one'] = $this -> request -> param("poor_type_one", '', 'htmlspecialchars');
        $data['poor_type_two'] = $this -> request -> param("poor_type_two", '', 'htmlspecialchars');
        $data['poor_type_three'] = $this -> request -> param("poor_type_three", '', 'htmlspecialchars');
        $data['poor_type_four'] = $this -> request -> param("poor_type_four", '', 'htmlspecialchars');
        $data['poor_type_five'] = $this -> request -> param("poor_type_five", '', 'htmlspecialchars');
        $data['poor_type_six'] = $this -> request -> param("poor_type_six", '', 'htmlspecialchars');
        $data['poor_type_seven'] = $this -> request -> param("poor_type_seven", '', 'htmlspecialchars');
        $data['poor_type_eight'] = $this -> request -> param("poor_type_eight", '', 'htmlspecialchars');
        $data['confirm_reason'] = $this -> request -> param("confirm_reason", '', 'htmlspecialchars');
        $data['confirm_reason_explain'] = $this -> request -> param("confirm_reason_explain", '', 'htmlspecialchars');
        $data['address'] = $this -> request -> param("address", '', 'htmlspecialchars');
        $data['home_phone'] = $this -> request -> param("home_phone", '', 'htmlspecialchars');
        $data['contact_phone'] = $this -> request -> param("contact_phone", '', 'htmlspecialchars');
        $data['remark'] = $this -> request -> param("remark", '', 'htmlspecialchars');
        $data['supporting_document'] = $this -> request -> param("supporting_document", '', 'htmlspecialchars');
        try {
            validate(SynthesizeValidate::class) -> scene('poor_sign') -> check($data);
        }catch (\Exception $exception){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                $exception -> getMessage()
            );
        }
        $errCode = (new SynthesizeBusiness()) -> poorSign($data, $user);
        if ($errCode == config("status.close")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "贫困生报名处于关闭状态！"
            );
        }
        if ($errCode == config("status.error")){
            return $this -> show(
                config("status.failed"),
                config("message.failed"),
                "贫困生报名请先加入班级！"
            );
        }
        if ($errCode == config("status.update")){
            return $this -> show(
                config("status.success"),
                config("message.success"),
                "更改成功！"
            );
        }
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
            "报名成功！"
        );
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

    public function test(){
        (new SynthesizeBusiness()) -> test(['id' => 1]);
    }

    public function testView(){
        return View::fetch('synthesize/test');
    }

}