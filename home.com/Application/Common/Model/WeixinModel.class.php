<?php
namespace Common\Model;

/**
 * 微信接口类
 *
 * @author wandaijin
 * @link http://mp.weixin.qq.com/wiki/home/index.html
 */
class WeixinModel
{

    /**
     * 微信app_id
     * @var unknown
     */
    private $weixin_appid = '';

    /**
     * 微信app_secrent
     * @var unknown
     */
    private $weixin_secret = '';

    /**
     * ca 证书
     * @var unknown
     */
    private $ca_file = '';

    /**
     * 消息体
     * @var unknown
     */
    private $msg_body = '';

    /**
     * 错误信息
     * @var unknown
     */
    private $error = '';

    /**
     * 初始化各种参数
     */
    public function __construct()
    {
        $this->weixin_appid = D("Common/WeixinConfig")->getAppId();
        $this->weixin_secret = D("Common/WeixinConfig")->getAppSecret();
        $this->ca_file = realpath(CONF_PATH . 'cacert.pem');
    }

    /**
     * 生成js签名信息
     */
    public function buildJsSignature($url = false)
    {
        //收集签名参数
        if (empty($url)) {
            $arr['url'] = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        } else {
            $arr['url'] = $url;
        }
        $arr['noncestr'] = $this->getNonceStr();
        $arr['jsapi_ticket'] = $this->getJsapiTicket();
        $arr['timestamp'] = time();
        //签名数组
        foreach ($arr as $k => $v) {
            $tmp[$k] = "{$k}={$v}";
        }
        //签名步骤一：按字典序排序参数
        ksort($tmp);
        $string = implode("&", $tmp);
        //签名步骤二：对string1进行sha1签名，得到signature： 
        $arr['signature'] = sha1($string);
        //追加返回参数
        $arr['appId'] = $this->weixin_appid;

        return $arr;
    }


    /**
     * 获取jsapi_ticket
     */
    private function getJsapiTicket()
    {
        $ticket = D("Common/Redis")->get(C('REDIS_PREFIX') . 'weixin_jsapi_ticket');
        if (empty($ticket)) {
            $base_url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket";
            $params = array(
                'access_token' => $this->getAccessToken(),
                'type' => 'jsapi'
            );
            $url = $this->buildUrl($base_url, $params);
            $rtn = D("Common/Http")->setCA($this->ca_file)->get($url);
            $res = json_decode($rtn, true);
            //请求正常
            if (!$res['errcode']) {
                //请求时间
                $res['request_time'] = time();
                //提前十分钟失效ticket
                $res['expires_time'] = $res['expires_in'] - 600;
                $ticket = $res['ticket'];
                D("Common/Redis")->setex(C('REDIS_PREFIX') . 'weixin_jsapi_ticket', $res['expires_time'], $res['ticket']);
            } else {
                $this->setError($res);
            }
        }
        return $ticket;
    }

    /**
     * 获取接口token
     */
    private function getAccessToken()
    {
        $token = D("Common/Redis")->get(C('REDIS_PREFIX') . 'weixin_access_token');
        if (empty($token)) {
            $base_url = "https://api.weixin.qq.com/cgi-bin/token";
            $params = array(
                'grant_type' => 'client_credential',
                'appid' => $this->weixin_appid,
                'secret' => $this->weixin_secret,
            );
            $url = $this->buildUrl($base_url, $params);

            $rtn = D("Common/Http")->setCA($this->ca_file)->get($url);
            $res = json_decode($rtn, true);
            //请求正常
            if (!$res['errcode']) {
                //请求时间
                $res['request_time'] = time();
                //提前十分钟更新token
                $res['expires_time'] = $res['expires_in'] - 600;
                $token = $res['access_token'];
                D("Common/Redis")->setex(C('REDIS_PREFIX') . 'weixin_access_token', $res['expires_time'], $res['access_token']);
            } else {
                $this->setError($res);
            }
        }
        return $token;
    }

    /**
     * 重置access_token
     */
    public function resetAccessToken()
    {
        $base_url = "https://api.weixin.qq.com/cgi-bin/token";
        $params = array(
            'grant_type' => 'client_credential',
            'appid' => $this->weixin_appid,
            'secret' => $this->weixin_secret,
        );
        $url = $this->buildUrl($base_url, $params);

        $rtn = D("Common/Http")->setCA($this->ca_file)->get($url);
        $res = json_decode($rtn, true);
        //请求正常
        if (!$res['errcode']) {
            //请求时间
            $res['request_time'] = time();
            //提前十分钟更新token
            $res['expires_time'] = $res['expires_in'] - 600;
            $token = $res['access_token'];
            D("Common/Redis")->setex(C('REDIS_PREFIX') . 'weixin_access_token', $res['expires_time'], $res['access_token']);
        }
    }

    /**
     * 构造url
     * @param unknown $base_url
     * @param unknown $params
     */
    public function buildUrl($base_url, $params)
    {
        $urllist = parse_url($base_url);

        foreach ($params as $k => $v) {
            if ($k == '#') {
                $urllist['fragment'] = "{$v}";
            } else {
                $query[] = "{$k}={$v}";
            }
        }
        if ($query) {
            $urllist['query'] = ($urllist['query'] ? $urllist['query'] . '&' : '') . implode("&", $query);
        }


        // Build the the final output URL
        $url = (isset($urllist["scheme"]) ? $urllist["scheme"] . "://" : "") .
            (isset($urllist["user"]) ? $urllist["user"] . ":" : "") .
            (isset($urllist["pass"]) ? $urllist["pass"] . "@" : "") .
            (isset($urllist["host"]) ? $urllist["host"] : "") .
            (isset($urllist["port"]) ? ":" . $urllist["port"] : "") .
            (isset($urllist["path"]) ? $urllist["path"] : "") .
            (isset($urllist["query"]) ? "?" . $urllist["query"] : "") .
            (isset($urllist["fragment"]) ? "#" . $urllist["fragment"] : "");

        return $url;
    }


    /**
     *
     * 产生随机字符串，不长于32位
     * @param int $length
     * @return 产生的随机字符串
     */
    private function getNonceStr($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     * 生成js签名信息
     */
    public function buildJsSignatureWithNoTicket($url = false)
    {
        $arr['noncestr'] = $this->getNonceStr();
        $arr['timestamp'] = time();

        //签名数组
        foreach ($arr as $k => $v) {
            $tmp[$k] = "{$k}={$v}";
        }
        //签名步骤一：按字典序排序参数
        ksort($tmp);
        $string = implode("&", $tmp);
        //签名步骤二：对string1进行sha1签名，得到signature： 
        $arr['signature'] = sha1($string);
        //追加返回参数
        $arr['appId'] = $this->weixin_appid;

        return $arr;
    }
}