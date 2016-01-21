<?php
namespace Common\Util;

class WxTool {
    const QR_SETDATA = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=%s';
    const QR_IMGBAES = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=%s';
    CONST GETTOKENURL = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s';

    public static $accesstoekn;

    public static function getQrUrl($data){
        /**
         * FFFFFF! 生成二维码有限额 每天10W次. 目前先这样, 如果真能超限额 有两个方案
         * 第一: 再申请几个公众号分流
         * 第二: 跳转地址换成H5. H5内接JSSDK进行操作.
         */
        $url = sprintf(self::setDateUrl,self::AccessToken());
        $expiretime = 3600 * 1;
        $key = rand();
        /**todo
         * 更换存储容器
         */
        while(S($key)){
            $key = rand();
        }
        S($key, $data, $expiretime);
        $arr = array(
            'expire_seconds' => $expiretime,
            'action_name'    => 'QR_SCENE',
            'action_info'    => array(
                'scene' => array(
                    'scene_id' => $key
                ),
            ),
        );
        $res =  Http::post($url,json_encode($arr));
        $res = json_decode($res,true);
        $ticket = urlencode($res['ticket']);
        return sprintf(self::QR_IMGBAES,$ticket);
    }

    public static function AccessToken(){
        $accesstoken = self::$accesstoekn ?:S('accesstoken');
        do{
            if($accesstoken){
                break;
            }
            $appInfo = C('weixin');
            $res = file_get_contents(sprintf(self::GETTOKENURL,$appInfo['appID'], $appInfo['appsecret']));
            $res = json_decode($res,true);
            $accesstoken = $res['access_token'];
            $expires     = $res['expires_in'];
            S('accesstoken', $accesstoken, $expires);
            self::$accesstoken = $accesstoken;
        }while(false);
        return $accesstoken;
    }
}