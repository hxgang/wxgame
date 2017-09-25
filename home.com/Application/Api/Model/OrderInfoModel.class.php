<?php
namespace Api\Model;

use Think\Model;

class OrderInfoModel extends Model
{

    public function getOrders($member_id)
    {

        if (!$member_id) return array();

        $where = array(
            'member_id' => $member_id
        );
        $orders = $this->field('goods_name,goods_num,shipping_status,shipping_sn as deliver')
            ->where(['member_id' => $member_id])->select();
        if (!empty($orders)) {
            foreach ($orders as $key => &$order) {
                switch ($order['shipping_status']) {
                    case '0':
                        $order['status'] = '待发货';
                        break;
                    case '1':
                        $order['status'] = '配货中';
                        break;
                    case '2':
                        $order['status'] = '已发货';
                        break;
                }
            }
        }

        return $orders;
    }

    /**
     * 保存订单
     * @param $data
     * @return mixed
     */
    public function storeOrderInfo($data)
    {
        $rst = $this->add($data);
        return $rst;
    }

    /**
     * 统计已下单个数
     * @param $id 数组或者单个id
     * @return array
     */
    public function getTotalById($id)
    {
        $id = is_array($id) ? implode(',', $id) : $id;
        $info = $this->where(['goods_id' => array('in', $id)])->group('goods_id')->field('goods_id,count(goods_id) as count')->select();
        if (!empty($info)) {
            $key = array_column($info, 'goods_id');
            $value = array_column($info, 'count');
            return array_combine($key, $value);
        } else {
            return array();
        }

    }

}