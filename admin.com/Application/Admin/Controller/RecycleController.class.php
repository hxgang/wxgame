<?php
namespace Admin\Controller;

use Think\Controller;

class RecycleController extends Controller
{
    protected $meta_title = "回收站";

    public function index(){
        //读取数据
        $goods=M('Goods')->where(array('status'=>-1))->select();
        $this->assign('rows',$goods);
        $this->display();
    }

    public function changeStatus(){
        $goods_id=I('get.id','','int');
        $status=I('get.status','','int');
        //名字换掉
       $name= M('goods')->where(array('id'=>$goods_id))->getField('name');
//        dd($name);
//        exit;
        if(!empty($name)){
            $name=explode('_',$name);
            $name=$name[0];
        }
       $rst= M('goods')->where(array('id'=>$goods_id))->save(array('status'=>$status,'name'=>$name));
        if($rst){
            $result['status']=1;
            $result['info']="成功";
        }else{
            $result['status']=0;
            $result['info']="失败";
        }
        $result['url']=U('Recycle/index');
        $this->ajaxReturn($result);
    }

    public function delete(){
        $goods_id=I('get.id','','int');
        $rst= M('goods')->where(array('id'=>$goods_id))->delete();
        if($rst){
            $result['status']=1;
            $result['info']="成功";
        }else{
            $result['status']=0;
            $result['info']="失败";
        }
        $result['url']=U('Recycle/index');
        $this->ajaxReturn($result);
    }
}