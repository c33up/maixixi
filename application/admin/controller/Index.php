<?php
namespace app\admin\controller;

use app\admin\model\Article;
use app\admin\controller\Base;
use think\Db;

class Index extends Base
{
    public function index()
    {
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
}