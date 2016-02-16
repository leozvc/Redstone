<?php
namespace WeiXin\Controller;

use Think\Controller;

class QrcodeController extends Controller{
    public function GetPic(){
         $img = D('Qrcode')->genQrcodePic(array('file_id'=>'dasdasdasds','channel_id'=>'dasdasfasdasdgg'));
         header('Location: '.$img);
    }
}