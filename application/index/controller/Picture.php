<?php
namespace app\index\controller;

use app\index\controller\Base;

class Picture extends Base
{
    public function index()
    {
        $data=input('');
        $cid=$data['cid'];
        $category=getCategory($cid);
        $this->assign('category',$category);
        $list=getPicture($cid);
        $this->assign('list',$list);
        return $this->fetch();
    }
}