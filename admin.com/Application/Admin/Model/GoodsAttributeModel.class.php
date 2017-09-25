<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/24
 * Time: 9:36
 */

namespace Admin\Model;


use Think\Model;

class GoodsAttributeModel extends Model
{

    public function getGoodsAttributeByGoodsId($goods_id){
        $rows = $this->field('attribute_id,value')->where(array('goods_id'=>$goods_id))->select();
        $tempRows = array();
        /**
         * 将rows中的数据变为:
         * array(
        attribute_id=>array('')
        )
         * 例如:
         * array(
        1 =>array('红色','蓝色'),
        2 =>array('S','M'),
        3 =>array(真丝),
        4  =>array('大裙子'),
        5  =>array('2015');
        );
         */
        foreach($rows as $row){
            $tempRows[$row['attribute_id']][] = $row['value'];
        }
        return $tempRows;
    }
}