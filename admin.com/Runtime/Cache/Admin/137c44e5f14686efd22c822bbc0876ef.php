<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>韩国馆 管理中心 - 添加品牌 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="http://www.19890407.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css"/>
    <link href="http://www.19890407.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css"/>
    
    <link href="http://www.19890407.com/Public/Admin/uploadify/uploadify.css" rel="stylesheet" type="text/css" />

</head>
<body>
<h1>
 
     <span class="action-span"><a href="<?php echo U('index');?>"><?php echo mb_substr($meta_title,2,'','utf-8');?>列表</a></span>
     <span class="action-span1"><a href="#">韩国馆 管理中心</a></span>
     <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?> </span>
     <div style="clear:both"></div>
 
</h1>
<div class="main-div">
    
    <form method="post" action="<?php echo U();?>" enctype="multipart/form-data">
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">品牌名称</td>
                <td>
                    <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>">
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">品牌网址</td>
                <td>
                    <input type="text" name="url" maxlength="60" value="<?php echo ($url); ?>">
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">品牌LOGO</td>
                <td>
                    <input type="file" name="upload-logo" id="upload-logo"/>
                    <input type="hidden" class="logo" name="logo" value="<?php echo ($logo); ?>">

                    <div class="upload-img-box" style="display: <?php echo ($logo?'block':'none'); ?>">
                        <div class="upload-pre-item">
                            <!--<img src="http://itsource-brand.b0.upaiyun.com/<?php echo ($logo); ?>">-->
                            <img src="Uploads"/<?php echo ($logo); ?>">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label">品牌描述</td>
                <td>
                    <textarea name="intro" cols="60" rows="4"><?php echo ($intro); ?></textarea>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">状态</td>
                <td>
                    <input type="radio" class="status" value="1" name="status"/>是
                    <input type="radio" class="status" value="0" name="status"/>否
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>">                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><br />
                    <input type="hidden"  name="id" value="<?php echo ($id); ?>" />
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

    <script type="text/javascript" src="http://www.19890407.com/Public/Admin/uploadify/jquery.uploadify.js"></script>
    <script type="text/javascript">
        $(function(){
            window.setTimeout(function(){
                $("#upload-logo").uploadify({
                    height        : 25,    //指定删除插件的高和宽
                    width         : 145,
                    swf           : 'http://www.19890407.com/Public/Admin/uploadify/uploadify.swf',  //指定swf的地址
                    uploader      : '<?php echo U("Uploader/index");?>',   //在服务器上处理上传的代码
                    'buttonText' : '选择图片',   //上传按钮上面的文字
                    'fileSizeLimit' : '100KB',  //限制大小
                    'formData'      : {'dir' : 'brand'},   //通过post方式传递的额外参数
                    'multi'    : true,   //是否支持多文件上传
                    'onUploadSuccess' : function(file, data, response) {   //上传成功时执行的方法
                        $('.logo').val(data); //把上传的图片；路径给隐藏域。
                        $('.upload-img-box').show(); //显示隐藏的div
                        $('.upload-img-box img').attr('src',"/Uploads/"+data); //本地图片的显示路径
//                        $('.upload-img-box img').attr('src',"http://itsource-brand.b0.upaiyun.com/"+data); //云上图片的显示路径
                    },
                    'onUploadError' : function(file, errorCode, errorMsg, errorString) {   //上传失败时该方法执行
                        alert('该文件上传失败!错误信息为:' + errorString);
                    }
                });
            },10);
        })
    </script>

<script type="text/javascript">
    $(function () {
        //>>1.给是否显示的单选按钮设置值，让它被选中
        $('.status').val([<?php echo ((isset($status ) && ($status !== ""))?($status ): 1); ?>]);
    });
</script>
</body>
</html>