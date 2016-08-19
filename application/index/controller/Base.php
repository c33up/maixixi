<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
    public function  _initialize(){
        header("Content-type: text/html; charset=utf-8");
        $pic=showPic('21');
        $this->assign('pic',$pic);
    }

}
