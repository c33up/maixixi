<?php
use app\admin\model\Category;
function showShort(){
       $category=Category::select(); 
       return $category;
}
