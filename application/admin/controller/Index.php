<?php
namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Article;
use app\admin\model\Message;
use app\admin\controller\Base;
use think\Db;

class Index extends Base
{
    public function  _initialize(){
       $category=Category::find('0');
       $short=showShort(); 
       $this->assign('short', $short); 
       $this->assign('category', $category); 
    }
    public function index()
    {
       
        $list=Message::order('id desc')->limit(10)->select();  
        $this->assign('list', $list); 
        return $this->fetch();
    }

    public function search()
    {
        $key=input('key');
        if(empty($key)){
           $list=Article::paginate(5);  
        }else{
           $where['title|intro|content']=['like','%'.$key.'%'];
           $list=Article::where($where)->paginate(5);  
        }
        
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function message()
    {
        $list=Message::order('id desc')->paginate(6);  
        $this->assign('list', $list); 
        return $this->fetch();
    }
}