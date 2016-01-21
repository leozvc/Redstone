<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $this->show('Neighbor Lao Wang '.C('verison'),'utf-8');
    }
}
