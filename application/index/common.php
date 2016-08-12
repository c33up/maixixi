<?php
use app\index\model\Category;

function showPic(){
    $category=Category::find('21');
    $list=$category->picture()->where('cid',21)->select();
    return $list;
}

function showBaby(){
    $category=Category::find('32');
    $list=$category->video()->where('cid','32')->select();
    return $list;
}

function showNews(){
    $where['cid']='6';
    $where['ishome']='是';
    $category=Category::find('6');
    $list=$category->article()->where($where)->select();
    return $list;
}


function showVideo(){
    $where['cid']='31';
    $where['ishome']='是';
    $category=Category::find('31');
    $list=$category->video()->where($where)->select();
    return $list;
}

function showProduct(){
    $where['cid']='20';
    $category=Category::find($where);
    $list=$category->picture()->where($where)->select();
    return $list;
}

function showShop(){
    $where['cid']='23';
    $category=Category::find($where);
    $list=$category->picture()->where($where)->select();
    return $list;
}
