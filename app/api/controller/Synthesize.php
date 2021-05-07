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
use app\common\business\api\Synthesize as Business;
use app\common\validate\api\Synthesize as Validate;
use app\common\validate\lib\Upload as UploadValidate;
use app\common\business\lib\Upload as UploadBusiness;
use think\App;

class Synthesize extends BaseController
{

    protected $business = NULL;
    protected $upload = NULL;

    public function __construct(App $app, Business $business, UploadBusiness $upload){
        parent::__construct($app);
        $this -> business = $business;
        $this -> upload = $upload;
    }

    public function getCrossScore(){
       $uid = $this -> getUid();
       $target = $this -> request -> param('target', '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('get_cross_score') -> check(['target' => $target]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> getCrossScore($uid, $target));
    }

    public function crossScore(){
        $data['uid'] = $this -> getUid();
        $data['target'] =  $this -> request -> param('target', '', 'htmlspecialchars');
        $data['score'] = $this -> request -> param('score', '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('cross_score') -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> crossScore($data);
        return $this -> success("评分成功！");
    }

    public function showCrossList(){
        return $this -> success($this -> business -> showCrossList($this -> getUser()));
    }

    public function getPoorScore(){
        $id = $this -> request -> param('target', '', 'htmlspecialchars');
        try {
            validate(Validate::class) -> scene('get_poor_score') -> check(['target' => $id]);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        return $this -> success($this -> business -> getPoorScore($id));
    }

    public function showPoorSignDetail(){
        $target = $this -> request -> param('target', '', 'htmlspecialchars');
        return $this -> success($this -> business -> showPoorSignDetail($this -> getUser(), $target));

    }

    public function showPoorSignList(){
        return $this -> success($this -> business -> showPoorSignList($this -> getUser()));

    }

    public function getPoorSign(){
        $uid = $this -> getUid();
        return $this -> success($this -> business -> getPoorSign($uid));
    }

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
            validate(Validate::class) -> scene('poor_sign') -> check($data);
        }catch (\Exception $exception){
            return $this -> fail($exception -> getMessage());
        }
        $this -> business -> poorSign($data, $user);
        return $this -> success("操作成功！");
    }

    public function viewPoorOption(){
        return $this -> success($this -> business -> viewPoorOption());
    }

    public function uploadProve(){
        $user = $this -> getUser();
        $file = $this -> request -> file("file");
        try {
            validate(UploadValidate::class) -> checkRule(['file' => $file], 'checkFile');
        } catch (\Exception $exception) {
            return $this -> fail($exception -> getMessage());
        }
        $saveName = $this -> upload -> upload($user, $file, 'synthesize_poor', 'synthesize/poor/');
        return $this -> success(['path' => $saveName]);
    }

}