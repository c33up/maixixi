<?php
namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Intro as synopsis;
use app\admin\controller\Base;
use think\Db;

class Intro extends Base
{

    public function index()
    {

        $cid = input('cid');
        $category=Category::find($cid);
        $list=$category->intro()->where('cid',$cid)->find();
        $count=$category->intro()->where('cid',$cid)->count();

        //dump($data);
        $this->assign('category', $category);
        $this->assign('list', $list);
        $this->assign('count', $count);
        return $this->fetch();
    }

    public function add()
    {
        if(request()->isPost()){
            $data = input('');
            $category=input('cid');
            //dump($data);
            $status = synopsis::insert($data);
            if($status){
                return $this->success('添加成功',url('intro/index',['cid'=>$category]));
            }else{
                return $this->error('添加失败,请重试或是联系技术支持');
            }
        }else{
            
            $cid = input('cid');
            $category=Category::find($cid);
            $time=date("Y-m-d\TH:i") ;
            //dump($time);
            $this->assign('category', $category);
            $this->assign('time', $time);
            return $this->fetch();
        } 
    }

    public function update()
    {
        if(request()->isPost()){
            $data = input('');
            $cid=input('cid');
            //dump($data);
            $status = synopsis::where('cid',$cid)->update($data);
            if($status){
                return $this->success('更新成功',url('intro/index',['cid'=>$cid]));
            }else{
                return $this->error('更新失败,请重试或是联系技术支持');
            }
        }else{
            
            $cid = input('cid');
            $category=Category::find($cid);
            $list=$category->intro()->where('cid',$cid)->find();
            $time=date("Y-m-d\TH:i",strtotime($list['createDate'])) ;
            //dump($time);
            $this->assign('category', $category);
            $this->assign('list', $list);
            $this->assign('time', $time);
            return $this->fetch();
        } 
    }
}