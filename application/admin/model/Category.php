<?php
namespace app\admin\model;

use think\Model;

class Category extends Model
{
    public function article()
    {
        return $this->hasOne('article','cid');
    }

    public function picture()
    {
        return $this->hasOne('picture','cid');
    }

    public function video()
    {
        return $this->hasOne('video','cid');
    }

    public function intro()
    {
        return $this->hasOne('intro','cid');
    }
}