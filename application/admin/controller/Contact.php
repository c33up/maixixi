<?php
namespace app\admin\controller;
use app\admin\model\Contact as ct;
use app\admin\model\Category;
use app\admin\controller\Base;
use org\Upload;

class Contact extends Base
{
    public function  _initialize(){
        $category=Category::find('40');
       $short=showShort(); 
       $this->assign('short', $short); 
        $this->assign('category', $category); 
    }
    public function index()
    {
        $list=ct::select();
        $count=ct::count();
        //dump($list);
        $this->assign('list', $list);
        $this->assign('count', $count);
        $this->assign('empty','<tr><td><h1 style="text-align: center;">暂时没有数据</h1></td></tr>');
        return $this->fetch();
    }

    public function add()
    {
       if(request()->isPost()){
            $data = input('post.');
            $data['imgurl'] = $this->upload();
            if(!$data['imgurl']){
                //return $this->error('请选择图片');
            }
            $status = ct::insert($data);
            if($status){
                return $this->success('添加成功',url('contact/index'));
            }else{
                return $this->error('添加失败,请重试或是联系技术支持');
            }

            
        }else{
            return $this->fetch();
        }
    }

     public function update()
    {
       if(request()->isPost()){
            $data = input('post.');
            $data['imgurl'] = $this->upload();
            if(!$data['imgurl']){
                $data['imgurl']=$data['eximgurl'];
                unset($data['eximgurl']);
            }else{
                $imgurl=ROOT_PATH . 'public/uploads/images/'.$data['eximgurl'];
                if(file_exists($imgurl)){
                    unlink($imgurl); 
                }
                unset($data['eximgurl']);
            }

            $status = ct::where('id','1')->update($data);
            if($status){
                return $this->success('更新成功',url('contact/index'));
            }else{
                return $this->error('更新失败,请重试或是联系技术支持');
            }  
        }else{
            $list=ct::where('id','1')->find();
             $this->assign('list', $list);
            return $this->fetch();
        }
    }

        public function upload(){
        $file = request()->file('imgurl');
        if($file){
            $config = [
                'maxSize'      => 20480000,
                'exts'         => ['jpg','gif','png','jpeg'],
                'subName'      => ['date', 'Ymd'],
                'rootPath'     => config('uploader_dir'),
                'savePath'     => '',
                'driver'       => 'Local',
            ];
         
            $uploader = new Upload($config);
            $info = $uploader->upload();
            if(!$info){
                $this->error($uploader->getError());
            }else{
           
                $image =$info['imgurl']['savepath'].$info['imgurl']['savename'];
                return $image;
            }
        }else{
            return FALSE;
        }
            
    }
}