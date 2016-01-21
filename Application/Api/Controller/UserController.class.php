<?php
namespace Api\Controller;

use Think\Controller;

class UserController extends Controller
{
    Public function index(){

    }
    public function add(){

        echo 'add user';
    }

    public function oAuth(){
	      $code = I('code');
      	if(!$code){
      		header('Location: https://openapi.youku.com/v2/oauth2/authorize?client_id=6b23296b1f6fe2f3&response_type=code&redirect_uri='.urlencode('https://home.zuosi.la/Api/User/oAuth').'&state=xyz',302);
      	}
      	$url = "https://openapi.youku.com/v2/oauth2/token";
        $post_data = array (
              "client_id" => "6b23296b1f6fe2f3",
              "client_secret" => "653215f73249529cd6dfc4685e421192",
              "grant_type"    => "authorization_code",
              "code"          => $code,
              "redirect_uri"  => 'https://home.zuosi.la/Api/User/oAuth'
          );
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     // post数据
     curl_setopt($ch, CURLOPT_POST, 1);
    // post的变量
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $output = curl_exec($ch);
    curl_close($ch);
     //打印获得的数据
     print_r($output);
    }
}
