<?php
namespace Common\Util;
/**
 * Class Http
 * @package Common\Util
 * chenliwen@baidu.com
 * 2016年01月17日02:04:45
 */
class Http {

    public static function post($url, $data){
        $ch = curl_init() ;
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_URL,$url) ;
        curl_setopt($ch, CURLOPT_POST,true) ;
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
        $res = curl_exec($ch);
        curl_close($ch) ;
        return $res;
    }

}