<?php
/**
 * Created by PhpStorm.
 * User: ying
 * Date: 2015/11/8
 * Time: 22:20
 */

namespace Admin\Model;


use Think\Model;

class GoodsAlbumModel extends Model
{
    /**
     * 根据商品id去商品相册中查询相册的id和路径
     * @param $goods_id
     * @return mixed
     */
    public  function getAlbumByGoodsId($goods_id){
        return $this->where(array('goods_id'=>$goods_id))->select();
    }
}