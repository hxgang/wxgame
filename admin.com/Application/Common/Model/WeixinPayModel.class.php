<?php
/**
 * 支付模型
 */
namespace Common\Model;
Vendor('Weixin.Pay.WxPay#Api');

class WeixinPayModel
{

    protected $unifiedOrder = '';

    public function __construct ()
    {
    }

    /**
     * 统一下单
     * @return \Common\Model\json数据，可直接填入js函数作为参数
     */
    public function createOrder($open_id, $goods)
    {

        $callback_url = 'http://' . $_SERVER['HTTP_HOST'] . U('App/Callback/weixinJs');

        $unifiedOrder = new \WxPayUnifiedOrder();
        $unifiedOrder->SetBody($goods['name']);
        $unifiedOrder->SetOut_trade_no($goods['order_sn']);
        $unifiedOrder->SetTotal_fee($goods['fee']);
        $unifiedOrder->SetTime_start(date("YmdHis"));
        $unifiedOrder->SetTime_expire(date("YmdHis", time() + 1800));//半小时支付时间
        $unifiedOrder->SetGoods_tag($goods['tag']);
        $unifiedOrder->SetNotify_url($callback_url);
        $unifiedOrder->SetTrade_type("JSAPI");
        $unifiedOrder->SetOpenid($open_id);

        $order = \WxPayApi::unifiedOrder($unifiedOrder);

        return $this->GetJsApiParameters($order);
    }

    /**
     *
     * 获取jsapi支付的参数
     *
     * @param array $UnifiedOrderResult 统一支付接口返回的数据
     * @throws WxPayException
     *
     * @return json数据，可直接填入js函数作为参数
     */
    private function GetJsApiParameters ($UnifiedOrderResult)
    {
        if (! array_key_exists("appid", $UnifiedOrderResult) ||
                 ! array_key_exists("prepay_id", $UnifiedOrderResult) ||
                 $UnifiedOrderResult['prepay_id'] == "") {
            throw new \WxPayException("参数错误 : [" . $UnifiedOrderResult["return_code"] ."] : ". $UnifiedOrderResult["return_msg"]);
        }

        $jsapi = new \WxPayJsApiPay();
        $jsapi->SetAppid($UnifiedOrderResult["appid"]);
        $timeStamp = time();
        $jsapi->SetTimeStamp("$timeStamp");
        $jsapi->SetNonceStr(\WxPayApi::getNonceStr());
        $jsapi->SetPackage("prepay_id=" . $UnifiedOrderResult['prepay_id']);
        $jsapi->SetSignType("MD5");
        $jsapi->SetPaySign($jsapi->MakeSign());
        $parameters = json_encode($jsapi->GetValues());

        return $parameters;
    }

    /**
     * 系统返现给代理商
     */
    public function payBackToAgent($open_id, $data)
    {
        $mmOrder = new \WxPayMMOrder();
        $mmOrder->SetPartner_Trade_No($data['share_sn']);
        $mmOrder->SetAmount($data['fee']);
        $mmOrder->SetOpenid($open_id);
        $mmOrder->SetCheck_Name('NO_CHECK');
        $mmOrder->SetDesc($data['desc']);

        return \WxPayApi::mmPay($mmOrder);
    }
}