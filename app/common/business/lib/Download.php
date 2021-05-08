<?php


namespace app\common\business\lib;


class Download
{

    public function push($file_path, $file_name){
        header("Content-type:text/html;charset=utf-8");
        if(!file_exists($file_path)) {
            echo "下载文件不存在！";
            exit;
        }
        $fp=fopen($file_path,"r");
        $file_size=filesize($file_path);
        //下载文件需要用到的头
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length:".$file_size);
        Header("Content-Disposition: attachment; filename=".$file_name);
        $buffer=1024;
        $file_count=0;
        while(!feof($fp) && $file_count<$file_size) {
            $file_con=fread($fp,$buffer);
            $file_count+=$buffer;
            echo $file_con;
        }
        fclose($fp);    //关闭这个打开的文件
    }

}