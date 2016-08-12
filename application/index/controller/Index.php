<?php
namespace app\index\controller;

use app\index\controller\Base;


class Index extends Base
{
    public function index()
    {
        $pic=showPic();
        $baby=showBaby();
        $new=showNews();
        $video=showVideo();
        $product=showProduct();
        $shop=showShop();

        $this->assign('pic',$pic);
        $this->assign('baby',$baby);
        $this->assign('new',$new);
        $this->assign('video',$video);
        $this->assign('product',$product);
        $this->assign('shop',$shop);
        return $this->fetch();
    }
}