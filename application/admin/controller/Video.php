<?php
namespace app\admin\controller;
use app\admin\model\Category;
use app\admin\model\Video as vid;
use app\admin\controller\Base;
use org\Upload;

class Video extends Base
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
        $list = $category->video()->where($where)->paginate(12);
        //dump($list->render());
        $this->assign('list', $list);
        $this->assign('category', $category);
        $this->assign('empty','<h1 style="text-align: center;">暂时没有数据</h1>');     
        return $this->fetch();
    }

    public function search()
    {
         $key=input('key');
        if(empty($key)){
           $list=vid::select();  
        }else{
           $where['title|intro']=['like','%'.$key.'%'];
           $list=vid::where($where)->select();  
        }
        
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function add()
    {
        if (request()->isPost()) {

                $data = input('post.');
                $data['imgurl'] = $this->uploadimg();
                if(!$data['imgurl']){
                    return $this->error('请选择图片');
                }
                $cid=$data['cid'];
                $flag=$data['flag'];
                if($flag=='1'){
                    $data['vidurl'] = $this->uploadvid();
                    if(!$data['vidurl']){
                        return $this->error('请选择上传视频');
                    }
                }
                if(isset($data['ishome'])){
                    $data['ishome']='是';
                }else{
                    $data['ishome']='否';
                }
                //dump($data);
                $status = vid::insert($data);
                if($status){
                    return $this->success('添加成功',url('video/index',['cid'=>$cid]));
                }else{
                    return $this->error('添加失败,请重试或是联系技术支持');
                }

        } else {
           
            $cid=input('cid');
            $category= Category::find($cid);
            $time=date("Y-m-d\TH:i") ;
            $this->assign('category', $category);
            $this->assign('time', $time);
            return $this->fetch();
        }
    }

    public function update()
    {
        if (request()->isPost()) {
                $data = input('post.');
                
                $data['imgurl'] = $this->uploadimg();
                if(!$data['imgurl']){
                    $data['imgurl']=$data['eximgurl'];
                    unset($data['eximgurl']);
                }else{
                    unset($data['eximgurl']);
                }

                 $cid=$data['cid'];
                 $flag=$data['flag'];
                 if($flag=='1'){
                    $data['vidurl'] = $this->uploadvid();
                    if(!$data['vidurl']){
                       $data['vidurl']=$data['exvidurl'];
                        unset($data['exvidurl']);
                    }else{
                        unset($data['exvidurl']);
                    }
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
                $id=$data['id'];
                //dump($data);   
                $status = vid::where('id',$data['id'])->update($data);
                if($status){
                    return $this->success('更新成功',url('video/index',['cid'=>$cid]));
                }else{
                    return $this->error('更新失败,请重试或是联系技术支持');
                }

        } else {
            $id=input('id');
            $cid=input('cid');
            $category=Category::find($cid);;
            $list = $category->video()->where(['id' => $id])->find();
            $time=date("Y-m-d\TH:i",strtotime($list['createDate'])) ;
            //dump($category);
            $this->assign('list', $list);  
            $this->assign('category', $category);
            $this->assign('time', $time);  
            return $this->fetch();

        }
    }

    public function uploadimg(){
        $file = request()->file('imgurl');
        if($file){
            $config = [
                'maxSize'      => 20480000,
                'exts'         => ['jpg','gif','png','jpeg'],
                'subName'      => ['date', 'Ymd'],
                'rootPath'     => config('uploadvid_dir'),
                'savePath'     => '/images/',
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

        public function uploadvid(){
        $file = request()->file('vidurl');
        if($file){
            $config = [
                'maxSize'      => 20480000,
                'exts'         => ['mp4','avi','wmv','rmvb'],
                'subName'      => ['date', 'Ymd'],
                'rootPath'     => config('uploadvid_dir'),
                'savePath'     => '',
                'driver'       => 'Local',
            ];
         
            $uploader = new Upload($config);
            $info = $uploader->upload();
            if(!$info){
                $this->error($uploader->getError());
            }else{
           
                $video =$info['vidurl']['savepath'].$info['vidurl']['savename'];
                return $video;
            }
        }else{
            return FALSE;
        }
            
    }

    public function details(){
            $id=input('id');
            $cid=input('cid');
            $category=Category::find($cid);;
            $list = $category->video()->where(['id' => $id])->find();
            //dump($category);
            $this->assign('list', $list);  
            $this->assign('category', $category);  
            return $this->fetch();
    }

    public function delect(){
            $id=input('id');
            $cid=input('cid');
            $status = vid::where(['id' => $id])->delete();
            if($status){
                return $this->success('删除成功',url('video/index',['cid'=>$cid]));
            }else{
                return $this->error('删除失败,请重试或是联系技术支持');
            }
    }
}