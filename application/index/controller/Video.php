<?php
namespace app\index\controller;

use app\index\controller\Base;
use app\index\model\Video as vid;

class Video extends Base
{
    public function index()
    {
        $data=input('');
        $cid=$data['cid'];
        $category=getCategory($cid);
        $this->assign('category',$category);
        $list=getVideo($cid);
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
        $list=getVidDetail($id);
        $this->assign('list',$list);
        return $this->fetch();
    }
}