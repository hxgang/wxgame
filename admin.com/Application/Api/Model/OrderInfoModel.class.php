<?php
namespace Api\Model;

use Think\Model;

class OrderInfoModel extends Model
{

   public function getOrders($member_id){

   	   if(!$member_id) return array();

   		$where = array(
   			'member_id' => $member_id
   		); 
   		$orders = $this->field('goods_name,goods_num,shipping_status,shipping_sn as deliver')
			      ->where(['member_id'=>$member_id])->select();
         if(!empty($orders)){
               foreach ($orders as $key => &$order) {
                  switch($order['shipping_status']){
                     case '0': $order['status']  = '待发货'; break;
                     case '1': $order['status']  = '配货中'; break;
                     case '2': $order['status']  = '已发货'; break;
                  }
               }
         }
         
   		return $orders;
   }

   public function storeOrderInfo($data){
   		$rst = $this->add($data);
         // echo $this->_sql();

         return $rst;
   }
}