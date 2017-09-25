<?php
namespace Admin\Model;

use Think\Model;
use Think\Page;

class OrderInfoModel extends BaseModel
{
    protected $page_size=10;
    //展示
    public function getOrderInfoList($where=array()){
        $where['status']=array('gt',-1);
        //所有订单
        $orders=$this->where($where)->order('id desc')->select();
        return empty($orders)?array():$orders;
    }

    public function getList($order_id){
        $orders=$this->alias('oi')->join('member as m on m.id=oi.member_id','left')->field('oi.*,m.username')->where(array('oi.id'=>$order_id))->find();
        return array(
            'orders'=>$orders,
        );
    }

    //改变发货状态
    public function change($shipping_status,$order_id){
        return $this->where(array('id'=>$order_id))->save(array('shipping_status'=>$shipping_status));
    }

    //改变收货状态
    public function change2($pay_status,$order_id){
        return $this->where(array('id'=>$order_id))->save(array('pay_status'=>$pay_status));
    }
    //改变收货状态
    public function back($order_status,$order_id){
        return $this->where(array('id'=>$order_id))->save(array('order_status'=>$order_status));
    }

    /**
     * 根据id去改变一条数据的状态。
     * @param $id
     * @param $status
     */
    public function changeStatus($id, $status)
    {
        $data = array('status' => $status);
        $wheres = array('id' => array('in', $id));
        return $res =  $this->where($wheres)->save($data);
    }
}