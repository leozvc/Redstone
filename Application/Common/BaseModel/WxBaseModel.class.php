<?php

namespace Common\BaseModel;
use Common\Util\WxTool;
use Think\Model;
class WxBaseModel extends Model {
    public function __construct(){

        $this->accesstoken = WxTool::AccessToken();
    }
}