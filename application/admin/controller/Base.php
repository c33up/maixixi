<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\User;
class Base extends Controller
{
    public function  _initialize(){
        header("Content-type: text/html; charset=utf-8");
        //session不存在时，不允许直接访问

        if(!session('uid')){
			//未登陆跳转
			$this->error('还没有登录，正在跳转到登录页','login/index');
		}

        //过期时间校验
		if(config('auth_expired_check')){
			$this->auth_expired_check();
	    }

        $short=showShort(); 
        $this->assign('short', $short); 
    }

    	/**
	 * [auth_expired_check 登录时间校验
	 * 应用场景：主要是在他人电脑上登陆后，忘了登出
	 * @return [type] [description]
	 */
	protected function auth_expired_check(){
		$where_query = array(
                'username' => session('username'),
                'password' => session('password')
            );
		$user = User::where($where_query)->find();
        if ((time() > $user['expire_time'])) { //登录超时
        	//注销当前账号
        	session(null, 'think');
            $this->error('账号已过期','login/index');
        }
	}
}
