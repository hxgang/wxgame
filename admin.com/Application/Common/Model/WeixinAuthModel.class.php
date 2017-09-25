<?php
namespace Common\Model;
/**
 * 微信网页授权登录接口类
 */
class WeixinAuthModel {

    /**
     * 第一步 重定向请求
     */
    public function login($callback, $scope = 'snsapi_base', $is_redirect=true)
    {
        $app_id = D("Common/WeixinConfig")->getAppId();

        /**
         * https://open.weixin.qq.com/connect/oauth2/authorize?appid=APPID&redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect
         */
        if ($is_redirect) {
            $_SESSION['state'] = md5(uniqid(rand(), TRUE)); // CSRF protection
        }

        $login_url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" .
                $app_id . "&redirect_uri=" . urlencode($callback) . "&response_type=code&scope=" .
                $scope . "&state=" . $_SESSION['state'] . "#wechat_redirect";


        if ($is_redirect) {
            redirect($login_url);
        } else {
            return $login_url;
        }
    }

    /**
     * 生成微信公众号菜单链接
     * @param unknown $url
     * @return string
     */
    // public function getAuthUrl($url)
    // {
    //     return $this->login($url, 'snsapi_userinfo', false);
    // }

    /**
     * 第二步 通过code获取access_token
     */
    public function getAccessToken($valide_state=true)
    {
        if ( $valide_state && $_GET['state'] !== $_SESSION['state']) {
            exit("The state does not match. You may be a victim of CSRF.");
        }

        $code = $_GET['code'];
        $appid = D("Common/WeixinConfig")->getAppId();
        $secret = D("Common/WeixinConfig")->getAppSecret();
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$appid}&secret={$secret}&code={$code}&grant_type=authorization_code";

        $ret = D("Common/Http")->setCA(realpath(CONF_PATH . 'cacert.pem'))->get($url);

        $data = json_decode($ret, true);
        if ($data['openid']) {
            $_SESSION['wx_info'] = $data;
            return true;
        } else {
            return false;
        }
    }

    /**
     * 网页授权获取用户信息
     */
    public function getUserInfoFromWx($open_id)
    {
        $access_token = $_SESSION['wx_info']['access_token'];
        $openid = $open_id ? $open_id : $_SESSION['wx_info']['openid'];
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
        
        $ret = D("Common/Http")->setCA(realpath(CONF_PATH . 'cacert.pem'))->get($url);
        $data = json_decode($ret, true);
        
        return $data['errcode'] ? array() : $data;
    }
    
    /**
     * 获取用户的open_id
     */
    public function getOpenId()
    {
        return isset($_SESSION['wx_info']['openid']) ? $_SESSION['wx_info']['openid'] : '0';
    }
}