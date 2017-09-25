<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>韩国馆 管理中心 - 添加品牌 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="http://www.19890407.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css"/>
    <link href="http://www.19890407.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css"/>
    
        <!---这里是预留的css样式块---->
    
</head>
<body>
<h1>
 
    <span class="action-span1"><a href="#">韩国馆 管理中心</a></span>
    <span id="search_id" class="action-span1"> - 订单详情操作 </span>
    <div style="clear:both"></div>

</h1>
<div class="main-div">
    
    <!--<form action="order.php?act=operate" method="post" name="theForm">-->
        <div class="list-div" style="margin-bottom: 5px">
            <table cellpadding="3" cellspacing="1" width="100%">
                <tbody>
                <tr>
                    <th colspan="4">基本信息</th>
                </tr>
                <tr>
                    <td width="18%"><div align="right"><strong>订单号：</strong></div></td>
                    <td width="34%"><?php echo ($orders["sn"]); ?></td>
                    <td width="15%"><div align="right"><strong>订单状态：</strong></div></td>
                    <td>
                        <?php switch($orders["pay_status"]): case "0": ?><font color="red">未支付</font><?php break;?>
                            <?php case "1": ?><font color="green"> 已付款</font><?php break; endswitch;?> |
                        <?php switch($orders["shipping_status"]): case "0": ?><font color="red">未发货</font><?php break;?>
                            <?php case "1": ?><font color="green"> 配送中</font><?php break;?>
                            <?php case "2": ?><font color="green"> 已发货</font><?php break; endswitch;?> |
                        <?php switch($orders["order_status"]): case "0": ?><font color="red">未确认</font><?php break;?>
                            <?php case "1": ?><font color="green"> 已确认</font><?php break;?>
                            <?php case "2": ?><font color="red"> 退货中</font><?php break;?>
                            <?php case "3": ?><font color="green"> 已退货</font><?php break; endswitch;?>
                    </td>
                </tr>
                <tr>
                    <td><div align="right"><strong>购货人：</strong></div></td>
                    <td><?php echo ($orders["username"]); ?></td>
                    <td><div align="right"><strong>下单时间：</strong></div></td>
                    <td><?php echo (date('Y-m-d H:i:s',$orders["inputtime"])); ?></td>
                </tr>

                <tr>
                    <th colspan="4">收货人信息</th>
                </tr>
                <tr>
                    <td><div align="right"><strong>收货人：</strong></div></td>
                    <td><?php echo ($orders["receiver"]); ?></td>
                </tr>
                <tr>
                    <td><div align="right"><strong>地址：</strong></div></td>
                    <td><?php echo ($orders["province_name"]); ?>&nbsp;<?php echo ($orders["city_name"]); ?>&nbsp;<?php echo ($orders["area_name"]); ?>&nbsp;<?php echo ($orders["detail_address"]); ?></td>
                </tr>
                <tr>
                    <td><div align="right"><strong>电话：</strong></div></td>
                    <td><?php echo ($orders["tel"]); ?></td>
                </tr>
                </tbody></table>
        </div>

        <div class="list-div" style="margin-bottom: 5px">
            <table cellpadding="3" cellspacing="1" width="100%">
                <tbody><tr>
                    <th colspan="8" scope="col">商品信息</th>
                </tr>
                <tr>
                    <td scope="col" style="width:15%;"><div align="center"><strong>商品名称</strong></div></td>
                    <td scope="col"  style="width:25%;"><div align="center"><strong>图片</strong></div></td>
                    <td scope="col"  style="width:15%;;"><div align="center"><strong>价格</strong></div></td>
                    <td scope="col"  style="width:15%;;"><div align="center"><strong>库存</strong></div></td>
                    <td scope="col"  style="width:15%;"><div align="center"><strong>数量</strong></div></td>
                    <td scope="col"  style="width:15%;"><div align="center"><strong>小计</strong></div></td>
                </tr>
                <?php if(is_array($infos)): $i = 0; $__LIST__ = $infos;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info): $mod = ($i % 2 );++$i;?><tr>
                        <td style="width:15%;line-height:50px; text-align: center"><?php echo ($info["name"]); ?></td>
                        <td style="width:25%;line-height:50px;text-align: center"><img src="http://www.19890407.com/Uploads/<?php echo ($info["logo"]); ?>" style="width:20%"/></td>
                        <td style="width:15%;line-height:50px;text-align: center"><?php echo ($info["shop_price"]); ?></td>
                        <td style="width:15%;line-height:50px;text-align: center"><?php echo ($info["stock"]); ?></td>
                        <td style="width:15%;line-height:50px;text-align: center"><?php echo ($info["num"]); ?></td>
                        <td style="width:15%;line-height:50px;text-align: center"><?php echo ($info["price"]); ?></td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <tr>
                    <td colspan="5"><div align="right"><strong>合计：￥0.00元</strong></div></td>
                </tr>
                </tbody></table>
        </div>

        <div class="list-div" style="margin-bottom: 5px">
            <table cellpadding="3" cellspacing="1">
                <tbody>
                <tr>
                    <th colspan="6"> 当前可执行操作：</th>
                </tr>
                <tr>
                    <td colspan="6" style="text-align:center">

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
    <!--</form>-->


</div>

<div id="footer">

</div>

<script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/common.js"></script>

    <script type="text/javascript" src="http://www.19890407.com/Public/Admin/layer/layer.js"></script>
    <script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/common.js"></script>
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

<script type="text/javascript">
    $(function () {
        //>>1.给是否显示的单选按钮设置值，让它被选中
        $('.status').val([<?php echo ((isset($status ) && ($status !== ""))?($status ): 1); ?>]);
    });
</script>
</body>
</html>