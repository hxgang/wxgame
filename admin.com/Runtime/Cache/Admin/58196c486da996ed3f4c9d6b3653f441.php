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
        <div class="tpl-portlet-components">
    <div class="portlet-title">
        <div class="caption font-green bold">
            <span class="am-icon-code"></span> 订单详情
        </div>
    </div>

    <div data-am-widget="tabs" class="am-tabs am-tabs-d2" >
        <ul class="am-tabs-nav am-cf">
            <li class="am-active"><a href="[data-tab-panel-0]">订单详情</a></li>
            <!--<li class=""><a href="[data-tab-panel-1]">商品详情</a></li>-->
        </ul>
        <div class="am-tabs-bd">
            <div data-tab-panel-0 class="am-tab-panel am-active">
                <ul class="am-list am-list-static am-list-border">
                    <li>
                        <label>订单号:</label>
                            <?php echo ($orders["sn"]); ?>
                    </li>
                    <li>
                        <label>订单状态:</label>
                            <?php switch($orders["pay_status"]): case "0": ?><font color="red">未支付</font><?php break;?>
                                <?php case "1": ?><font color="green"> 已付款</font><?php break; endswitch;?> |
                            <?php switch($orders["shipping_status"]): case "0": ?><font color="red">未发货</font><?php break;?>
                                <?php case "1": ?><font color="green"> 配送中</font><?php break;?>
                                <?php case "2": ?><font color="green"> 已发货</font><?php break; endswitch;?> |
                            <?php switch($orders["order_status"]): case "0": ?><font color="red">未确认</font><?php break;?>
                                <?php case "1": ?><font color="green"> 已确认</font><?php break;?>
                                <?php case "2": ?><font color="red"> 退货中</font><?php break;?>
                                <?php case "3": ?><font color="green"> 已退货</font><?php break; endswitch;?>
                    </li>
                    <li>
                        <label >下单时间:</label>
                            <?php echo (date('Y-m-d H:i:s',$orders["inputtime"])); ?>
                    </li>
                    <li>
                        <label>收货人:</label>
                            <?php echo ($orders["receiver"]); ?>
                    </li>
                    <li>
                        <label >收货地址:</label>
                            <?php echo ($orders["province_name"]); ?>&nbsp;<?php echo ($orders["city_name"]); ?>&nbsp;<?php echo ($orders["area_name"]); ?>&nbsp;<?php echo ($orders["detail_address"]); ?>
                    </li>
                    <li>
                        <label >联系方式:</label>
                            <?php echo ($orders["tel"]); ?>
                    </li>
                </ul>

                <ul class="am-list am-list-static am-list-border">
                    <li>
                        <label >商品原价:</label>
                        <?php echo ($orders["total_amount"]); ?>
                    </li>
                    <li>
                        <label >折扣金额:</label>
                        <?php echo ($orders["discount_amount"]); ?>
                    </li>
                    <li>
                        <label >快递邮费:</label>
                        <?php echo ($orders["delivery_price"]); ?>
                    </li>
                    <li>
                        <label >货到付款价格:</label>
                        <?php echo ($orders["real_amount"]); ?>
                    </li>
                </ul>
            </div>
            <div data-tab-panel-1 class="am-tab-panel ">
                <table class="am-table am-table-bordered am-table-radius am-table-striped">
                    <thead>
                    <tr>
                        <th>商品名称</th>
                        <th>商品图片</th>
                        <th>商品价格</th>
                        <th>商品库存</th>
                        <th>商品数量</th>
                        <th>商品价格</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($infos)): $i = 0; $__LIST__ = $infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
                            <td style="width:15%;line-height:50px; text-align: center"><?php echo ($info["name"]); ?></td>
                            <td style="width:25%;line-height:50px;text-align: center"><img src="http://www.19890407.com/Uploads/<?php echo ($info["logo"]); ?>" style="width:20%"/></td>
                            <td style="width:15%;line-height:50px;text-align: center"><?php echo ($info["shop_price"]); ?></td>
                            <td style="width:15%;line-height:50px;text-align: center"><?php echo ($info["stock"]); ?></td>
                            <td style="width:15%;line-height:50px;text-align: center"><?php echo ($info["num"]); ?></td>
                            <td style="width:15%;line-height:50px;text-align: center"><?php echo ($info["price"]); ?></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
    </div>
    </div>
    <!--    <div class="list-div" style="margin-bottom: 5px">
            <table cellpadding="3" cellspacing="1">
                <tbody>
                <tr>
                    <th colspan="6"> 当前可执行操作：</th>
                </tr>
                <tr>
                    <td colspan="6" style="text-align:center">
                        <?php if(($orders["pay_type_id"] == 1) and ($orders["pay_status"] != 1)): ?><input type="button" class="button" name="confirm" value="确认收款" onclick="change2(1)"/><?php endif; ?>
                        <?php switch($orders["shipping_status"]): case "0": ?><input type="button" class="button" name="prepare" value="配货中" onclick="change(1)"/>
                                <input type="button" class="button" name="confirm" value="发货" onclick="change(2)"/><?php break;?>
                            <?php case "1": ?><input type="button" class="button" name="confirm" value="发货" onclick="change(2)"/><?php break;?>
                            <?php case "2": if(($orders["order_status"]) == "2"): ?><input type="button" class="button" name="confirm" value="确认退款" onclick="back(3)"/><?php endif; break; endswitch;?>
                        <input name="order_id" value="<?php echo ($orders["id"]); ?>" type="hidden" id="order_id">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>-->
</div>

<script type="text/javascript">
    var order_id=$('#order_id').val();
    //改变发货状态
    function change(shipping_status){
        $.post("<?php echo U('OrderInfo/change');?>",{shipping_status:shipping_status,order_id:order_id},function(data){
            layer.msg(data.info, {
                icon: data.status ? 1 : 2,  //1是√，2是×
                time: 1000 //1秒关闭（如果不配置，默认是3秒）
            }, function () {
                location.href = data.url; //提示框隐藏之后就刷新页面。
            });
        });
    }

    //改变付款状态-货到付款
    function change2(pay_status){
        $.post("<?php echo U('OrderInfo/change2');?>",{pay_status:pay_status,order_id:order_id},function(data){
            layer.msg(data.info, {
                icon: data.status ? 1 : 2,  //1是√，2是×
                time: 1000 //1秒关闭（如果不配置，默认是3秒）
            }, function () {
                location.href = data.url; //提示框隐藏之后就刷新页面。
            });
        });
    }

    //退款
    function back(order_status){
        $.post("<?php echo U('OrderInfo/back');?>",{order_status:order_status,order_id:order_id},function(data){
            layer.msg(data.info, {
                icon: data.status ? 1 : 2,  //1是√，2是×
                time: 1000 //1秒关闭（如果不配置，默认是3秒）
            }, function () {
                location.href = data.url; //提示框隐藏之后就刷新页面。
            });
        });
    }


</script>
    </div>
    </div>

<script src="http://game.cn/Public/Admin/assets/js/amazeui.min.js"></script>
<!--<script src="http://game.cn/Public/Admin/assets/js/iscroll.js"></script>-->
<!--<script src="http://game.cn/Public/Admin/assets/js/app.js"></script>-->
<script type="text/javascript" src="http://game.cn/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://game.cn/Public/Admin/assets/js/common.js"></script>
</body>
</html>