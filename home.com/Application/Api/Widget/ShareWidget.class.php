<?php
namespace Api\Widget;

use Think\Controller;

class ShareWidget extends Controller
{
    public function Vone()
    {
        //获取分享链接
        $data = D("Common/Weixin")->buildJsSignature();
        $data['share_link'] = 'http://' . $_SERVER['HTTP_HOST'] . "/VOne/index";
        $data['logo'] = "http://{$_SERVER['HTTP_HOST']}/Public/VOne/images/fd1-1.png";
        $data['share_title'] = "中秋团圆,祈福领红包";
        $data['share_desc'] = "给家人一份祈祷、给朋友一个祝福、给大家一次分享、给自己领取红包";
        $this->assign($data);
        $this->assign('domain', C('home_domain'));
        $this->display(T('Api@Widget:VOne'));
    }
}