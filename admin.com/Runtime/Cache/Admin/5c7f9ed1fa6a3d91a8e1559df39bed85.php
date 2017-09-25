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
        <div class="tpl-portlet-components">
    <div class="portlet-title">
        <div class="caption font-green bold">
            <span class="am-icon-code"></span>订单列表
        </div>
    </div>
    <div class="tpl-block">
        <div class="am-g">
            <div class="form-div" >
                <form action="<?php echo U('OrderInfo/index');?>"  method="get" class="searchForm" style="font-size:12px">
                    订单号:<input style="width:140px;Border:1px solid #000 " name="order_sn" id="order_sn" size="20" type="text" value="<?php echo ($order_sn); ?>">
                    <!--收货人<input name="receiver" id="receiver" size="20" type="text" value="<?php echo ($receiver); ?>">-->

                    支付方式:
                    <select name="pay_type" id="pay_type">
                        <option value="-99">--请选择--</option>
                        <!--<option value="0" <?php if(($pay_status) == "0"): ?>selected="selected"<?php endif; ?>>未支付</option>-->
                        <option value="1" <?php if(($pay_status) == "1"): ?>selected="selected"<?php endif; ?>>已下单</option>
                    </select>
                    发货状态:
                    <select name="shipping_status" id="shipping_status">
                        <option value="-99">--请选择--</option>
                        <option value="0" <?php if(($shipping_status) == "0"): ?>selected="selected"<?php endif; ?>>未发货</option>
                        <!--<option value="1" <?php if(($shipping_status) == "1"): ?>selected="selected"<?php endif; ?>>配货中</option>-->
                        <option value="2"  <?php if(($shipping_status) == "2"): ?>selected="selected"<?php endif; ?>>已发货</option>
                    </select>
                    收货状态:
                    <select name="order_status" id="order_status">
                        <option value="-99">--请选择--</option>
                        <option value="0" <?php if(($order_status) == "0"): ?>selected="selected"<?php endif; ?>>未确认</option>
                        <option value="1" <?php if(($order_status) == "1"): ?>selected="selected"<?php endif; ?>>已签收</option>
                        <!--<option value="2"  <?php if(($order_status) == "2"): ?>selected="selected"<?php endif; ?>>退货中</option>-->
                        <option value="3"  <?php if(($order_status) == "3"): ?>selected="selected"<?php endif; ?>>已拒签</option>
                    </select>
                    <input value=" 搜索 " class="button" type="submit">
                    <input value=" 取消 " class="button" type="button" onclick="window.location.href='<?php echo U("OrderInfo/index");?>'">
                </form>
            </div>
        </div>
        <div class="am-g">
            <div class="am-u-sm-12">
                <form class="am-form">
                    <table class="am-table am-table-striped am-table-hover table-main">
                        <thead>
                        <tr>
                            <th>订单号</th>
                            <th>商品名称</th>
                            <th>收货人</th>
                            <th>总金额</th>
                            <th>折扣金额</th>
                            <th>下单金额</th>
                            <th>下单时间</th>
                            <th>备注</th>
                            <th>订单状态</th>
                            <th>操作</th>
                        </tr>
                        <?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td align='center'><?php echo ($vo["sn"]); ?></td>
                                <td align='center'><?php echo ($vo["goods_name"]); ?> X <?php echo ($vo["goods_num"]); ?></td>
                                <td align='center'><?php echo ($vo["receiver"]); ?></td>
                                <td align='center'><?php echo ((isset($vo["total_amount"]) && ($vo["total_amount"] !== ""))?($vo["total_amount"]):'-'); ?></td>
                                <td align='center'><?php echo ((isset($vo["discount_amount"]) && ($vo["discount_amount"] !== ""))?($vo["discount_amount"]):'-'); ?></td>
                                <td align='center'><?php echo ((isset($vo["real_amount"]) && ($vo["real_amount"] !== ""))?($vo["real_amount"]):'-'); ?></td>
                                <td align='center'><?php echo (date('Y-m-d:H:i:s',$vo["inputtime"])); ?></td>
                                <td align='center'><?php echo ((isset($vo["info"]) && ($vo["info"] !== ""))?($vo["info"]):'-'); ?></td>
                                <td align='center'>
                                    <?php switch($vo["pay_status"]): case "0": ?><font color="red">未支付</font><?php break;?>
                                        <?php case "1": ?><font color="green"> 已下单</font><?php break; endswitch;?> |
                                    <?php switch($vo["shipping_status"]): case "0": ?><font color="red"><a href="javascript::" onclick="changeStatus(1,<?php echo ($vo["id"]); ?>)"> 未发货 </a></font><?php break;?>
                                        <?php case "1": ?><font color="green"> 配货中</font><?php break;?>
                                        <?php case "2": ?><font color="green"> 已发货</font><?php break; endswitch;?> |
                                    <?php switch($vo["order_status"]): case "0": ?><font color="red">未确认</font><?php break;?>
                                        <?php case "1": ?><font color="green"> 已确认</font><?php break;?>
                                        <?php case "2": ?><font color="red"> 退货中</font><?php break;?>
                                        <?php case "3": ?><font color="green"> 已退货</font><?php break; endswitch;?>
                                </td>
                                <td align="center">
                                    <a href="<?php echo U('edit',array('id'=>$vo['id']));?>" title="编辑">详情</a> |
                                    <a href="javascript:;" onclick="delOrder(<?php echo ($vo[id]); ?>)" title="删除">移除</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>

                </form>
            </div>
            <div class="am-cf">
                <?php echo ($data["page"]); ?>
            </div>
        </div>
    </div>
    <div class="tpl-alert"></div>
</div>

<link rel="stylesheet" href="/Public/Admin/sweetalert/sweetalert2.css">
<script type="text/javascript" src="/Public/Admin/sweetalert/sweetalert2.js"></script>
    <script type="text/javascript">
        function changeStatus(type,id) {
            if (type == 1) { //发货
                swal.setDefaults({
                    input: 'text',
                    confirmButtonText: '下一步',
                    cancelButtonText: "取消",
                    showCancelButton: true,
                    animation: false,
                    progressSteps: ['1', '2', '3']
                })
                var steps = [
                    {
                        title: '填写快递单号',
                    },
                    '填写邮费',
                    '填写发货备注'
                ]
                var url = "<?php echo U('OrderInfo/index');?>";
                swal.queue(steps).then(function (result) {
                    swal.resetDefaults();
                    if(result[0]=='' && result[1]=='' && result[2]==''){
                        swal('','数据不能为空','error');
                        setTimeout(function () {
                            location.href =url;
                        }, 2000);
                        return;
                    }
                    if(result[0]  && result[1]==''){
                        swal('','快递费不能空','error');
                        setTimeout(function () {
                            location.href =url;
                        }, 2000);
                        return;
                    }
                    swal({
                        html: '确定提交?',
                        confirmButtonText: '确定',
                        preConfirm:function(){
                            $.post("<?php echo U('OrderInfo/addShippingData');?>",{'id':id,'type':1,'sn':result},function(data) {
                                if(data.code==1){
                                    swal('',data.message,'success');
                                    setTimeout(function () {
                                        location.href =data.url;
                                    }, 2000);
                                }else{
                                    swal("", data.message, "error");
                                }
                            })
                        }
                    })
                }, function () {
                    swal.resetDefaults();
                })
             /*   swal({
                    title: "",
                    text: "填写快递单号",
                    type: "input",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    confirmButtonText: "确定",
                    cancelButtonText: "取消",
                    inputPlaceholder: "快递单号"
                }, function (inputValue) {
                    if (inputValue === false) return false;
                    if (inputValue === "") {
                        swal.showInputError("请填写快递单号");
                        return false
                    }

                    $.post("<?php echo U('OrderInfo/addShippingData');?>",{'id':id,'type':1,'sn':inputValue},function(data) {
                        if(data.code==1){
                            swal('',data.message,'success');
                            setTimeout(function () {
                                location.href =data.url;
                            }, 2000);
                        }else{
                            swal("", data.message, "error");
                        }
                    })
                });*/
            }
        }
        /**
         * @description 删除订单
         * @param id  订单id
         */
        function delOrder(id){
            swal({
                title: '',
                text: "确定要删除该订单?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '确定',
                cancelButtonText: '取消'
            }).then(function () {
                $.post("<?php echo U('OrderInfo/changeStatus');?>",{'id':id},function(data) {
                    if(data.code==1){
                        swal('',data.message,'success');
                        setTimeout(function () {
                            location.href =data.url;
                        }, 2000);
                    }else{
                        swal("", data.message, "error");
                    }
                })
            })
        }
        function searchOrder(){
            var form_data=$('.searchForm').serialize();
            $.post("<?php echo U('OrderInfo/index');?>",form_data,function(data){
//                layer.msg(data.info, {
//                    icon: data.status ? 1 : 2,  //1是√，2是×
//                    time: 1000 //1秒关闭（如果不配置，默认是3秒）
//                }, function () {
//                    location.href = data.url; //提示框隐藏之后就刷新页面。
//                });
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