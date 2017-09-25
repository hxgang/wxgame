<?php
/**
 * Created by PhpStorm.
 * User: dy
 * Date: 2016/5/23
 * Time: 22:32
 */
namespace Admin\Controller;
use Think\Controller;

class OrderInfoController extends BaseController
{
    //展示订单信息
    public function index(){
        $where=array();
        if(IS_GET){
            $order_sn=trim(I('order_sn'));
          //  $receiver=I('post.receiver');
            $pay_status     =I('pay_type');
            $shipping_status=I('shipping_status');
            $order_status   =I('order_status');
            $keywords       =I('keywords','','strip_tags');
            if(!empty($keywords)){
                $where['goods_name']=array('like','%'.$keywords.'%');
            }
            //订单号
            if(!empty($order_sn)){
                $where['sn']=array('eq',$order_sn);
            }
            //支付状态
            if($pay_status != -99 && !empty($pay_status)){
                $where['pay_type']=array('eq',$pay_status);
            }
            //发货状态
            if($shipping_status != -99 && !empty($shipping_status)){
                $where['shipping_status']=array('eq',$shipping_status);
            }
            //订单状态
            if($order_status != -99  && !empty($order_status)){
                $where['order_status']=array('eq',$order_status);
            }
        }
        $orders= D('OrderInfo')->getOrderInfoList($where);
        $this->assign(get_defined_vars());
        $this->display('index');
    }
    //详情
    public function edit($id){
//        echo $id;
        $model=D('OrderInfo');
        $rst= $model->getList($id);
        $this->assign('orders',$rst['orders']);
       // $this->assign('infos',$rst['infos']);
        $this->display('edit');
    }

    //改变物流状态
    public function change(){
        $shipping_status=I('post.shipping_status','','int'); //物流状态
        $order_id=I('post.order_id','','int');
        $model=D('OrderInfo');
       $rst= $model->change($shipping_status,$order_id);
        if($rst){
            $result['status']=1;
            $result['info']='状态设置成功';
        }else{
            $result['status']=0;
            $result['info']='状态设置失败';
        }
        $result['url']=U('index');
        $this->ajaxReturn($result);
    }
    public function change2(){
        $pay_status=I('post.pay_status','','int'); //物流状态
        $order_id=I('post.order_id','','int');
        $model=D('OrderInfo');
        $rst= $model->change2($pay_status,$order_id);
        if($rst){
            $result['status']=1;
            $result['info']='状态设置成功';
        }else{
            $result['status']=0;
            $result['info']='状态设置失败';
        }
        $result['url']=U('OrderInfo/index');
        $this->ajaxReturn($result);
    }

    /**
     * @desc  添加快递单号
     */
    public function addShippingData(){
        $type= I('post.type');
        if($type==1){
            $post_data = I('sn');
            $map['id'] = I('id');
            $save_data['shipping_sn']    =$post_data[0] ;
            $save_data['delivery_price'] =$post_data[1] ;
            if(!is_numeric( $save_data['shipping_sn'])){
                $data['code']   =0;
                $data['message']='发货快递单号格式不正确';
                $this->ajaxReturn($data);
            }
            if(!is_numeric( $save_data['delivery_price'])){
                $data['code']   =0;
                $data['message']='发货邮费格式不正确';
                $this->ajaxReturn($data);
            }
            if($post_data[2]) $save_data['info'] =$post_data[2] ;
            $save_data['shipping_sn_ctime'] = NOW_TIME;
            $res = D('OrderInfo')->where($map)->save($save_data);
            $save_data_status['shipping_status'] =2;//已发货
            $res_status = D('OrderInfo')->where($map)->save($save_data_status);
        }
        if($type==2){
            $post_data = I('sn');
            $map['id'] = I('id');
            if($post_data) $save_data['info'] =$post_data ;
            $res = D('OrderInfo')->where($map)->save($save_data);
            $save_data_status['order_status'] =1;//签收
            $res_status = D('OrderInfo')->where($map)->save($save_data_status);
        }
        if($type==3){
            $post_data = I('sn');
            $map['id'] = I('id');
            if($post_data) $save_data['info'] =$post_data ;
            $res = D('OrderInfo')->where($map)->save($save_data);
            $save_data_status['order_status'] =3;//拒签
            $res_status = D('OrderInfo')->where($map)->save($save_data_status);
        }
        if($type==1){
            $message = '发货成功';
        }
        if($type==2){
            $message = '签收成功';
        }
        if($type==3){
            $message = '成功';
        }
        if($res!==fasle){
            $data['code']=1;
            $data['message']=$message;
            $data['url']    =U('index');
        }else{
            $data['code']=0;
            $data['message']='失败';
        }

        $this->ajaxReturn($data);

    }

    //改变收货状态之退货
    public function back(){
        $order_id=I('post.order_id','','int');
        $order_status=I('post.order_status','','int');// 收货状态
        $model=D('OrderInfo');
        $rst= $model->back($order_status,$order_id);
        if($rst){
            $result['status']=1;
            $result['info']='成功';
        }else{
            $result['status']=0;
            $result['info']='失败';
        }
        $result['url']=U('OrderInfo/index');
        $this->ajaxReturn($result);
    }

    /**
     * 修改状态。（移除和修改是否显示）
     * @param $id
     * @param int $status
     */
    public function changeStatus($id, $status = -1)
    {
        $res = $this->model->changeStatus($id,$status);
        if($res !==false){
            $data['message'] ='删除成功';
            $data['code'] ='1';
            $data['url'] =U('OrderInfo/index');
        }else{
            $data['message'] ='删除失败';
            $data['code'] ='0';
        }
        $this->ajaxReturn($data);
    }
}