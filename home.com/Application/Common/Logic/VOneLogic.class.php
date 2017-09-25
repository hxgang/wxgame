<?php
namespace Common\Logic;
class VOneLogic
{
    private $maxAmount = 30;  //最大抵扣金额


    private function getOpenid()
    {
      //  return 'opkvDw_22rZycZL5KSOpXC7GQhgM';
        return D("Common/WeixinAuth")->getOpenId();
    }

    /**
     * 判定是否直接显示游戏页面
     * @param $params
     * @return array error_code=0 失败, err_code =1 开始游戏 err_code 2 显示金额页面
     */
    public function isStart()
    {
        header('Access-Control-Allow-Origin: *');
        $result = array('err_code' => 0, 'msg' => '一花一世界，一叶一菩提');
        //查找用户
        $open_id = $this->getOpenid();
        $member_info = D('Api/Member')->isMember($open_id);
        if (empty($member_info)) {
            $result['msg'] = '没有识别到您的身份呢,难道不是地球猿！';
            return $result;
        }
        $orders = D('Api/OrderInfo')->getOrders($member_info['id']);
        if (empty($orders) && !floatval($member_info['amount']) && !$member_info['share']) {
            $result['err_code'] = 1;
            $result['msg'] = '开始游戏';
        } else {
            $result = array(
                'err_code' => 2,
                'msg' => 'ok',
                'member_info' => $member_info,
                'orders' => $orders
            );
        }
        return $result;
    }

    /**
     *  保存用户金额
     * @param $params
     * @return array err_code =0 失败 err_code =1 成功
     */
    public function storeAmount($params)
    {
        header('Access-Control-Allow-Origin: *');
        $result = array('err_code' => 0, 'msg' => '一花一世界，一叶一菩提');
        $open_id = $this->getOpenid();
        $member_info = D('Api/Member')->isMember($open_id);
        if (empty($member_info)) {
            $result['msg'] = '没有识别到您的身份呢,难道不是地球猿！';
            return $result;
        }
        if (isset($params['amount']) && !$params['amount']) {
            $result['err_code'] = 2;
            $result['msg'] = '还没有准备好吗？';
        } else if (isset($params['amount']) && $params['amount']) {
            $params['openid'] = $open_id;
            $rst = D('Api/Member')->storeAmount($params);
            if ($rst) {
                $result['err_code'] = 1;
                $result['msg'] = '成功';
            } else {
                $result['msg'] = '未能放进钱袋,请刷新重试';
            }
        }
        return $result;
    }

    /**
     * 获取商品信息
     * @return mixed
     */
    public function getGoodsList()
    {
        header('Access-Control-Allow-Origin: *');
        $goods_info = D('Api/Goods')->getGoodsList();
        return $goods_info;
    }

    /**
     * 下单
     * @param $params
     * @return array err_code  = 0 失败 err_code =1 成功
     */
    public function create($params)
    {
        header('Access-Control-Allow-Origin: *');
        $result = array('err_code' => 0, 'msg' => '下单失败');
        $open_id = $this->getOpenid();
        $info = D('Api/Member')->isMember($open_id, 'id,amount');
        if (empty($info)) {
            $result['msg'] = '没有识别到您的身份呢,难道不是地球猿！';
            return $result;
        }
        //验证参数
        if (empty($params['goods_id'])) {
            $result['msg'] = '请选择商品';
            return $result;
        }
        if (empty($params['name'])) {
            $result['msg'] = '收货人姓名不能为空';
            return $result;
        }
        if (empty($params['phone']) || !preg_match('/^1[34578]\d{9}$/', $params['phone'])) {
            $result['msg'] = '收货电话不正确';
            return $result;
        }
        if (empty($params['addr'])) {
            $result['msg'] = '收货地址不正确';
            return $result;
        }
        if (empty($params['age'])) {
            $result['msg'] = '年龄段不能为空';
            return $result;
        }
        //商品单价
        $goods_info = D('Api/Goods')->getInfoByGoodsId($params['goods_id']);
        $data = array(
            'sn' => date('YmdHis') . str_pad($info['id'], 6, 0, STR_PAD_LEFT),
            'member_id' => $info['id'],   //下单者
            'receiver' => $params['name'],  //收货人
            'tel' => $params['phone'],   //收货电话
            'detail_address' => $params['addr'], //收货地址
            'goods_id' => $params['goods_id'],  //购买商品
            'goods_name' => $goods_info['name'],  //购买商品
            'goods_num' => 1,  //购买数量
            'pay_status' => 1,  //支付状态
            'total_amount' => $goods_info['shop_price'] * 1, //总金额
//			 'discount_amount' => $info['amount']>$this->maxAmount?$this->maxAmount:$info['amount'],  //打折金额
            'inputtime' => NOW_TIME,
            'province_name' => !$params['pro'] ? '' : $params['pro'],
            'city_name' => !$params['city'] ? '' : $params['city'],
            'area_name' => !$params['area'] ? '' : $params['area'],
            'age' => $params['age']
        );
        //打折金额
        $data['discount_amount'] = $info['amount'] > $this->maxAmount ? $this->maxAmount : $info['amount'];
        $data['discount_amount'] = $data['total_amount'] > $data['discount_amount'] ? $data['discount_amount'] : $data['total_amount'];
        //实际需要支付商品金额
        $data['real_amount'] = $data['total_amount'] > $data['discount_amount'] ? $data['total_amount'] - $data['discount_amount'] : 0;
        D('Api/OrderInfo')->startTrans();
        $rst = D('Api/OrderInfo')->storeOrderInfo($data);
        // var_dump($rst);return false;
        $rst2 = D('Api/Member')->descAmount($info['id'], $data['discount_amount']);
        if (!$rst || !$rst2) {
            D('Api/OrderInfo')->rollback();
        } else {
            D('Api/OrderInfo')->commit();
            $result['err_code'] = 1;
            $result['msg'] = '下单成功,请稍等！';
            $result['url'] = 'index.html';
        }
        return $result;
    }

    /**
     * 分享回调
     * @param $params
     * @return array
     */
    public function share($params)
    {
        header('Access-Control-Allow-Origin: *');
        $result = array('err_code' => 0, 'msg' => '分享失败');

        $open_id = $this->getOpenid();
        $info = D('Api/Member')->isMember($open_id, 'id,amount');
        if (empty($info)) {
            $result['msg'] = '没有识别到您的身份呢,难道不是地球猿！';
            return $result;
        }
        $rst = D('Api/Member')->incShare($open_id);
        if ($rst) {
            $result['err_code'] = 1;
            $result['msg'] = '分享成功';
        }
        return $result;
    }

    /**
     * 获取单个商品详情
     * @param $params
     * @return array
     */
    public function  getDetail($params)
    {
        header('Access-Control-Allow-Origin: *');
        $result = array('err_code' => 0, 'msg' => '没有更多该商品信息');
        if (!isset($params['goods_id']) || !$params['goods_id'])
            return $result;
        $info = D('Api/Goods')->getDetailByGoodsId($params['goods_id']);
        if (empty($info))
            return $result;
        $result['err_code'] = 1;
        $result['msg'] = '成功';
        $result['info'] = $info;
        return $result;
    }
}