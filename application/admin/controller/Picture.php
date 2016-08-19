<?php
namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Picture as pict;
use app\admin\controller\Base;
use org\Upload;

class Picture extends Base
{
    public function  _initialize(){
       $short=showShort(); 
       $this->assign('short', $short); 
    }
    public function index()
    {
        $cid=input('cid');
        $category= Category::find($cid);
        $list = $category->picture()->where(['cid' => $cid])->select();
        //dump($list);
        $this->assign('list', $list);
        $this->assign('category', $category);
        $this->assign('empty','<h1 style="text-align: center;">暂时没有数据</h1>');     
        return $this->fetch();
    }


    public function add()
    {
        if (request()->isPost()) {

                $data = input('post.');
                $data['imgurl'] = $this->upload();
                if(!$data['imgurl']){
                    return $this->error('请选择图片');
                }
                $cid=$data['cid'];
                //dump($data);
                $status = pict::insert($data);
                if($status){
                    return $this->success('添加成功',url('picture/index',['cid'=>$cid]));
                }else{
                    return $this->error('添加失败,请重试或是联系技术支持');
                }

        } else {
           
            $cid=input('cid');
            $category= Category::find($cid);
            $this->assign('category', $category);
            return $this->fetch();
        }
    }

    public function update()
    {
        if (request()->isPost()) {
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
                $id=$data['id'];
                //dump($data);
                $cid=$data['cid'];
                $status = pict::where('id',$data['id'])->update($data);
                if($status){
                    return $this->success('更新成功',url('picture/index',['cid'=>$cid]));
                }else{
                    return $this->error('更新失败,请重试或是联系技术支持');
                }

        } else {
             $id=input('id');
            $cid=input('cid');
            $category=Category::find($cid);;
            $list = $category->picture()->where(['id' => $id])->find();
            
            //dump($category);
            $this->assign('list', $list);  
            $this->assign('category', $category);  
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

    public function details(){
            $id=input('id');
            $cid=input('cid');
            $category=Category::find($cid);;
            $list = $category->picture()->where(['id' => $id])->find();
            //dump($category);
            $this->assign('list', $list);  
            $this->assign('category', $category);  
            return $this->fetch();
    }

    public function delect(){
            $id=input('id');
            $cid=input('cid');
            $category=Category::find($cid);;
            $list = $category->picture()->where(['id' => $id])->find();
            $imgurl=ROOT_PATH . 'public/uploads/images/'.$list['imgurl'];
            //dump($imgurl);
            if(file_exists($imgurl)){
               unlink($imgurl); 
            }
            
            $status = $category->picture()->where(['id' => $id])->delete();
            if($status){
                return $this->success('删除成功',url('picture/index',['cid'=>$cid]));
            }else{
                return $this->error('删除失败,请重试或是联系技术支持');
            }
    }

}