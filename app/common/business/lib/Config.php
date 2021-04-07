<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/24 14:53
 */


namespace app\common\business\lib;


use app\common\model\api\APPConfig;
use app\common\model\api\SynthesizeConfig;
use app\common\model\api\GraduationConfig;
use app\common\model\api\SourceConfig;

class Config
{

    private $appConfig = NULL;
    private $synthesizeConfig = NULL;
    private $graduationConfig = NULL;
    private $sourceConfig = NULL;
    private $str = NULL;

    public function __construct(){
        $this -> appConfig = new APPConfig();
        $this -> synthesizeConfig = new SynthesizeConfig();
        $this -> graduationConfig = new GraduationConfig();
        $this -> sourceConfig = new SourceConfig();
        $this -> str = new Str();
    }

    /**生源库信息设置
     * @return bool
     */
    public function getSourceSignStatus(){
        $temp = $this -> sourceConfig -> keyValue("SOURCE_SIGN_STATUS");
        return intval($temp -> value) != 1;
    }

    /**毕业生去向设置
     * @return mixed
     */

    public function getGraduationDestinationCode(){
        $temp = $this -> graduationConfig -> keyValue("GRADUATION_DESTINATION_CODE");
        return json_decode($temp -> value);
    }

    public function getGraduationSignStatus(){
        $temp = $this -> graduationConfig -> keyValue("GRADUATION_SIGN_STATUS");
        return intval($temp -> value) != 1;
    }

    /**贫困生设置
     * @return mixed
     */

    public function getSynthesizePoorStatus(){
        $temp = $this -> synthesizeConfig -> keyValue("POOR_SIGN_STATUS");
        return $temp -> value;
    }
    //贫困生报名选项
    public function getSynthesizePoorSignOption(){
        $temp = $this -> synthesizeConfig -> keyValue("POOR_SIGN_OPTION");
        return $temp -> value;
    }

    /**上传设置
     * @return mixed
     */

    //上传文件大小
    public function getUploadSizeLimit(){
        $temp = $this -> appConfig -> keyValue("UPLOAD_SIZE_LIMIT");
        $bytes = $this -> str -> convertToBytes($temp -> value);
        return [
            'default' => $temp -> value,
            'bytes' => $bytes
        ];
    }
    //上传文件类型
    public function getUploadTypeLimit(){
        $temp = $this -> appConfig -> keyValue("UPLOAD_TYPE_LIMIT");
        $str = NULL;
        foreach (json_decode($temp -> value) as $key){
            $str .= $key . ",";
        }
        $str = rtrim($str, ",");
        return $str;
    }

    /**邮件发件信息模板设置
     * @return mixed
     */

    //验证码邮件标题
    public function getRandomTitle(){
        $temp = $this -> appConfig -> keyValue("EMAIL_RANDOM_TITLE");
        return $temp -> value;
    }
    //验证码邮件内容HTML版
    public function getRandomBody(){
        $temp = $this -> appConfig -> keyValue("EMAIL_RANDOM_BODY");
        return $temp -> value;
    }
    //验证码邮件内容纯文字版
    public function getRandomAltBody(){
        $temp = $this -> appConfig -> keyValue("EMAIL_RANDOM_ALT_BODY");
        return $temp -> value;
    }
    //注册激活邮件标题
    public function getActiveTitle(){
        $temp = $this -> appConfig -> keyValue("EMAIL_ACTIVE_TITLE");
        return $temp -> value;
    }
    //注册激活邮件内容HTML版
    public function getActiveBody(){
        $temp = $this -> appConfig -> keyValue("EMAIL_ACTIVE_BODY");
        return $temp -> value;
    }
    //注册激活邮件内容纯文字版
    public function getActiveAltBody(){
        $temp = $this -> appConfig -> keyValue("EMAIL_ACTIVE_ALT_BODY");
        return $temp -> value;
    }

    /**邮箱设置
     * @return mixed
     */

    //邮箱地址
    public function getHost(){
        $temp = $this -> appConfig -> keyValue("EMAIL_HOST");
        return $temp -> value;
    }
    //邮箱用户名
    public function getUserName(){
        $temp = $this -> appConfig -> keyValue("EMAIL_USERNAME");
        return $temp -> value;
    }
    //邮箱密码
    public function getPassword(){
        $temp = $this -> appConfig -> keyValue("EMAIL_PASSWORD");
        return $temp -> value;
    }
    //邮件发送人姓名
    public function getName(){
        $temp = $this -> appConfig -> keyValue("EMAIL_NAME");
        return $temp -> value;
    }

}