<?php
namespace Admin\Controller;


use Think\Controller;
use Think\Page;

class CommentController extends Controller
{
    public function index(){
        $count=M('comment')->where(array('status'=>1))->count();
        $pager=new Page($count,20);
        $rows=M('comment')->alias('c')->join('LEFT JOIN __MEMBER__ AS m ON m.id=c.member_id')->join('LEFT JOIN __ORDER_INFO__ AS oi ON oi.id=c.order_id')
            ->field('c.*,m.username,oi.sn')->order('c.id','desc')->where(array('c.status'=>1))->limit($pager->firstRow.','.$pager->listRows)->select();

        $pageHTML=$pager->show();
        $this->assign('rows',$rows);
        $this->assign('pageHTML',$pageHTML);
        $this->display();
    }


    public function detail(){
        $comment_id=I('get.id','','int');

        $rows=M('comment')->alias('c')->join('LEFT JOIN __MEMBER__ AS m ON m.id=c.member_id')->join('LEFT JOIN __ORDER_INFO__ AS oi ON oi.id=c.order_id')
            ->field('c.*,m.username,oi.sn')->order('c.id','desc')->where(array('c.status'=>1,'c.id'=>$comment_id))->find();
        $this->assign('rows',$rows);
        $this->display('detail');
    }

    public function replay(){
        $id=I('post.id','','int');
        $replay=I('post.replay','','strip_tags');
        $rst=M('comment')->where(array('id'=>$id))->save(array('replay'=>$replay));
        if($rst){
            $result['status']=1;
            $result['info']='成功';
        }else{
            $result['status']=0;
            $result['info']='失败';
        }
        $result['url']=U('Comment/Index');
        $this->ajaxReturn($result);
    }

    public function changeStatus($id, $status = -1)
    {
        $data = array('status' => $status);
        $wheres = array('id' => array('in', $id));
        $rst=M('Comment')->where($wheres)->save($data);
        if ($rst) {
            $result['status']=1;
            $result['info']='成功';
        } else {
            $result['status']=0;
            $result['info']='失败';
        }
        $result['url']=U('Comment/Index');
        $this->ajaxReturn($result);
    }
}