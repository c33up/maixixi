<?php
namespace app\admin\controller;
use app\admin\model\User as AdminUser;
use app\admin\controller\Base;
use think\Validate;

class User extends Base
{

    public function index()
    {
        $list = AdminUser::order('id','asc')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function add()
    {
       if(request()->isPost()){
           $data = input('post.');

           $rule = [
                ['username','require|max:25','用户名不能为空|用户名最多不能超过25个字符'],
                ['password','require|min:6|max:26','密码不能为空|密码长度为6~26个字符|密码长度为6~26个字符'],
                ['password2','require|confirm:password','密码不能为空|输入密码不一致']
            ];

            $validate = new Validate($rule);
            $result   = $validate->check($data);
            if(!$result){
                 return $this->error($validate->getError());
            }else{

                $result=AdminUser::where('username',$data['username'])->find();
                if($result){
                         $this->error('用户已存在');
                }else{
                        $userdata['username'] = $data['username'];
                        $userdata['password'] = md5($data['password']);
                        $userdata['create_time'] = time();
                        $userdata['update_time'] = time();
                        //dump($data);
                        $status = AdminUser::insert($userdata);
                        if($status){
                            return $this->success('添加成功',url('user/index'));
                        }else{
                            return $this->error('添加失败,请重试或是联系技术支持');
                        }
                }
 
                //dump($data);


            }


          
            
        }else{
            return $this->fetch();
        } 
    }

     public function update()
    {
       if(request()->isPost()){
           $data = input('post.');

            $rule = [
                ['password','require|min:6|max:26','密码不能为空|密码长度为6~26个字符|密码长度为6~26个字符'],
                ['password2','require|confirm:password','密码不能为空|输入密码不一致']
            ];

            $validate = new Validate($rule);
            $result   = $validate->check($data);
            if(!$result){
                 return $this->error($validate->getError());
            }else{

                    //dump($data);
                    $userdata['password'] = md5(input('post.password'));
                    $status = AdminUser::where('id',$data['id'])->update($userdata);
                    if($status){
                        return $this->success('修改成功',url('user/index'));
                    }else{
                        return $this->error('修改失败,请重试或是联系技术支持');
                    }
               
 
            //dump($data);
            }
        }else{
            $data = input('');
            $list=db('user')->where('id',$data['id'])->find();
            //dump($list);
            $this->assign('list',$list);
            return $this->fetch();
        }
    }

    public function delect(){
          $data = input('');
          $status = AdminUser::where('id',$data['id'])->delete();
          if($status){
                return $this->success('删除成功',url('user/index'));
            }else{
                return $this->error('删除失败,请重试或是联系技术支持');
            }
    }
}