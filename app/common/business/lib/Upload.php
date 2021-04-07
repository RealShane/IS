<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/28 10:13
 */


namespace app\common\business\lib;


use think\facade\Filesystem;

class Upload
{

    private $config = NULL;
    private $str = NULL;

    public function __construct(){
        $this -> config = new Config();
        $this -> str = new Str();
    }

    public function upload($user, $file, $type, $path){
        $saveName = Filesystem::disk($type) -> putFileAs($user['name'] . $user['student_id'] . '/' . date("Y/m/d") . '/' . $this -> str -> createToken($user['email']), $file, $file -> getOriginalName());
        return str_replace('\\', '', '/uploads/' . $path . $saveName);
    }

}