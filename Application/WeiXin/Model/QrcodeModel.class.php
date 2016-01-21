<?php
namespace WeiXin\Model;
use Common\BaseModel\WxBaseModel;
use Common\Util\Http;

class QrcodeModel extends WxBaseModel {

    public function genQrcodePic($data){
        /**
         * FFFFFF! 生成二维码有限额 每天10W次. 目前先这样, 如果真能超限额 有两个方案
         * 第一: 再申请几个公众号分流
         * 第二: 跳转地址换成H5. H5内接JSSDK进行操作.
         */
        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->accesstoken;
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
        return "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=$ticket";
    }

    /**
     * @param $key
     *
     * 根据二维码中scene_id(EventKey)获取对应内容
     */
    public function getValue($key){
        return S($key);
    }
}