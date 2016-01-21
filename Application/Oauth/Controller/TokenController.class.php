<?php
namespace Oauth\Controller;

use Think\Controller;

class TokenController extends Controller
{
    public function index()
    {
        echo json_encode(array('AccessToken'=>'FE04CCE2E04CCE2E04CCE2E04CCE2',
                                'ExpiresIn' => '7776000',
                                'refresh_token' => 'E04CCE2E04CCE2E04CCE2E04CCE2E14',
                                ));
    }

    public function user()
    {

        echo '{"Birthday":"1990-4-14","Email":"xxx@ctrip.com","MobilePhone":"86-18288900922","OpenID":"xlgl21fsva3af1gfdlv1p3lagg1om","Sex":"M","UserName":"full","ReturnCode":"0","Message":"成功"}';

    }
}
//https://accounts.ctrip.com/passport/token.aspx?grant_type=authorization_code&client_id=01002118&client_secret=Hkyth6Ygh9Jtgsn9&code=81FD40871BF36BC4358A14BB373225D4&redirect_uri=
