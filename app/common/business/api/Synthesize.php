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
use app\common\business\lib\Excel;
use app\common\business\lib\Str;
use app\common\model\api\Classes;
use app\common\model\api\Department;
use app\common\model\api\SynthesizePoorSign;
use app\common\model\api\UserClass;
use think\facade\App;
use think\facade\Db;

class Synthesize
{

    private $config = NULL;
    private $synthesizePoorSignModel = NULL;
    private $userClassModel = NULL;

    public function __construct(){
        $this -> config = new Config();
        $this -> synthesizePoorSignModel = new SynthesizePoorSign();
        $this -> userClassModel = new UserClass();
    }

    public function poorSign($data, $user){
        if (!($this -> config -> getSynthesizePoorStatus())){
            return config("status.close");
        }
        $isJoin = $this -> userClassModel -> findByUid($user['id']);
        if (empty($isJoin)){
            return config("status.error");
        }
        $isExist = $this -> synthesizePoorSignModel -> findByUid($user['id']);
        if (empty($isExist)){
            $data['uid'] = $user['id'];
            $data['create_time'] = time();
            return $this -> synthesizePoorSignModel -> save($data) ? config("status.success") : config("status.failed");
        }
        if (file_exists(App::getRootPath() . 'public' . $isExist['supporting_document']) && !($data['supporting_document'] == $isExist['supporting_document'])){
            unlink(App::getRootPath() . 'public' . $isExist['supporting_document']);
        }
        return $this -> synthesizePoorSignModel -> updatePoorSign($data, $user['id']) ? config("status.update") : config("status.failed");
    }

    public function viewPoorOption(){
        try {
            return json_decode($this -> config -> getSynthesizePoorSignOption());
        }catch (\Exception $exception){
            return config("status.failed");
        }
    }

}