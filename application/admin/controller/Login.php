<?php
namespace app\admin\controller;
use \think\Controller;
use app\admin\model\User;
class Login extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    /**
     * [logout 登录操作]
     * @return [type] [description]
     */
    public function login(){

        $data = input('post.');

        if(!$data['username']||!$data['password']){
            $this->error('用户名或密码不能为空');
        }

        $preview =User::where(array('username'=>$data['username']))->find();
        if(!$preview){
            $this->error('用户不存在');
        }

        $where_query = array(
                'username' => $data['username'],
                'password' => md5($data['password'])
            );
        if ($user = User::where($where_query)->find()) {
            //注册session
            session('uid',$user['id'],'think');
            session('username',$user['username'],'think');
            session('password',$user['password'],'think');

              //更新最后请求IP及时间
            $request = request();
            $ip = $request->ip();
            $time = time();
            $expire_time = time()+config('auth_expired_time');
            $user->where($where_query)->update(['last_login_ip' => $ip, 'last_login_time' => $time,'expire_time'=>$expire_time]);

            return $this->success('登录成功', 'index/index');
        } else {
            $this->error('登录失败:账号或密码错误');
        }
    }

    /**
     * [logout 登出操作]
     * @return [type] [description]
     */
    public function logout(){
        $request = request();
        session(null, 'think');
        return $this->success('已成功登出', 'login/index');
    }
}
