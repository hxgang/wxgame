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
    
    <form method="post" action="<?php echo U();?>" >
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">供货商名称</td>
                <td>
                    <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>" />
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">供货商介绍</td>
                <td>
                    <input type="text" name="intro" maxlength="60" size="40" value="<?php echo ($intro); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="sort" maxlength="40" size="15" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>" />
                </td>
            </tr>
            <tr>
                <td class="label">是否显示</td>
                <td>
                    <input type="radio" name="status" value="1" class="status" /> 是
                    <input type="radio" name="status" value="0"  class="status"/> 否
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br />
                    <input type="hidden" name="id" value="<?php echo ($id); ?>" />
                    <input type="submit" class="button ajax-post" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>


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