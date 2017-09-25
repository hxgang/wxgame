<?php
/**
 * Created by PhpStorm.
 * User: ying
 * Date: 2015/11/10
 * Time: 16:28
 */

namespace Admin\Model;


use Think\Model;

class GoodsMemberPriceModel extends Model
{
    public function getGoodsMemberPrice($goods_id){
        $rows=$this->where(array('goods_id'=>$goods_id))->field("member_level_id,price")->select();
        $member_level_ids=array_column($rows,'member_level_id'); //得到数组中某个键值的值
        $prices=array_column($rows,'price');
        return array_combine($member_level_ids,$prices);// 把前一个数组的值作为键名，后一个数组的值作为键值
    }
}