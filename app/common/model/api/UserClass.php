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

/**用户班级关系模型
 * Class UserClass
 * @package app\common\model\api
 */

class UserClass extends Model
{

    protected $table = "api_user_class";

    public function updateUser($data){
        $result = $this -> findByUid($data['target']);
        return $result -> allowField(['class_id']) -> save($data);
    }

    public function countByClass($classId){
        return $this ->  where('class_id', $classId) -> count();
    }

    public function findAllByClassId($class){
        return $this -> where('class_id', $class) -> where('status', 1) -> select();
    }

    public function findByUidWithUser($uid){
        return self::with('user') -> where('uid', $uid) -> find();
    }

    public function findByUid($uid){
        return $this -> where('uid', $uid) -> find();
    }

    public function user(){
        return $this -> belongsTo(User::class, 'uid', 'id');
    }


}