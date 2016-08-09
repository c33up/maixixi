<?php
namespace app\index\controller;

use app\index\controller\Base;
use think\Db;

class Index extends Base
{
    public function index()
    {
        $data = Db::name('user')->find();
        dump($data);
        //$this->assign('result', $data);
        //return $this->fetch();
    }
}