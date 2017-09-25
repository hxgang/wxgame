<?php
namespace Api\Controller;

use Think\Controller;

class BaseController extends Controller
{
    /**
     * 用户微信open id
     * @var unknown
     */
    protected $open_id = '';

    /**
     * 用户在系统中的id
     * @var unknown
     */
    protected $uid = '';

    function _initialize()
    {
        //微信授权
        $this->open_id = D("Common/WeixinAuth")->getOpenId();
 //       $this->open_id = 'opkvDw_22rZycZL5KSOpXC7GQhgM';
        if (!$this->open_id) {
            if ($_GET['code'] && $_GET['state']) {
                //微信已重定向页面，下面获取用户openid 和 access_token等信息
                D("Common/WeixinAuth")->getAccessToken();
                $this->open_id = D("Common/WeixinAuth")->getOpenId();
                //如果数据库中不存在该用户，则自动添加一条
                $rst = D('Api/Member')->isMember($this->open_id);
                if (!$rst) {
                    exit("sorry!");
                }
            } else {
                //微信网页登陆，回掉地址为当前页
                D("Common/WeixinAuth")->login("http://{$_SERVER['HTTP_HOST']}/VOne/index");
            }
        }
        //得到uid
        $uid = D('Api/Member')->getUid($this->open_id);
        if (!$uid) exit("place wait!");
        $this->uid = $uid;
        $this->assign('domain', C('home_domain'));
    }
}
