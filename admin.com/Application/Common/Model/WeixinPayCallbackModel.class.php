<?php
/**
 * 支付回调模型
 */
namespace Common\Model;

Vendor('Weixin.Pay.WxPay#Api');
Vendor('Weixin.Pay.WxPay#Notify');

class WeixinPayCallbackModel extends \WxPayNotify
{
    /**
     * 处理主流程 @todo
     * (non-PHPdoc)
     * @see WxPayNotify::NotifyProcess()
     */
    public function NotifyProcess($data, &$msg)
    {
        if(!array_key_exists("transaction_id", $data)){
            $msg = "输入参数不正确";
            return false;
        }

        if ($data['result_code'] != "SUCCESS") {
            $msg = "交易失败";
            return false;
        }

        //更新订单表
        $order_sn = $data["out_trade_no"];
        $update_data['transaction_id'] = $data["transaction_id"];
        $update_data['pay_price'] = $data["total_fee"] / 100;
        $update_data['status'] = 1;
        $update_data['pay_time'] = strtotime($data['time_end']);
        $res = D("App/Order")->updateOrder($order_sn, $update_data);

        if ($res) {
            //获取订单uid
            $order = D("App/Order")->getOrderBySN($order_sn);
            // 判断是否为单次支付订单
            if (1 == $order['flag']) {

                // 支付成功后写入 user_topic_history 记录表
                $topicInfo = D('App/ChatTopic')->getInfoByPid($order['video_id'], 'id');
                $topicHistoryData = array(
                    'uid'       => $order['uid'],
                    'topic_id'  => $topicInfo['id'],
                    'ctime'     => $_SERVER['REQUEST_TIME'],
                );
                M('user_topic_history')->add($topicHistoryData);
                
                // 获取课程信息
                $videoInfo = D('App/Video')->getVideoInfo($order['video_id'], 'uid');
                // 获取讲课老师信息
                $teacherInfo = D('App/User')->getUserInfo($videoInfo['uid']);
                if ($teacherInfo['tech_percent'] > 0) {
                    // 创建讲师分成数据
                    $share['flag'] = 1; // 单次付费标志
                    $share['order_sn'] = $order_sn;
                    $share['agentid'] = $videoInfo['uid'];  // 收款人为讲师
                    $share['uid'] = $order['uid'];
                    $share['order_price'] = $update_data['pay_price'];
                    D('App/OrderShare')->createOrderShare($share);
                }
                
            }
            // 否则视为年费订单
            else {
                if ($order['agentid']) {

                    $is_agent = D('App/User')->isAgent($order['agentid']);
                    $is_agent_expired = D('App/User')->isAgentExpired($order['agentid']);

                    //未过期的代理，且代理分成比例不为0，则进行分成 @hack
                    $agent = D('App/User')->getUserInfo($order['agentid']);
                    if ( $is_agent && !$is_agent_expired && $agent['percent'] > 0) {
                        //创建分成数据
                        $share['order_sn'] = $order_sn;
                        $share['agentid'] = $order['agentid'];
                        $share['uid'] = $order['uid'];
                        $share['order_price'] = $update_data['pay_price'];
                        D('App/OrderShare')->createOrderShare($share);
                    }
                }

                //更新用户级别
                D("App/User")->updateUserAfterPay($order['uid'], $update_data['pay_time']);
            }
        }


        return $res ? true : false;
    }
}