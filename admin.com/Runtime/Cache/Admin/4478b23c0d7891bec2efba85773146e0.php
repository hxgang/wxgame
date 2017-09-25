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
 
     <span class="action-span"><a href="<?php echo U('index');?>"><?php echo mb_substr($meta_title,2,'','utf-8');?>列表</a></span>
     <span class="action-span1"><a href="#">韩国馆 管理中心</a></span>
     <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?> </span>
     <div style="clear:both"></div>
 
</h1>
<div class="main-div">
    
    <div class="main-div">
        <table width="100%">
            <tbody><tr>
                <td>
                    <a href="mailto:ecshop@ecshop.com"><b><?php echo ($rows["username"]); ?></b></a>&nbsp;于      &nbsp;<?php echo (date('Y-m-d H:i:s',$rows["create_at"])); ?>&nbsp;对&nbsp;订单号为：<b><?php echo ($rows["sn"]); ?></b>的&nbsp;发表评论    </td>
            </tr>
            <tr>
                <td><hr color="#dadada" size="1"></td>
            </tr>
            <tr>
                <td>
                    <div style="overflow:hidden; word-break:break-all;"><?php echo ($rows["content"]); ?></div>
                    <div align="right"><b>评论等级:</b>
                        <?php switch($rows["start"]): case "1": ?>好评<?php break;?>
                            <?php case "2": ?>中评<?php break;?>
                            <?php case "3": ?>差评<?php break; endswitch;?>
                    </div>
                </td>
            </tr>
            <tr>
                <td align="center">
                    <input onclick="location.href='comment_manage.php?act=check&amp;check=forbid&amp;id=2'" value="禁止显示" class="button" type="button">
                </td>
            </tr>
            </tbody></table>
    </div>
    <div class="main-div">
        <form method="post" action="<?php echo U('Comment/replay');?>" name="theForm">
            <table align="center" border="0">
                <tbody><tr><th colspan="2">
                    <strong>回复评论</strong>
                </th></tr>
                <tr>
                    <td>回复内容:</td>
                    <td><textarea name="replay" cols="50" rows="4"><?php echo ($rows["replay"]); ?></textarea></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>提示: 此条评论已有回复, 如果继续回复将更新原来回复的内容!</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td>
                        <input value=" 确定 " class="button ajax-post" type="button" >
                        <input value=" 重置 " class="button" type="reset">
                        <!--<input name="comment_id" value="<?php echo ($rows["comment_id"]); ?>" type="hidden">-->
                        <input name="id" value="<?php echo ($rows["id"]); ?>" type="hidden">
                    </td>
                </tr>
                </tbody></table>
        </form>
    </div>


</div>

<div id="footer">

</div>

<script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/common.js"></script>

    <!---这里是预留的js块---->

<script type="text/javascript">
    $(function () {
        //>>1.给是否显示的单选按钮设置值，让它被选中
        $('.status').val([<?php echo ((isset($status ) && ($status !== ""))?($status ): 1); ?>]);
    });
</script>
</body>
</html>