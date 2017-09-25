<?php
namespace Common\Model;

/**
 * 接受微信服务器发来的事件
 * 回复微信服务器发来的事件
 *
 * @author wandaijin
 * @link http://mp.weixin.qq.com/wiki/home/index.html
 */
Vendor('Weixin.wxBizMsgCrypt');

class WeixinServerModel {

    /**
     * 加解密类
     * @var unknown
     */
    private $crypter = '';
    
    /**
     * 错误
     * @var unknown
     */
    private $error = '';
    
    /**
     * 微信相关参数
     * @var unknown
     */
    private $from_user_name = '';
    private $appid = '';
    private $secret = '';
    private $token = '';
    private $encodingAesKey = '';
    
    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->from_user_name  = D("Admin/WeixinConfig")->getAppUserName();
        $this->appid = D("Admin/WeixinConfig")->getAppId();
        $this->secret = D("Admin/WeixinConfig")->getAppSecret();
        $this->token = D("Admin/WeixinConfig")->getAppToken();
        $this->encodingAesKey = D("Admin/WeixinConfig")->getAppEncodingaeskey();
        $this->crypter = new \WXBizMsgCrypt($this->token, $this->encodingAesKey , $this->appid);
    }
    
    
    /**
     * 加密消息
     */
    private function encryptMsg($msg)
    {
        $result = '';
        $timeStamp = time();
        $nonce = uniqid().rand();
        $errCode = $this->crypter->encryptMsg($msg, $timeStamp, $nonce, $result);
        
        if ($errCode == 0) {
            return $result;
        } else {
            $this->setError($errCode);
            return null;
        }
    }
    
    /**
     * 解密消息
     */
    private function decryptMsg($encryptMsg)
    {
        $xml_tree = new \DOMDocument();
        $xml_tree->loadXML($encryptMsg);
        $array_e = $xml_tree->getElementsByTagName('Encrypt');
        $encrypt = $array_e->item(0)->nodeValue;
        
        $format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
        $from_xml = sprintf($format, $encrypt);
        
        $msg_sign = $_GET['msg_signature'];
        $timeStamp = $_GET['timestamp'];
        $nonce = $_GET['nonce'];
        
        // 第三方收到公众号平台发送的消息
        $result = '';
        $errCode = $this->crypter->decryptMsg($msg_sign, $timeStamp, $nonce, $from_xml, $result);
        
        if ($errCode == 0) {
            return $result;
        } else {
            $this->setError($errCode);
            return null;
        }
    }
    
    /**
     * 解析服务器推送到服务器的消息
     */
    public function parseMsg()
    {
        $raw_xml = file_get_contents("php://input");
        // M('debug')->add(array('event'=> 'xml','data'=>$raw_xml));
        
        $tmpArr = (array)simplexml_load_string($raw_xml,'SimpleXMLElement',LIBXML_NOCDATA);
        if (!isset($tmpArr['Encrypt'])) {
            return $tmpArr;
        }

        $decrpt_xml = $this->decryptMsg($raw_xml);
        if(is_null($decrpt_xml)) return null;
        
        $simple_xml = new \SimpleXMLElement($decrpt_xml);
        $data = array();
        foreach ($simple_xml as $key => $value){
            $data[$key] = strval($value);
        }
        return $data;
    }
    
    /**
     * 关注事件
     * 
     * 如果当前用户一直订阅过，则更新数据，否则插入新数据
     * 
     * $open_id 唯一id
     */
    public function subscribe($open_id)
    {
        if (empty($open_id)) return false;
        
        //获取用户信息
        $user_info = D('Common/Weixin')->getUserInfo($open_id);
        if(empty($user_info)) return false;
        
        //构成字段
        $data_save['openid'] = $open_id;
        $data_save['nickname'] = $user_info['nickname'];
        $data_save['sex'] = $user_info['sex'];
        $data_save['city'] = $user_info['city'];
        $data_save['country'] = $user_info['country'];
        $data_save['province'] = $user_info['province'];
        $data_save['headimgurl'] = $user_info['headimgurl'];
        $data_save['unionid'] = strval($user_info['unionid']);
        $data_save['remark'] = $user_info['remark'];
        $data_save['subscribe_time'] = $user_info['subscribe_time'];
        $data_save['subscribe_status'] = 1;
        
        if (D('App/User')->isExist($open_id)) {
            $map['openid'] = $open_id;
            $r = D('App/User')->where($map)->save($data_save);
            $result = ($r === false) ? 0 : 1;
        } else {
            $data_save['openid'] = $open_id;
            $data_save['ctime'] = time();
            $data_save['uptime'] = $data_save['ctime'];
            $result = D('App/User')->add($data_save);

            // 为其生成 token
            // D('App/User')->generateAgentToken($result);
        }
        
        return $result;
    }
    
    /**
     * 取消关注事件
     */
    public function unsubscribe($open_id)
    {
        if (D('App/User')->isExist($open_id)) {
            $map['openid'] = $open_id;
            $r = D('App/User')->where($map)->setField('subscribe_status', 0);
            return ($r === false) ? 0 : 1;
        } else {
            return 1;
        }
    }
    
    /**
     * 自定义菜单事件:点击
     */
    public function menuClick()
    {
        
    }
    
    
    /**
     * 自定义菜单事件：链接
     */
    public function menuView()
    {
        
    }
    
    /**
     * 获取错误
     */
    public function getError()
    {
        return $this->error;
    }
    
    /**
     * 设置错误
     */
    private function setError($error)
    {
        $this->error = $error;
        return $this;
    }
    
    
    /**
     * 收到被动消息时，向用户发送消息
     */
    public function getReplyMsg($open_id, $data)
    {
        $result = null;
        if ($data['type']==1) {
            $result = $this->_buildMsgText($open_id, $data);
        } else if ($data['type']==2) {
            //补全图片地址
            $data['picurl'] = preg_match("/^(http|https)/", $data['picurl']) ? $data['picurl'] : 'http://' . $_SERVER['HTTP_HOST'] . $data['picurl'];
            $result = $this->_buildMsgNews($open_id, $data);
        } else if ($data['type'] == 3) {
            $result = $this->_buildMultiMsgNews($open_id, $data['data']);
        }
        
        // return is_null($result) ? null : $this->encryptMsg($result);
        $resultCp = $result;
        $this->encryptMsg($result);
        if (!is_null($result) && is_null($result)) {
            // 加密前不为空，加密后为空，说明没有使用加密，直接返回
            return $resultCp;
        }
        return $result ? $result : null;
    }
    
    /**
     * 生成被动回复消息：文本消息
     */
    private function _buildMsgText($open_id, $data)
    {
        $time = NOW_TIME;
        $body = <<<MSG
<xml>
    <ToUserName><![CDATA[{$open_id}]]></ToUserName>
    <FromUserName><![CDATA[{$this->from_user_name}]]></FromUserName>
    <CreateTime>{$time}</CreateTime>
    <MsgType><![CDATA[text]]></MsgType>
    <Content><![CDATA[{$data['description']}]]></Content>
</xml>        
MSG;
        
        return $body;
    }
    
    
    /**
     * 生成被动回复消息：文本消息
     */
    private function _buildMsgNews($open_id, $data)
    {
        $time = NOW_TIME;
        $body = <<<MSG
<xml>
    <ToUserName><![CDATA[{$open_id}]]></ToUserName>
    <FromUserName><![CDATA[{$this->from_user_name}]]></FromUserName>
    <CreateTime>{$time}</CreateTime>
    <MsgType><![CDATA[news]]></MsgType>
    <ArticleCount>1</ArticleCount>
    <Articles>
        <item>
            <Title><![CDATA[{$data['title']}]]></Title> 
            <Description><![CDATA[{$data['description']}]]></Description>
            <PicUrl><![CDATA[{$data['picurl']}]]></PicUrl>
            <Url><![CDATA[{$data['url']}]]></Url>
        </item>
    </Articles>
</xml> 
MSG;
        return $body;
    }

    /**
     *  回复多图文
     * @date   2016-07-29
     * @author yhua.fu
     * @param  [type]     $openid  [description]
     * @param  [type]     $data    [description]
     */
    private function _buildMultiMsgNews($openid, $data)
    {
        $time = NOW_TIME;

        // item数量不超过10，超过10微信不响应

        $body = '<xml>';
        $body .= '<ToUserName><![CDATA['. $openid. ']]></ToUserName>';
        $body .= '<FromUserName><![CDATA['. $this->from_user_name. ']]></FromUserName>';
        $body .= '<CreateTime>'. $time. '</CreateTime>';
        $body .= '<MsgType><![CDATA[news]]></MsgType>';
        $body .= '<ArticleCount>'. count($data). '</ArticleCount>';
        $body .= '<Articles>';

        foreach ($data as $value) {
            $body .= '<item>';
            $body .= '<Title><![CDATA['. $value['title']. ']]></Title> ';
            $body .= '<Description><![CDATA['. $value['description']. ']]></Description>';
            $body .= '<PicUrl><![CDATA['. getFullUrl($value['picurl']). ']]></PicUrl>';
            $body .= '<Url><![CDATA['. getFullUrl($value['url']). ']]></Url>';
            $body .= '</item>';
        }
       
        $body .= '</Articles>';
        $body .= '</xml>';
        return $body;
    }
    
}

