<?php
namespace app\index\controller;

use app\index\controller\Base;
use app\index\model\Contact as ct;
use app\index\model\Message;
use think\Validate;

class Contact extends Base
{

    public function index()
    {
        $list=ct::where('id','1')->find();
        $this->assign('list',$list);

        $twopic=showPic('22');
        $this->assign('twopic',$twopic);
        return $this->fetch();
    }

    public function addmeg(){
        $data=input('post.');
         $rule = [
                ['NickName','require|max:25','用户名不能为空|用户名最多不能超过25个字符'],
                ['Tel','require|number','联系电话不能为空|请正确填写联系电话'],
                ['Email','require|email','Email不能为空|请正确填写Email']
            ];

            $validate = new Validate($rule);
            $result   = $validate->check($data);
            if($result){
                 //dump($data);
               $status=Message::insert($data);
               //return $this->fetch('index');
                echo "<script type='text/javascript'>alert('谢谢你的留言！');window.location.href = '".url('contact/index')."'; </script>";
            }else{
                echo "<script type='text/javascript'>alert('".$validate->getError()."');window.location.href = '".url('contact/index')."'; </script>";
             
            }

       // $status=Message::insert($data);
        //return $this->fetch('index');
    }
}