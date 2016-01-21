<?php
namespace WeiXin\Controller;

use Think\Controller;
use Think\Log;

class IndexController extends Controller
{
    const TOKEN = 'levine';

    public function index()
    {
        $xml = file_get_contents('php://input');
        $xml = simplexml_load_string($xml,NULL,LIBXML_NOCDATA);
        $params = json_decode(json_encode($xml),true);
        trace($params);
        $action = strtolower($params['Event']);
        $this->$action($params);

    }
    public function subscribe($params){
        do{
            $EventKey = $params['EventKey'];
            if(stripos($EventKey,'qrscene_') !== false){
                $this->scan($params);
            }
        }while(false);
    }
    public function scan($params){
        $key = $params['EventKey'];
        $tmp = stripos($key,'_');
        if($tmp !== false){
            $key = substr($key,$tmp + 1);
            trace($key);
        }
        trace(D('Qrcode')->getValue($key));
        echo '<xml>
        <ToUserName><![CDATA['.$params['FromUserName'].']]></ToUserName>
        <FromUserName><![CDATA['.$params['ToUserName'].']]></FromUserName>
        <CreateTime>'.time().'</CreateTime>
        <MsgType><![CDATA[text]]></MsgType>
        <Content><![CDATA[你好]]></Content>
        </xml>';
    }

    public function __call($name, $arguments)
    {
        /**todo
         * 封装日志类
         */
        Log::write('err action '.$name ,'EMERG');
    }

}