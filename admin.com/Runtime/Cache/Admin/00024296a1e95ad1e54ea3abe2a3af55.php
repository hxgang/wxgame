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
        <link href="/Public/Admin/My97DatePicker/skin/WdatePicker.css">
<script src="/Public/Admin/My97DatePicker/WdatePicker.js"></script>
<script src="http://game.cn/Public/Admin/assets/js/echarts.min.js"></script>

<div class="tpl-portlet-components">
        <div class="portlet-title">
            <div class="caption font-green bold">
                <span class="am-icon-code"></span>订单统计
            </div>
        </div>
        <div class="tpl-block">

            <div class="am-g">
                <div class="am-u-sm-12">
                    <form action="" class="am-form am-form-inline">
                        <div class="am-form-group am-form-icon">
                            <i class="am-icon-calendar"></i>
                            <input type="text" id="date_start" name="date_start" value="<?php echo ($date_start); ?>" class="am-form-field" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'date_end\')||\'%y-%M-%d\'}'})" placeholder="开始日期" />
                        </div>
                        <div class="am-form-group am-form-icon">
                            <i class="am-icon-calendar"></i>
                            <input type="text" id="date_end" name="date_end" value="<?php echo ($date_end); ?>" class="am-form-field" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'date_start\')}',maxDate:'%y-%M-%d'})" placeholder="结束日期" />
                        </div>
                        <button class="am-btn am-btn-default" id="video_search" onclick="this.form.submit();">搜索</button>
                        <input type="button" class="am-btn" onclick="javascript:location.href='<?php echo U("");?>';" value="清空" />
                    </form>
                </div>
            </div>
            <div class="am-g">

                <div class="am-u-sm-12">
                    <div class="tpl-content-scope"  style="top:50px;" >
                        <div class="note note-info" >
                            <p>数据统计: </p>
                            <p>订单数量:<span style="color:red"><?php echo ($order_all["num"]); ?>单</span> </p>
                            <p>订单金额:<span style="color:red"><?php echo ($order_all["price"]); ?>元</span> </p>
                        </div>
                    </div>
                    <div id="month_order_day" style="height:300px;top:10px;"></div>
                </div>
            </div>
        </div>
</div>
<div class="am-cf">
        <?php echo ($data["page"]); ?>
</div>
<script>
   var option_month_data = {
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data:['每日订单数','每日总金额']
        },
        toolbox: {
            show : true,
            feature : {
                mark : {show: true},
                dataView : {show: true, readOnly: false},
                magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : [<?php echo ($order_month_day_key); ?>]
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'每日订单数',
                type:'line',
                stack: '总量',
                symbol: 'none',
                data:[
                    <?php echo ($order_month_day_order_val); ?>
                ]
            }, {
                name:'每日总金额',
                type:'line',
                stack: '总量',
                symbol: 'none',
                data:[
                    <?php echo ($order_month_day_price_val); ?>
                ]
            }

        ]
    };

   echarts.init(document.getElementById('month_order_day')).setOption(option_month_data);

</script>






    </div>
    </div>
<script src="http://game.cn/Public/Admin/assets/js/jquery.min.js"></script>
<script src="http://game.cn/Public/Admin/assets/js/amazeui.min.js"></script>
<!--<script src="http://game.cn/Public/Admin/assets/js/iscroll.js"></script>-->
<!--<script src="http://game.cn/Public/Admin/assets/js/app.js"></script>-->
<script type="text/javascript" src="http://game.cn/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://game.cn/Public/Admin/assets/js/common.js"></script>
</body>
</html>