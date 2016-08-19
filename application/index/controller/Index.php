<?php
namespace app\index\controller;
use app\index\controller\Base;
class Index extends Base
{
    public function index()
    {
       // $pic=showPic();
        $baby=showBaby();
        $new=showNews();
        $video=showVideo();
        $product=showProduct();
        $shop=showShop();

        //$this->assign('pic',$pic);
        $this->assign('baby',$baby);
        $this->assign('new',$new);
        $this->assign('video',$video);
        $this->assign('product',$product);
        $this->assign('shop',$shop);
        return $this->fetch();
    }
    public function search(){
        $data=input('');
        //dump($data);
        $key=$data['keywords'];
        if(empty($key)){
            $this->redirect('index/index');
        }else{
            $newList=searchArt('6',$key);
            $newcoun=count($newList);
            $newcate=getCategory('6');
            $this->assign('newcate',$newcate);
            $this->assign('newList',$newList);
            $this->assign('newcoun',$newcoun);
            
            $zsList=searchArt('7',$key);
            $zscoun=count($zsList);
            $zscate=getCategory('7');
            $this->assign('zscate',$zscate);
            $this->assign('zsList',$zsList);
            $this->assign('zscoun',$zscoun);

            $homeboyList=searchArt('9',$key);
            $homecoun=count($homeboyList);
            $homecate=getCategory('9');
            $this->assign('homecate',$homecate);
            $this->assign('homecoun',$homecoun);
            $this->assign('homeboyList',$homeboyList);

            $productList=searchPic('20',$key);
            $productcoun=count($productList);
            $productcate=getCategory('20');
            $this->assign('productcate',$productcate);
            $this->assign('productList',$productList);
            $this->assign('productcoun',$productcoun);

            $dpList=searchPic('23',$key);
            $dpcoun=count($dpList);
            $dpcate=getCategory('23');
            $this->assign('dpcate',$dpcate);
            $this->assign('dpList',$dpList);
            $this->assign('dpcoun',$dpcoun);

            $vidList=searchVid('31',$key);
            $vidcoun=count($vidList);
            $vidcate=getCategory('31');
            $this->assign('vidcate',$vidcate);
            $this->assign('vidList',$vidList);
            $this->assign('vidcoun',$vidcoun);

            return $this->fetch();
        }
       
    }
}