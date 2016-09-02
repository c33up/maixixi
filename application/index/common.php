<?php
use app\index\model\Category;
use app\index\model\Article;
use app\index\model\Video;
use app\index\model\Picture;
use app\index\model\Contact;

function showPic($cid){
    $where['cid']=$cid;
    $category=Category::find($cid);
    $list=$category->picture()->where($where)->select();
    return $list;
}

function showBaby(){
    $category=Category::find('32');
    $list=$category->video()->where('cid','32')->order('id desc')->select();
    return $list;
}

function showNews(){
    $where['cid']='6';
    $where['ishome']='是';
    $category=Category::find('6');
    $list=$category->article()->where($where)->order('id desc')->select();
    return $list;
}


function showVideo(){
    $where['cid']='31';
    $where['ishome']='是';
    $category=Category::find('31');
    $list=$category->video()->where($where)->order('id desc')->select();
    return $list;
}

function showProduct(){
    $where['cid']='20';
    $category=Category::find($where);
    $list=$category->picture()->where($where)->order('id desc')->select();
    return $list;
}

function showShop(){
    $where['cid']='23';
    $category=Category::find($where);
    $list=$category->picture()->where($where)->order('id desc')->select();
    return $list;
}

function showContact(){
    $where['id']='1';
    $list=Contact::where($where)->find();
    return $list;
}

function getCategory($cid){
    $where['cid']=$cid;
    $category=Category::find($where);
    return $category;
}

function getArticle($cid){
    $where['cid']=$cid;
    $category=Category::find($where);
    $list=$category->article()->where($where)->order('id desc')->paginate(8);
    return $list;
}

function getArtDetail($id){
    $where['id']=$id;
    $list=Article::where($where)->find();
    return $list;
}

function getVideo($cid){
    $where['cid']=$cid;
    $category=Category::find($where);
    $list=$category->video()->where($where)->order('id desc')->paginate(12);
    return $list;
}

function getVidDetail($id){
    $where['id']=$id;
    $list=Video::where($where)->find();
    return $list;
}

function getPicture($cid){
    $where['cid']=$cid;
    $category=Category::find($where);
    $list=$category->picture()->where($where)->order('id desc')->paginate(8);
    return $list;
}


function searchArt($cid,$key){
    $where['cid']=$cid;
    $where['title|intro|content']=['like','%'.$key.'%'];
    $category=Category::find($cid);
    $list=$category->article()->where($where)->select();
    return $list;
}

function searchVid($cid,$key){
    $where['cid']=$cid;
    $where['title|intro']=['like','%'.$key.'%'];
    $category=Category::find($cid);
    $list=$category->video()->where($where)->select();
    return $list;
}

function searchPic($cid,$key){
    $where['cid']=$cid;
    $where['title']=['like','%'.$key.'%'];
    $category=Category::find($cid);
    $list=$category->picture()->where($where)->select();
    return $list;
}