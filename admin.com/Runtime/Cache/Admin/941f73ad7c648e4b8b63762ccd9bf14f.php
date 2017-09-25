<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>韩国馆 管理中心 - <?php echo ($meta_title); ?> </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="http://www.19890407.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css"/>
    <link href="http://www.19890407.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css"/>
    <link href="http://www.19890407.com/Public/Admin/css/page.css" rel="stylesheet" type="text/css"/>
    
        <!---这里是预留的css样式块---->
    
</head>
<body>
<h1>
    


    <span class="action-span1"><a href="#">韩国馆 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?> </span>

    <div style="clear:both"></div>
</h1>

    <div class="form-div">
        <form action="<?php echo U('OrderInfo/index');?>"  method="post" class="searchForm">
            <img src="http://www.19890407.com/Public/Admin/images/icon_search.gif" alt="SEARCH" border="0" height="22" width="26">
            订单号<input name="order_sn" id="order_sn" size="20" type="text" value="<?php echo ($order_sn); ?>">
            <!--收货人<input name="receiver" id="receiver" size="20" type="text" value="<?php echo ($receiver); ?>">-->
            支付状态
            <select name="pay_status" id="pay_status">
                <option value="-99">--请选择--</option>
                <option value="0" <?php if(($pay_status) == "0"): ?>selected="selected"<?php endif; ?>>未支付</option>
                <option value="1" <?php if(($pay_status) == "1"): ?>selected="selected"<?php endif; ?>>已付款</option>
            </select>
            发货状态
            <select name="shipping_status" id="shipping_status">
            <option value="-99">--请选择--</option>
            <option value="0" <?php if(($shipping_status) == "0"): ?>selected="selected"<?php endif; ?>>未发货</option>
            <option value="1" <?php if(($shipping_status) == "1"): ?>selected="selected"<?php endif; ?>>配货中</option>
            <option value="2"  <?php if(($shipping_status) == "2"): ?>selected="selected"<?php endif; ?>>已发货</option>
        </select>
            收货状态
            <select name="order_status" id="order_status">
            <option value="-99">--请选择--</option>
            <option value="0" <?php if(($order_status) == "0"): ?>selected="selected"<?php endif; ?>>未确认</option>
            <option value="1" <?php if(($order_status) == "1"): ?>selected="selected"<?php endif; ?>>已确认</option>
            <option value="2"  <?php if(($order_status) == "2"): ?>selected="selected"<?php endif; ?>>退货中</option>
            <option value="3"  <?php if(($order_status) == "3"): ?>selected="selected"<?php endif; ?>>已退货</option>
        </select>
            <input value=" 搜索 " class="button" type="submit">
            <input value=" 取消 " class="button" type="button" onclick="window.location.href='<?php echo U("OrderInfo/index");?>'">
        </form>
    </div>


    <div class="list-div" id="listDiv">
        <input type="button" class="button ajax-post" url="<?php echo U('changeStatus');?>" value="删除选中"/>
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th width="50px">序号<input type="checkbox" class="all"/></th>
                <th>订单号</th>
                <th>下单时期</th>
                <th>收货人</th>
                <th>总金额</th>
                <th>订单状态</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($orders)): $i = 0; $__LIST__ = $orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr>
                    <td align="center"><input type="checkbox" name="id[]" class="id" value="<?php echo ($row["id"]); ?>"/></td>
                    <td align='center'><?php echo ($row["sn"]); ?></td>
                    <td align='center'><?php echo ($row["order_time"]); ?></td>
                    <td align='center'><?php echo ($row["receiver"]); ?></td>
                    <td align='center'><?php echo ($row["money"]); ?></td>
                    <td align='center'>
                        <?php switch($row["pay_status"]): case "0": ?><font color="red">未支付</font><?php break;?>
                            <?php case "1": ?><font color="green"> 已付款</font><?php break; endswitch;?> |
                        <?php switch($row["shipping_status"]): case "0": ?><font color="red">未发货</font><?php break;?>
                            <?php case "1": ?><font color="green"> 配货中</font><?php break;?>
                            <?php case "2": ?><font color="green"> 已发货</font><?php break; endswitch;?> |
                        <?php switch($row["order_status"]): case "0": ?><font color="red">未确认</font><?php break;?>
                            <?php case "1": ?><font color="green"> 已确认</font><?php break;?>
                            <?php case "2": ?><font color="red"> 退货中</font><?php break;?>
                            <?php case "3": ?><font color="green"> 已退货</font><?php break; endswitch;?>
                    </td>

                    <td align="center">
                        <a href="<?php echo U('edit',array('id'=>$row['id']));?>" title="详情">详情</a> |
                        <a class="ajax-get" href="<?php echo U('changeStatus',array('id'=>$row['id']));?>" title="移除">移除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <div class="page">
            <?php echo ($pageHtml); ?>
        </div>
    </div>


<div id="footer"></div>

<script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/common.js"></script>

    <script type="text/javascript" src="http://www.19890407.com/Public/Admin/layer/layer.js"></script>
    <script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/common.js"></script>
    <script type="text/javascript">
        function searchOrder(){
            var form_data=$('.searchForm').serialize();
//            console.debug(form_data);
//            return;
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

<script type="text/javascript">
    $(function () {

    })
</script>
</body>
</html>