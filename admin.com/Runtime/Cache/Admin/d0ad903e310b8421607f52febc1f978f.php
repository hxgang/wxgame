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
    
        <span class="action-span"><a href="<?php echo U('add');?>">添加<?php echo ($meta_title); ?></a></span>
    
    <span class="action-span1"><a href="#">韩国馆 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?> </span>

    <div style="clear:both"></div>
</h1>

    <div class="form-div">
        <form action="<?php echo U();?>" name="searchForm">
            <img src="http://www.19890407.com/Public/Admin/images/icon_search.gif" width="26" height="22" border="0" alt="search"/>
            <input type="text" name="keyword" size="15"/>
            <input type="submit" value=" 搜索 " class="button"/>
        </form>
    </div>


    <form method="post" action="<?php echo U('Gii/index');?>" >
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">输入表名：</td>
                <td>
                    <input type="text" name="table_name" maxlength="60"/>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br />
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>


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