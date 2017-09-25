<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NB云端后台管理系统</title>
    <meta name="description" content="NB云端后台管理系统">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="/Public/Admin/assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="http://game.cn/Public/Admin/assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="http://game.cn/Public/Admin/assets/css/admin.css">
    <link rel="stylesheet" href="http://game.cn/Public/Admin/assets/css/app.css">
    <script src="http://game.cn/Public/Admin/assets/js/jquery.min.js"></script>
</head>
<body data-type="index">
<header class="am-topbar am-topbar-inverse admin-header">
    <div class="am-topbar-brand">
        <a href="javascript:;" class="tpl-logo">
            <img src="http://game.cn/Public/Admin/assets/img/logo.png" alt="">
        </a>
    </div>
    <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right">

    </div>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">
            <!--<li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                    <span class="am-icon-bell-o"></span> 提醒 <span class="am-badge tpl-badge-success am-round">5</span></span>
                </a>
                <ul class="am-dropdown-content tpl-dropdown-content">
                    <li class="tpl-dropdown-content-external">
                        <h3>你有 <span class="tpl-color-success">5</span> 条提醒</h3><a href="###">全部</a></li>
                    <li class="tpl-dropdown-list-bdbc"><a href="#" class="tpl-dropdown-list-fl"><span class="am-icon-btn am-icon-plus tpl-dropdown-ico-btn-size tpl-badge-success"></span> 【预览模块】移动端 查看时 手机、电脑框隐藏。</a>
                        <span class="tpl-dropdown-list-fr">3小时前</span>
                    </li>
                    <li class="tpl-dropdown-list-bdbc"><a href="#" class="tpl-dropdown-list-fl"><span class="am-icon-btn am-icon-check tpl-dropdown-ico-btn-size tpl-badge-danger"></span> 移动端，导航条下边距处理</a>
                        <span class="tpl-dropdown-list-fr">15分钟前</span>
                    </li>
                    <li class="tpl-dropdown-list-bdbc"><a href="#" class="tpl-dropdown-list-fl"><span class="am-icon-btn am-icon-bell-o tpl-dropdown-ico-btn-size tpl-badge-warning"></span> 追加统计代码</a>
                        <span class="tpl-dropdown-list-fr">2天前</span>
                    </li>
                </ul>
            </li>
            <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                    <span class="am-icon-comment-o"></span> 消息 <span class="am-badge tpl-badge-danger am-round">9</span></span>
                </a>
                <ul class="am-dropdown-content tpl-dropdown-content">
                    <li class="tpl-dropdown-content-external">
                        <h3>你有 <span class="tpl-color-danger">9</span> 条新消息</h3><a href="###">全部</a></li>
                    <li>
                        <a href="#" class="tpl-dropdown-content-message">
                                <span class="tpl-dropdown-content-photo">
                      <img src="assets/img/user02.png" alt=""> </span>
                            <span class="tpl-dropdown-content-subject">
                      <span class="tpl-dropdown-content-from"> 禁言小张 </span>
                                <span class="tpl-dropdown-content-time">10分钟前 </span>
                                </span>
                            <span class="tpl-dropdown-content-font"> Amaze UI 的诞生，依托于 GitHub 及其他技术社区上一些优秀的资源；Amaze UI 的成长，则离不开用户的支持。 </span>
                        </a>
                        <a href="#" class="tpl-dropdown-content-message">
                                <span class="tpl-dropdown-content-photo">
                      <img src="assets/img/user03.png" alt=""> </span>
                            <span class="tpl-dropdown-content-subject">
                      <span class="tpl-dropdown-content-from"> Steam </span>
                                <span class="tpl-dropdown-content-time">18分钟前</span>
                                </span>
                            <span class="tpl-dropdown-content-font"> 为了能最准确的传达所描述的问题， 建议你在反馈时附上演示，方便我们理解。 </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                    <span class="am-icon-calendar"></span> 进度 <span class="am-badge tpl-badge-primary am-round">4</span></span>
                </a>
                <ul class="am-dropdown-content tpl-dropdown-content">
                    <li class="tpl-dropdown-content-external">
                        <h3>你有 <span class="tpl-color-primary">4</span> 个任务进度</h3><a href="###">全部</a></li>
                    <li>
                        <a href="javascript:;" class="tpl-dropdown-content-progress">
                                <span class="task">
                        <span class="desc">Amaze UI 用户中心 v1.2 </span>
                                <span class="percent">45%</span>
                                </span>
                            <span class="progress">
                        <div class="am-progress tpl-progress am-progress-striped"><div class="am-progress-bar am-progress-bar-success" style="width:45%"></div></div>
                    </span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="tpl-dropdown-content-progress">
                                <span class="task">
                        <span class="desc">新闻内容页 </span>
                                <span class="percent">30%</span>
                                </span>
                            <span class="progress">
                       <div class="am-progress tpl-progress am-progress-striped"><div class="am-progress-bar am-progress-bar-secondary" style="width:30%"></div></div>
                    </span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="tpl-dropdown-content-progress">
                                <span class="task">
                        <span class="desc">管理中心 </span>
                                <span class="percent">60%</span>
                                </span>
                            <span class="progress">
                        <div class="am-progress tpl-progress am-progress-striped"><div class="am-progress-bar am-progress-bar-warning" style="width:60%"></div></div>
                    </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen" class="tpl-header-list-link"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
-->
            <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                    <span class="tpl-header-list-user-nick"><?php echo (session('adminName')); ?></span><span class="tpl-header-list-user-ico"> <img src="http://game.cn/Public/Admin/assets/img/user01.png"></span>
                </a>
                <ul class="am-dropdown-content">
                  <!--  <li><a href="#"><span class="am-icon-bell-o"></span> 资料</a></li>
                    <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>-->
                    <li><a href="/Login/logout" ><span class="am-icon-power-off"></span>退出</a></li>
                </ul>
            </li>
            <li><a href="###" class="tpl-header-list-link"><span class="am-icon-sign-out tpl-header-list-ico-out-size"></span></a></li>
        </ul>
    </div>
</header>
<div class="tpl-page-container tpl-page-header-fixed">
    <div class="tpl-left-nav tpl-left-nav-hover">
        <div class="tpl-left-nav-title">
            NB云管理平台
        </div>
        <div class="tpl-left-nav-list">
            <ul class="tpl-left-nav-menu">
                <li class="tpl-left-nav-item">
                    <a href="<?php echo U('/Index/index');?>" class="nav-link active">
                        <i class="am-icon-home"></i>
                        <span>首页</span>
                    </a>
                </li>

                <?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="tpl-left-nav-item">
                        <?php if(($vo["parent_id"]) == "0"): ?><a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                                <i class="am-icon-wpforms"></i>
                                <span><?php echo ($vo["name"]); ?></span>
                                <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                            </a>
                            <?php else: ?>
                            <ul class="tpl-left-nav-sub-menu" style="display: block;">
                                <li>
                                    <a href="/<?php echo ($vo["url"]); ?>">
                                        <i class="am-icon-angle-right"></i>
                                        <span><?php echo ($vo["name"]); ?></span>
                                        <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                    </a>
                                </li>
                            </ul><?php endif; ?>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>

                <!-- <li class="tpl-left-nav-item">
                     <a href="login.html" class="nav-link tpl-left-nav-link-list">
                         <i class="am-icon-key"></i>
                         <span>登录</span>
                     </a>
                 </li>-->
            </ul>
        </div>
    </div>
    <div class="tpl-content-wrapper">
        <div class="tpl-content-scope">
    <div class="note note-info">
        <h2>系统首页
            <span class="close" data-close="note"></span>
        </h2>
    </div>
</div>
<div class="row">
<div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
    <div class="dashboard-stat blue">
        <div class="visual">
            <i class="am-icon-comments-o"></i>
        </div>
        <div class="details">
            <div class="number"> <?php echo ($res["num"]); ?> 笔</div>
            <div class="desc"> 总订单 </div>
        </div>
        <a class="more" href="/OrderInfo/index"> 查看更多
            <i class="m-icon-swapright m-icon-white"></i>
        </a>
    </div>
</div>
<div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
    <div class="dashboard-stat red">
        <div class="visual">
            <i class="am-icon-bar-chart-o"></i>
        </div>
        <div class="details">
            <div class="number"> <?php echo ($res["total_amount"]); ?> 元</div>
            <div class="desc"> 总金额 </div>
        </div>
        <a class="more" href="#"> 查看更多
            <i class="m-icon-swapright m-icon-white"></i>
        </a>
    </div>
</div>
<div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
    <div class="dashboard-stat green">
        <div class="visual">
            <i class="am-icon-apple"></i>
        </div>
        <div class="details">
            <div class="number"> <?php echo ($res["discount_amount"]); ?> 元</div>
            <div class="desc"> 总优惠 </div>
        </div>
        <a class="more" href="#"> 查看更多
            <i class="m-icon-swapright m-icon-white"></i>
        </a>
    </div>
</div>
<div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
    <div class="dashboard-stat purple">
        <div class="visual">
            <i class="am-icon-android"></i>
        </div>
        <div class="details">
            <div class="number"> <?php echo ($res["real_amount"]); ?> 元 </div>
            <div class="desc"> 总收入 </div>
        </div>
        <a class="more" href="#"> 查看更多
            <i class="m-icon-swapright m-icon-white"></i>
        </a>
    </div>
</div>
    <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="am-icon-comments-o"></i>
            </div>
            <div class="details">
                <div class="number"> <?php echo ($data[0][0]); ?> 单</div>
                <div class="desc"> 未发货 </div>
            </div>
            <a class="more" href="/OrderInfo/index/shipping_status/0"> 查看更多
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="am-icon-comments-o"></i>
            </div>
            <div class="details">
                <div class="number"> <?php echo ($data[0][2]); ?> 单</div>
                <div class="desc"> 已发货 </div>
            </div>
            <a class="more" href="/OrderInfo/index/shipping_status/2"> 查看更多
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="am-icon-comments-o"></i>
            </div>
            <div class="details">
                <div class="number"> <?php echo ((isset($data[0][1]) && ($data[0][1] !== ""))?($data[0][1]):0); ?> 单</div>
                <div class="desc"> 签收 </div>
            </div>
            <a class="more" href="/OrderInfo/index/order_status/1"> 查看更多
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="am-icon-comments-o"></i>
            </div>
            <div class="details">
                <div class="number"> <?php echo ((isset($data[0][3]) && ($data[0][3] !== ""))?($data[0][3]):0); ?> 单</div>
                <div class="desc"> 拒签 </div>
            </div>
            <a class="more" href="/OrderInfo/index/order_status/3"> 查看更多
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</div>


<div class="row">
    <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="am-icon-comments-o"></i>
            </div>
            <div class="details">
                <div class="number">  <?php echo ($res["delivery_price"]); ?> 元</div>
                <div class="desc"> 总邮费 </div>
            </div>
            <a class="more" href="#"> 查看更多
                <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</div>







    </div>
    </div>

<script src="http://game.cn/Public/Admin/assets/js/amazeui.min.js"></script>
<!--<script src="http://game.cn/Public/Admin/assets/js/iscroll.js"></script>-->
<!--<script src="http://game.cn/Public/Admin/assets/js/app.js"></script>-->
<script type="text/javascript" src="http://game.cn/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://game.cn/Public/Admin/assets/js/common.js"></script>
</body>
</html>