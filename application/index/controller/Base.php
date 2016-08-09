<?php
namespace app\index\controller;
use think\Controller;
class Base extends Controller
{
    public function index()
    {
        header("Content-type: text/html; charset=utf-8");
    }
}
