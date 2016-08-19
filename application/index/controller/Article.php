<?php
namespace app\index\controller;

use app\index\controller\Base;


class Article extends Base
{

    public function index()
    {
        $data=input('');
        $cid=$data['cid'];
        $category=getCategory($cid);
        $list=getArticle($cid);
        //dump($list);
        $this->assign('category',$category);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function detail()
    {
        $data=input('');
        $cid=$data['cid'];
        $id=$data['id'];
        $category=getCategory($cid);
        $this->assign('category',$category);
        $list=getArtDetail($id);
        //dump($list);

        $this->assign('list',$list);
        return $this->fetch();
    }
}