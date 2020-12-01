<?php


namespace app\api\controller;


use app\BaseController;
use app\common\business\api\Graduation as GraduationBusiness;
use app\common\business\api\Source as SourceBusiness;
use app\common\validate\api\Source as SourceValidate;
class Source extends BaseController
{
    public function sourceRecord(){
        $user = $this -> getUser();
        $data['id_number'] = $this -> request -> param('id_number', '', 'htmlspecialchars');
        $data['graduate_school'] = $this -> request -> param('graduate_school', '', 'htmlspecialchars');
        $data['source'] = $this -> request -> param('source', '', 'htmlspecialchars');
        $data['poor_code'] = $this -> request -> param('poor_code', '', 'htmlspecialchars');
        $data['mobile_phone'] = $this -> request -> param('mobile_phone', '', 'htmlspecialchars');
        $data['qq'] = $this -> request -> param('qq', '', 'htmlspecialchars');
        $data['home_address'] = $this -> request -> param('home_address', '', 'htmlspecialchars');
        $data['home_phone'] = $this -> request -> param('home_phone', '', 'htmlspecialchars');
        $data['uid'] = $user['id'];
        try {
            validate(SourceValidate::class) -> scene('insertData') -> check($data);
        }catch (\Exception $exception){
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                $exception -> getMessage()
            );
        }
        $errCode = (new SourceBusiness()) -> sourceRecord($data);
        if ($errCode == config('status.failed')){
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                '记录失败!'
            );
        }
        if ($errCode == config('status.close')){
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                '功能已关闭!'
            );
        }
        return $this -> show(
            config('status.success'),
            config('message.success'),
            '记录成功!'
        );

    }

    public function getSourceRecord(){
        $uid = $this -> getUid();
        $errCode = (new SourceBusiness()) -> getSourceRecord($uid);
        if ($errCode == config('status.failed')){
            return $this -> show(
                config('status.failed'),
                config('message.failed'),
                '查询失败!'
            );
        }
        return $this -> show(
            config('status.success'),
            config('message.success'),
            $errCode
        );
    }

    public function pushExcel(){
        $depart_id = $this -> request -> param('depart_id', '', 'htmlspecialchars');
        $major = $this -> request -> param('major', '', 'htmlspecialchars');
        $errCode = (new SourceBusiness()) -> pushExcel($depart_id, $major);
        return $this -> show(
            config('status.success'),
            config('message.success'),
            $errCode
        );

    }

}