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

/**贫困生报名模型
 * Class SynthesizePoorSign
 * @package app\common\model\api
 */

class SynthesizePoorSign extends Model
{

    protected $table = 'api_synthesize_poor_sign';

    protected $type = [
        'confirm_reason'    =>  'json'
    ];

    protected $autoWriteTimestamp = false;

    public function findWithUid($uid){
        return $this -> where('uid', $uid) -> find();
    }

    public function updatePoorSign($data, $uid){
        $result = $this -> findByUid($uid);
        return $result -> allowField([
            'political_outlook',
            'id_card_number',
            'poor_type_one',
            'poor_type_two',
            'poor_type_three',
            'poor_type_four',
            'poor_type_five',
            'poor_type_six',
            'poor_type_seven',
            'poor_type_eight',
            'confirm_reason',
            'confirm_reason_explain',
            'address',
            'home_phone',
            'contact_phone',
            'remark',
            'supporting_document'
        ]) -> save($data);
    }

    public function findByUid($uid){
        return self::with('user')
            -> where('uid', $uid)
            -> find();
    }

    public function user(){
        return $this -> belongsTo(User::class, 'uid', 'id');
    }

}