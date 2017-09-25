<?php
namespace Api\Model;

use Think\Model;

class GoodsModel extends Model
{
	/**
	 * ��ȡ��Ʒ�б�
	 * @return mixed
	 */
	public function getGoodsList(){
		$infos = $this->field('id,name,shop_price,logo,keyword,stock')->where(['status' => 1])->order('sort')->select();
		$infos = array_map(function($v){
			$v['logo'] = "http://".$_SERVER['HTTP_HOST']."/Uploads/".$v['logo'];
			return $v;
		},$infos);
		return $infos;
	}

	/**
	 * �õ���Ʒ��Ϣ
	 * @param $goods_id
	 * @return mixed
	 */
	public  function  getInfoByGoodsId($goods_id){
		return $this->where(['id'=>$goods_id])->field('shop_price,name')->find();
	}
}