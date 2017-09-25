<?php
namespace Api\Model;

use Think\Model;

class GoodsModel extends Model
{
    /**
     * @return mixed
     */
    public function getGoodsList()
    {
        $infos = $this->field('id,name,shop_price,logo,keyword,stock')->where(['status' => 1])->order('sort')->select();
        if (!empty($infos)) {
            $ids = array_column($infos, 'id');
            //¸÷ÉÌÆ·µÄÏúÊÛÁ¿
            $totals = D('OrderInfo')->getTotalById($ids);
            foreach ($infos as &$v) {
                $v['logo'] = "http://" . C('admin_domain') . $v['logo'];
                $v['sales'] = $totals[$v['id']] ? $totals[$v['id']] : 100;
            }
        }
        return empty($infos) ? array() : $infos;
    }

    /**
     * @param $goods_id
     * @return mixed
     */
    public function  getInfoByGoodsId($goods_id)
    {
        return $this->where(['id' => $goods_id])->field('shop_price,name')->find();
    }

    /**
     *  详情页信息
     * @param  [type] $goods_id [description]
     * @return [type]           [description]
     */
    public function  getDetailByGoodsId($goods_id)
    {
        return $this->where(['id' => $goods_id])->field('video_url,detail,shop_price,name,id')->where(['status' => 1])->find();
    }
}