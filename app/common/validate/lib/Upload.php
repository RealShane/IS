<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/28 10:59
 */


namespace app\common\validate\lib;


use app\common\business\lib\Config;
use think\Validate;

class Upload extends Validate
{

    protected $rule = [
        'file'  =>  'checkFile',
    ];

    protected function checkFile($file){
        if (empty($file['file'])) {
            return '未上传文件！';
        }
        $config = new Config();
        $size = $config -> getUploadSizeLimit();
        $type = $config -> getUploadTypeLimit();
        $isType = $this -> fileExt($file, $type);
        if (!$isType){
            return '文件类型不正确！';
        }
        $isSize = $this -> fileSize($file, $size['bytes']);
        if (!$isSize){
            return '文件大小超过' . $size['default'] . '！';
        }
        return true;
    }



}