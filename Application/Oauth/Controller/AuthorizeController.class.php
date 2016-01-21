<?php
namespace Oauth\Controller;

use Think\Controller;

class AuthorizeController extends Controller
{
    public function index()
    {
        $code = 'E5DC0D001347852E1DC9FC78AF27D162';
        $url = $_GET['redirect_uri'];
        $url = (parse_url($url));
        header("Location: http://passport.qatest.baidu.com{$url['path']}?{$url['query']}&code=$code");
    }
}
