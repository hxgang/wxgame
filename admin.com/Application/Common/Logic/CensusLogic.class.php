<?php
/**
 * Created by PhpStorm.
 * User: DELL
 * Date: 2017/9/7
 * Time: 15:29
 */
namespace Common\Logic;
use Think\Model;
class CensusLogic{


    /* 将开始日期与结束日期，格式为日期数组
    * 如：2014-11-01 - 2014-11-05
    * 格式化后为array( 20141101, 20141102, 20141103, 20141104, 20141105 );
    */
    public function formatDay( $start_day, $end_day ) {
        $start_time = strtotime( $start_day . ' 00:00:00' );
        $end_time = strtotime( $end_day. ' 23:59:59' );
        if($start_time == $end_time) $end_time+= 86400;
        if( $start_time > $end_time ) {
            return array();
        }
        $day_arr = array();
        do{
            //$day_arr[] = date( 'Ymd', $start_time );
            $day_arr[] = date( 'm月d日', $start_time );
            $start_time += 60 * 60 * 24;//下一天
        }while ( $start_time <= $end_time );

        return $day_arr;
    }

    /**
     * @desc 每月订单数
     */
    public function monthlOrder($date_start,$date_end){
        $model = M('order_info');
        $date_start_new = strtotime( $date_start . ' 00:00:00' );
        $date_end_new = strtotime( $date_end. ' 23:59:59' );
        if(!empty($date_start) && !empty($date_end)){
            $map['inputtime'] = array('between', array($date_start_new, $date_end_new));
        }
        $map['status'] =1;
        $res = $model->field('COUNT(`id`) AS count,inputtime,sum(real_amount) price ')->where($map)->group('inputtime')->select();
        $data_order   = array();
        $data_price   = array();
        $aData        = array();
        $aData_price  = array();
        $aData_order  = array();
        if($res){
            foreach($res as $val){
                $temp =date('m月d日',$val['inputtime']);
                $data_order[$temp] += $val['count'];
                $data_price[$temp] += $val['price'];
            }
        }
        $aData = $this->formatDay($date_start,$date_end);
        foreach($aData as $val){
            if(empty($data_order[$val])){
                $aData_order[$val]=0;
            }else{
                $aData_order[$val] = $data_order[$val];
            }
            if(empty($data_price[$val])){
                $aData_price[$val]=0;
            }else{
                $aData_price[$val] = $data_price[$val];
            }
        }
        unset($temp,$aData,$data_price,$data_order,$res);
        return array('order'=>$aData_order,'price'=>$aData_price);
    }

    /**
     * @desc 订单总数量和总金额
     */
    public function orderPriceNum($date_start,$date_end){
        $model = M('order_info');
        $date_start_new = strtotime( $date_start . ' 00:00:00' );
        $date_end_new = strtotime( $date_end. ' 23:59:59' );
        if(!empty($date_start) && !empty($date_end)){
            $map['inputtime'] = array('between', array($date_start_new, $date_end_new));
        }
        $map['status'] =1;
        $data = $model->where($map)->field('COUNT(id) num,SUM(real_amount) price')->find();//获取当前订单总数量和总金额
        return $data;
    }

    /**
     * @desc 获取订单总数量，总金额，总
     */
    public function getOrderPrice(){
        $field='COUNT(id) num,SUM(total_amount) total_amount ,
                SUM(discount_amount) discount_amount ,
                SUM(delivery_price) delivery_price,
                SUM(real_amount) real_amount';
        $map['status']=1;
        $data = M('order_info')->field($field)->where($map)->find();
        return $data;
    }

    /**
     * @desc 获取订单不同状态下的订单数量
     */
    public function getOrderNum(){
        $field=' COUNT(id) num ,shipping_status';
        $map['status'] =1;
        $data = M('order_info')->where($map)->group(shipping_status)->getField('shipping_status,COUNT(id) num');
        $data2 = M('order_info')->field($field)->where($map)->group(order_status)->getfield('order_status, COUNT(id) num');
        return array($data,$data2);
    }
}