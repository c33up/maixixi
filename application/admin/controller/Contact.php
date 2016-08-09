<?php
namespace app\admin\controller;
use app\admin\model\Contact as ct;
use app\admin\controller\Base;
use think\Db;

class Contact extends Base
{
    public function index()
    {
        $list=ct::select();
        $count=ct::count();
        //dump($list);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('empty','<tr><td><h1 style="text-align: center;">暂时没有数据</h1></td></tr>');
        return $this->fetch();
    }

    public function add()
    {
       if(request()->isPost()){
            $data = input('post.');

            $status = ct::insert($data);
            if($status){
                return $this->success('添加成功',url('contact/index'));
            }else{
                return $this->error('添加失败,请重试或是联系技术支持');
            }

            
        }else{
            return $this->fetch();
        }
    }

     public function update()
    {
       if(request()->isPost()){
            $data = input('post.');
            $status = ct::where('id','1')->update($data);
            if($status){
                return $this->success('更新成功',url('contact/index'));
            }else{
                return $this->error('更新失败,请重试或是联系技术支持');
            }  
        }else{
            $list=ct::where('id','1')->find();
             $this->assign('list', $list);
            return $this->fetch();
        }
    }
}