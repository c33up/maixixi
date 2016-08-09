<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
class Base extends Controller
{
    public function  _initialize(){
        header("Content-type: text/html; charset=utf-8");
        //session不存在时，不允许直接访问
		if(!session('uid')){
			//未登陆跳转
			$this->error('还没有登录，正在跳转到登录页','login/index');
		}
    }
}
