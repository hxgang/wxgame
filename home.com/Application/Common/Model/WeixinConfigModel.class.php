<?php
namespace Common\Model;

use Think\Model;

/**
 * 微信配置
 *
 * @author wandaijin
 */
class WeixinConfigModel extends Model
{
    /**
     * 读取微信配置信息
     * @return mixed
     */
    public function getAppInfo()
    {
        //@hack 暂时去掉缓存，以免svn覆盖问题
//         $data = S('WeixinConfig');
//         if (empty($data)) {
//             $map['id'] = 1;
//             $data = $this->where($map)->find();
//             S('WeixinConfig', $data);
//         }
        $map['id'] = 1;
        $data = $this->where($map)->find();
        return $data;
    }

    /**
     * 清楚缓存
     */
    public function refeshAppInfo()
    {
        S('WeixinConfig', null);
    }

    /**
     * 获取微信app_id
     * @return mixed
     */
    public function getAppId()
    {
        $data = $this->getAppInfo();
        return $data['appid'];
    }

    /**
     * 获取微信app_seceret
     * @return mixed
     */
    public function getAppSecret()
    {
        $data = $this->getAppInfo();
        return $data['appsecret'];
    }

    /**
     * 获取微信app_token
     * @return mixed
     */
    public function getAppToken()
    {
        $data = $this->getAppInfo();
        return $data['token'];
    }

    /**
     * 获取微信encodingaeskey
     * @return mixed
     */
    public function getAppEncodingaeskey()
    {
        $data = $this->getAppInfo();
        return $data['encodingaeskey'];
    }

    /**
     * 获取开发者微信号
     * @return mixed
     */
    public function getAppUserName()
    {
        $data = $this->getAppInfo();
        return $data['num'];
    }
}