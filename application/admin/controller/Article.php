<?php
namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Article as essay;
use app\admin\controller\Base;
use org\Upload;

class Article extends Base
{
     public function  _initialize(){
       $short=showShort(); 
       $this->assign('short', $short); 
    }
    public function index()
    {
        $data=input('');
        $cid=$data['cid'];
        $category= Category::find($cid);
        $where['cid']=$cid;
        $list=$category->article()->where($where)->paginate(5);  
        //dump($data);     
        $this->assign('category', $category);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function add()
    {
        if(request()->isPost()){
            $data = input('');
            $data['imgurl']=$this->upload();
            if(!$data['imgurl']){
                return $this->error('请选择图片');
            }
            if(isset($data['ishome'])){
                $data['ishome']='是';
            }else{
                $data['ishome']='否';
            }
            //dump($data);
            $status = essay::insert($data);
            if($status){
                return $this->success('添加成功',url('article/index',['cid'=>$data['cid']]));
            }else{
                return $this->error('添加失败,请重试或是联系技术支持');
            }
        }else{
            $cid = input('cid');
            $category=Category::find($cid);
            $time=date("Y-m-d\TH:i") ;
            //dump($time);
            $this->assign('category', $category);
            $this->assign('time', $time);
            return $this->fetch();
        } 
    }

    public function update()
    {
        if(request()->isPost()){
            $data = input('');
            $data['imgurl']=$this->upload();
            if($data['imgurl']){
                unset($data['eximgurl']);
            }else{
                $data['imgurl']=$data['eximgurl'];
                unset($data['eximgurl']);
            }
           
            if(isset($data['ishome'])){
                if($data['exishome']=="是"){
                    $data['ishome']='否';
                }else{
                    $data['ishome']='是';
                }
                 unset($data['exishome']);
            }else{
                $data['ishome']=$data['exishome'];
                unset($data['exishome']);
            }                
            $cid=$data['cid'];
            $id=$data['id'];
            //dump($data);
            $status = essay::where('id',$id)->update($data);
            if($status){
                return $this->success('更新成功',url('article/index',['cid'=>$cid]));
            }else{
                return $this->error('更新失败,请重试或是联系技术支持');
            }
        }else{
            
            $cid = input('cid');
            $id=input('id');
            $category=Category::find($cid);
            $list=$category->article()->where('id',$id)->find();
            $time=date("Y-m-d\TH:i",strtotime($list['createDate'])) ;
            //dump($time);
            $this->assign('category', $category);
            $this->assign('list', $list);
            $this->assign('time', $time);
            return $this->fetch();
        } 
    }

     public function details(){
            $id=input('id');
            $cid=input('cid');
            $category=Category::find($cid);;
            $list = $category->article()->where(['id' => $id])->find();
            //dump($category);
            $this->assign('list', $list);  
            $this->assign('category', $category);  
            return $this->fetch();
    }

        public function delect(){
            $id=input('id');
            $cid=input('cid');
            $status = essay::where(['id' => $id])->delete();
            if($status){
                return $this->success('删除成功',url('article/index',['cid'=>$cid]));
            }else{
                return $this->error('删除失败,请重试或是联系技术支持');
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