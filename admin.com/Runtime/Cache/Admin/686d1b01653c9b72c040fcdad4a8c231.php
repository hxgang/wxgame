<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 添加品牌 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="http://www.19890407.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css"/>
    <link href="http://www.19890407.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css"/>
    
    <style type="text/css">
        td.label{
            text-align: left;
            width:100px;
        }
    </style>

</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>"><?php echo mb_substr($meta_title,2,'','utf-8');?>列表</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?> </span>

    <div style="clear:both"></div>
</h1>
<div class="main-div">
    
    <form method="post" action="<?php echo U();?>">
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">标题</td>
                <td>
                    <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>"> <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">文章分类</td>
                <td>
                    <?php echo arr2selected('article_category_id',$article_categorys,$article_category_id);?>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">摘要</td>
                <td>
                    <textarea name="intro"><?php echo ($intro); ?></textarea>
                   <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">内容</td>
                <td>
                    <textarea name="content" id="content"><?php echo ($content); ?></textarea>
                     <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
            <tr>
                <td class="label">状态</td>
                <td>
                    <input type="radio" name="status" class="status" value="1"/>是
                    <input type="radio" name="status" class="status" value="0"/>否
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br/>
                    <input type="hidden" name="id" value="<?php echo ($id); ?>"/>
                    <input type="submit" class="button ajax-post" value=" 确定 "/>
                    <input type="reset" class="button" value=" 重置 "/>
                </td>
            </tr>
        </table>
    </form>


</div>

<div id="footer">
    共执行 1 个查询，用时 0.018952 秒，Gzip 已禁用，内存占用 2.197 MB<br/>
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
</div>

<script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/common.js"></script>

    <script type="text/javascript" charset="utf-8" src="http://www.19890407.com/Public/Admin/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="http://www.19890407.com/Public/Admin/ueditor/ueditor.all.min.js"></script>
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="http://www.19890407.com/Public/Admin/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">
        $(function(){
            /*-------------默认值 开始-------------------------*/

            $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);

            /*-------------默认值 结束-------------------------*/

           /*-------------编辑器 开始-------------------------*/
            UE.getEditor('content',{
                initialFrameWidth:700,  //初始化编辑器宽度,默认700
                initialFrameHeight:320  //初始化编辑器高度,默认320
                //默认是自动增高的。
        });
           /*-------------编辑器 结束-------------------------*/
        });

    </script>

<script type="text/javascript">
    $(function () {
        //>>1.给是否显示的单选按钮设置值，让它被选中
        $('.status').val([<?php echo ((isset($status ) && ($status !== ""))?($status ): 1); ?>]);
    });
</script>
</body>
</html>