<?php
namespace app\index\controller;

use app\index\controller\Base;
use app\index\model\Intro as introduct;

class Intro extends Base
{

    public function index()
    {
        $list=introduct::where('cid','1')->find();
        $this->assign('list',$list);
        return $this->fetch();
    }
}