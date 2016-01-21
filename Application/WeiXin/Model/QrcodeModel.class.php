<?php
namespace WeiXin\Model;
use Common\BaseModel\WxBaseModel;
use Common\Util\WxTool;

class QrcodeModel extends WxBaseModel {

    public function genQrcodePic($data){
        /**
         * FFFFFF! 生成二维码有限额 每天10W次. 目前先这样, 如果真能超限额 有两个方案
         * 第一: 再申请几个公众号分流
         * 第二: 跳转地址换成H5. H5内接JSSDK进行操作.
         */
        //if($data)
        return WxTool::getQrUrl($data);
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