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


    <div class="list-div" id="listDiv">
        <input type="button" class="button ajax-post" url="<?php echo U('changeStatus');?>" value="删除选中"/>
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th width="50px">序号<input type="checkbox" class="all"/></th>
                <th>订单</th>
                <th>用户名</th>
                <th>商品ids</th>
                <th>评论时间</th>
                <th>级别</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($rows)): $i = 0; $__LIST__ = $rows;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$row): $mod = ($i % 2 );++$i;?><tr>
                    <td align="center"><input type="checkbox" name="id[]" class="id" value="<?php echo ($row["id"]); ?>"/></td>
                    <td align='center'><?php echo ($row["sn"]); ?></td>
                    <td align='center'><?php echo ($row["username"]); ?></td>
                    <td align='center'><?php echo ($row["goods_ids"]); ?></td>
                    <td align='center'><?php echo (date('Y-m-d H:i:s',$row["create_at"])); ?></td>
                    <td align='center'>
                        <?php switch($row["start"]): case "1": ?>好<?php break;?>
                            <?php case "2": ?>中<?php break;?>
                            <?php case "3": ?>差<?php break; endswitch;?>
                    </td>
                    <td align="center">
                        <a href="<?php echo U('detail',array('id'=>$row['id']));?>" title="详情">详情</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </table>
        <div class="page">
            <?php echo ($pageHTML); ?>
        </div>
    </div>


<div id="footer"></div>

<script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/common.js"></script>

    <!---这里是预留的js块---->

<script type="text/javascript">
    $(function () {

    })
</script>
</body>
</html>