<?php

namespace Common\BaseModel;
use Think\Model;
class WxBaseModel extends Model {
    CONST GETTOKENURL = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s';
    public function __construct(){
        $accesstoken = S('accesstoken');
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
        }while(false);
        $this->accesstoken = $accesstoken;
    }
}