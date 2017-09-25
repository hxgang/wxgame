<?php
namespace Common\Model;

/**
 * 微信接口类
 *
 * @author wandaijin
 * @link http://mp.weixin.qq.com/wiki/home/index.html
 */
class WeixinModel {

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
        $this->weixin_appid = D("Admin/WeixinConfig")->getAppId();
        $this->weixin_secret = D("Admin/WeixinConfig")->getAppSecret();
        $this->ca_file = realpath(CONF_PATH . 'cacert.pem');
    }


    /**
     * 客服接口，发送消息
     */
    public function sendMsg($open_id)
    {
       $msg_body = str_replace("##OPENID##", $open_id, $this->msg_body);

       $base_url = "https://api.weixin.qq.com/cgi-bin/message/custom/send";
       $params = array(
               'access_token' => $this->getAccessToken(),
       );

       //发送消息
       $url = $this->buildUrl($base_url, $params);
       $rtn = D("Common/Http")->setCA($this->ca_file)->post($url, $msg_body);

       $res = json_decode($rtn, true);
       if (isset($res['errcode']) && $res['errcode']) {
           $this->setError($res);
           return false;
       } else {
           return $res;
       }
    }

    /**
     * 构建消息格式
     */
    public function buildMsg($param)
    {
        $type = ucfirst($param['type']);
        unset($param['type']);

        $function = "_msg{$type}";
        $this->msg_body = $this->$function($param);

        return $this;
    }

    /**
     * 新增临时素材
     */
    public function uploadMedia($local_file_path, $type, $mime)
    {

        $full_file = realpath($local_file_path);
        $base_url = "https://api.weixin.qq.com/cgi-bin/media/upload";
        $params = array(
                'access_token' => $this->getAccessToken(),
                'type' => $type,
        );

        //处理版本兼容
        if(version_compare(PHP_VERSION,'5.5.0','<')) {
            $file ="@$full_file;filename=" . basename($full_file) . ($mime ? ";type=$mime" : '');
        } else {
            $file = new \CURLFile($full_file, ($mime ? ";type=$mime" : ''), basename($full_file));
        }

        //上传文件
        $url = $this->buildUrl($base_url, $params);
        $rtn = D("Common/Http")->setCA($this->ca_file)
        ->post($url, array('media'=>$file), array('Content-Type'=>'multipart/form-data'));
        $res = json_decode($rtn, true);

        if (isset($res['errcode']) && $res['errcode']) {
            $this->setError($res);
            return false;
        } else {
            return $res;
        }
    }

    /**
     * 获取临时素材
     */
    public function downloadMedia($media_id, $media_type=null)
    {
        if($media_type && in_array(strtolower($media_type), array('video', 'shortvideo'))) {
            $base_url = "http://api.weixin.qq.com/cgi-bin/media/get";
        } else {
            $base_url = "https://api.weixin.qq.com/cgi-bin/media/get";
        }
        
        $params = array(
                'access_token' => $this->getAccessToken(),
                'media_id' => $media_id,
        );
        
        $url = $this->buildUrl($base_url, $params);
        
        $rtn = D("Common/Http")->setCA($this->ca_file)->get($url);
        $code = D("Common/Http")->getResponseCode();
        
        if ($code != 200) return false;
        $header = D("Common/Http")->getResponseHeaders();
        
        //失败
        if (empty($header['Content-disposition'])) return false;
        
        //保存到本地，构造路径
        $dir = date('Yn') . '/' . date('d');
        $savePath = $this->getMediaRootPath() . $dir;
        $file_name = md5($header['Content-disposition'] . time());
        preg_match('/filename="(.*?)\.(.*)"/', $header['Content-disposition'], $matches);
        $file_ext = $matches[2];
        $file_full_name = "{$file_name}.{$file_ext}";
        if (!file_exists ($savePath)) mkdir ($savePath, 0770, true);
        
        //写入文件
        $fp=@fopen($savePath.'/'.$file_full_name, "a");
        fwrite($fp,$rtn);
        fclose($fp);
        
        //返回保存路径
        $result['file_path'] = "{$dir}/{$file_full_name}";
        $result['size'] = $header['Content-Length'];
        $result['mime'] = $header['Content-Type'];
        
        return $result;
    }

    /**
     * 获取媒体文件保存根目录
     */
    public function getMediaRootPath()
    {
        return SITE_PATH . 'Download/';
    }

    /**
     * 获取素材列表
     */
    public function getMediaList($type, $offset = 0, $count = 20)
    {
      $url = 'https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='.$this->getAccessToken();
      $params = array(
              'type'    => $type,
              'offset'  => $offset,
              'count'   => $count,
      );

      //上传文件
      // $url = $this->buildUrl($base_url, $params);
      $rtn = D("Common/Http")->setCA($this->ca_file)
      ->post($url,  array());
      $res = json_decode($rtn, true);

      if (isset($res['errcode']) && $res['errcode']) {
          $this->setError($res);
          return false;
      } else {
          return $res;
      }
    }
    
    /**
     *
     */
    public function CreateMenu($menu)
    {
        if ($this->DeleteMenu()) {
            $base_url = "https://api.weixin.qq.com/cgi-bin/menu/create";
            $params = array(
                    'access_token' => $this->getAccessToken(),
            );
            $url = $this->buildUrl($base_url, $params);

            $menu_fmt = $this->buildMenu($menu);
            $rtn = D("Common/Http")->setCA($this->ca_file)->post($url, $menu_fmt);
            $res = json_decode($rtn, true);

            if ($res['errcode']==0) {
                return true;
            } else {
                $res['menu'] = $menu_fmt;
                $this->setError($res);
                return false;
            }
        }

        return false;
    }

    /**
     * 获取错误信息
     * @return unknown
     */
    public function getError() {
        return $this->error;
    }

    /**
     * 设置错误信息
     * @param unknown $res
     * @return WeixinModel
     */
    private function setError($res) {
        $this->error = $res;
        return $this;
    }

    /**
     * 删除菜单
     */
    private function DeleteMenu()
    {
        $base_url = "https://api.weixin.qq.com/cgi-bin/menu/delete";
        $params = array(
                'access_token' => $this->getAccessToken(),
        );
        $url = $this->buildUrl($base_url, $params);

        $rtn = D("Common/Http")->setCA($this->ca_file)->get($url);
        $res = json_decode($rtn, true);

        if ($res['errcode']==0) {
            return true;
        } else {
            $this->setError($res);
            return false;
        }
    }

    /**
     * 通过公众号接口获取用户信息
     * @param unknown $open_id
     */
    public function getUserInfo($open_id, $force=false)
    {
        $base_url = "https://api.weixin.qq.com/cgi-bin/user/info";
        $params = array(
                'access_token' => $this->getAccessToken(),
                'openid' => $open_id,
                'lang' => 'zh_CN',
        );

        $url = $this->buildUrl($base_url, $params);

        $rtn = D("Common/Http")->setCA($this->ca_file)->get($url);
        // M('debug')->add(array('event'=> 'subscribe:rtn '.date('Y-m-d H:i:s'),'data'=>json_encode($rtn)));
        $res = json_decode($rtn, true);

        if (isset($res['errcode']) && $res['errcode']) {
            if ('40001' == $res['errcode']) {
              if ($force) {
                return false; // 再次获取仍未获取到，退出函数
              } else {
                M('debug')->add(array('event'=> 'subscribe:40001 '.date('Y-m-d H:i:s'),'data'=>json_encode($rtn)));
              }
              // 重新设置access_token后再次尝试获取用户信息，access_token获取日限2000次
              $this->resetAccessToken();
              $res_2 = $this->getUserInfo($open_id, true);

              if ($res_2 == false) {
                M('debug')->add(array('event'=> 'subscribe:rtnAgain' .date('Y-m-d H:i:s'),'data'=>'尝试再次获取userinfo失败'));
              }

              return $res_2 == false ? false : $res_2;
            }
            $this->setError($res);
            return false;
        } else {
            return $res;
        }
    }

    /**
     * 获取关注列表
     */
    public function getUserList($next_openid)
    {
        $base_url = "https://api.weixin.qq.com/cgi-bin/user/get";
        $params = array(
                'access_token' => $this->getAccessToken(),
        );
        if ($next_openid) {
            $params['next_openid'] = $next_openid;
        }
        
        $url = $this->buildUrl($base_url, $params);
        $rtn = D("Common/Http")->setCA($this->ca_file)->get($url);
        $res = json_decode($rtn, true);
        
        if (isset($res['errcode']) && $res['errcode']) {
            $this->setError($res);
            return false;
        } else {
            return $res;
        }
    }
    
    /**
     * 验证appid和appsecret是否正常
     */
    public function checkWxInfo($app_id, $app_secret)
    {
        $this->weixin_appid = $app_id;
        $this->weixin_secret = $app_secret;
        //清楚一下缓存
        D("Common/Redis")->delete(C('REDIS_PREFIX').'weixin_access_token');

        return $this->getAccessToken();
    }

    /**
     * 生成js签名信息
     */
    public function buildJsSignature($url=false)
    {
        //收集签名参数
        if(empty($url)) {
            $arr['url'] = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        } else {
            $arr['url'] = $url;
        }
        $arr['noncestr'] = $this->getNonceStr();
        $arr['jsapi_ticket'] = $this->getJsapiTicket();
        $arr['timestamp'] = time();

        //签名数组
        foreach($arr as $k=>$v) {
            $tmp[$k] = "{$k}={$v}";
        }
        
        //签名步骤一：按字典序排序参数
        ksort($tmp);
        $string = implode("&", $tmp);
        //签名步骤二：对string1进行sha1签名，得到signature： 
        $arr['signature'] = sha1($string);
        //追加返回参数
        $arr['appId'] = $this->weixin_appid ;
        
        return $arr;
    }
    
    
    /**
     * 获取jsapi_ticket
     */
    private function getJsapiTicket()
    {
        $ticket = D("Common/Redis")->get(C('REDIS_PREFIX').'weixin_jsapi_ticket');
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
                D("Common/Redis")->setex(C('REDIS_PREFIX').'weixin_jsapi_ticket', $res['expires_time'], $res['ticket']);
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
        $token = D("Common/Redis")->get(C('REDIS_PREFIX').'weixin_access_token');
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
                D("Common/Redis")->setex(C('REDIS_PREFIX').'weixin_access_token', $res['expires_time'], $res['access_token']);
            } else {
                $this->setError($res);
            }
        }

        return $token;
    }

    /**
     * 重置access_token
     * @date   2016-07-29
     * @author yhua.fu
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
          D("Common/Redis")->setex(C('REDIS_PREFIX').'weixin_access_token', $res['expires_time'], $res['access_token']);
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

        foreach ($params as $k=>$v) {
            if ($k =='#') {
                $urllist['fragment'] = "{$v}";
            } else {
                $query[] = "{$k}={$v}";
            }
        }
        if ($query) {
            $urllist['query'] = ($urllist['query'] ? $urllist['query'] . '&' : '') . implode("&", $query);
        }


        // Build the the final output URL
        $url=(isset($urllist["scheme"])?$urllist["scheme"]."://":"").
        (isset($urllist["user"])?$urllist["user"].":":"").
        (isset($urllist["pass"])?$urllist["pass"]."@":"").
        (isset($urllist["host"])?$urllist["host"]:"").
        (isset($urllist["port"])?":".$urllist["port"]:"").
        (isset($urllist["path"])?$urllist["path"]:"").
        (isset($urllist["query"])?"?".$urllist["query"]:"").
        (isset($urllist["fragment"])?"#".$urllist["fragment"]:"");

        return $url;
    }

    /**
     * 获取文本消息内容
     * @param unknown $param
     */
    private function _msgText($param)
    {
        $body =<<<html
{
    "touser":"##OPENID##",
    "msgtype":"text",
    "text":
    {
         "content":"{$param['content']}"
    }
}
html;
        return $body;
    }

    /**
     * 获取图片消息
     * @param unknown $param
     */
    private function _msgImage($param)
    {
        $body =<<<html
{
    "touser":"##OPENID##",
    "msgtype":"image",
    "image":
    {
         "media_id":"{$param['media_id']}"
    }
}
html;
        return $body;
    }

    /**
     * 发送语音消息
     * @param unknown $param
     */
    private function _msgVoice($param)
    {
        $body =<<<html
{
    "touser":"##OPENID##",
    "msgtype":"voice",
    "voice":
    {
         "media_id":"{$param['media_id']}"
    }
}
html;
        return $body;
    }

    /**
     * 发送视频消息
     * @param unknown $param
     */
    private function _msgVideo($param)
    {
        $body =<<<html
{
    "touser":"##OPENID##",
    "msgtype":"video",
    "video":
    {
      "media_id":"{$param['media_id']}",
      "thumb_media_id":"{$param['thumb_media_id']}",
      "title":"{$param['title']}",
      "description":"{$param['description']}"
    }
}
html;
        return $body;
    }

    /**
     * 发送音乐消息
     * @param unknown $param
     */
    private function _msgMusic($param)
    {
        $body =<<<html
{
    "touser":"##OPENID##",
    "msgtype":"music",
    "music":
    {
      "title":"{$param['title']}",
      "description":"{$param['description']}",
      "musicurl":"{$param['musicurl']}",
      "hqmusicurl":"{$param['hqmusicurl']}",
      "thumb_media_id":"{$param['thumb_media_id']}"
    }
}
html;
        return $body;
    }

    /**
     * 发送图文消息
     * @param unknown $param
     */
    private function _msgNews($param)
    {

        $news_content = '';
        foreach (array_slice($param['news'],0,8) as $v) {
$news_content .=<<<NEWS
{
     "title":"{$v['title']}",
     "description":"{$v['description']}",
     "url":"{$v['url']}",
     "picurl":"{$v['picurl']}"
},
NEWS;
        }
       $news_content = rtrim($news_content, ',');


        $body =<<<html
{
    "touser":"##OPENID##",
    "msgtype":"news",
    "news":{
        "articles": [{$news_content}]
    }
}
html;
        return $body;
    }

    /**
     *
     * @param unknown $menu
     */
    private function buildMenu($menu)
    {
        if(empty($menu)) return false;


        $str = '{"button":[';
        foreach($menu as $v) {
            $str .= '{';
            if($v['type']) $str .= "\"type\":\"{$v['type']}\",\n";
            if($v['name']) $str .= "\"name\":\"{$v['name']}\",\n";
            if($v['type'] == "click" && $v['key']) $str .= "\"key\":\"{$v['key']}\",\n";
            if($v['type'] == "view" && $v['url']) {
                $url = trim($v['url']);
                $str .= "\"url\":\"{$url}\",\n";
            }


            if ($v['sub_menu']) {
                $str .= '"sub_button":[';
                foreach($v['sub_menu'] as $sv) {
                    $str .= '{';
                    if($sv['type']) $str .= "\"type\":\"{$sv['type']}\",\n";
                    if($sv['name']) $str .= "\"name\":\"{$sv['name']}\",\n";
                    if($sv['type'] == "click" && $sv['key']) $str .= "\"key\":\"{$sv['key']}\",\n";
                    if($sv['type'] == "view" && $sv['url']) {
                        //生成可回调链接
                        $url_s = trim($sv['url']);
                        $str .= "\"url\":\"{$url_s}\",\n";
                    }
                    $str = rtrim($str, ",\n");
                    $str .= "},\n";
                }
                $str = rtrim($str, ",\n");

                $str .= ']';
            } else {
                $str = rtrim($str, ",\n");
            }
            $str .= "},\n";
        }
        $str = rtrim($str, ",\n");
        $str .= ']}';

        return $str;
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
        $str ="";
        for ( $i = 0; $i < $length; $i++ )  {
            $str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }
        return $str;
    }

    /**
     * 生成js签名信息
     */
    public function buildJsSignatureWithNoTicket($url=false)
    {
        $arr['noncestr'] = $this->getNonceStr();
        $arr['timestamp'] = time();

        //签名数组
        foreach($arr as $k=>$v) {
            $tmp[$k] = "{$k}={$v}";
        }
        
        //签名步骤一：按字典序排序参数
        ksort($tmp);
        $string = implode("&", $tmp);
        //签名步骤二：对string1进行sha1签名，得到signature： 
        $arr['signature'] = sha1($string);
        //追加返回参数
        $arr['appId'] = $this->weixin_appid ;
        
        return $arr;
    }
}