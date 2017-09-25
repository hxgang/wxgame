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
    
    <form method="post" action="<?php echo U();?>">
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">属性名称</td>
                <td>
                    <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>"> <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">商品类型ID</td>
                <td>
                    <?php echo arr2selected('goods_type_id',$goodsTypes,$goods_type_id);?>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">属性类型</td>
                <td>
                    <input type="radio" name="attribute_type" class="attribute_type" value="1"/>单值
                    <input type="radio" name="attribute_type" class="attribute_type" value="2"/>多值
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">录入方式</td>
                <td>
                    <input type="radio" name="attribute_input_type" class="attribute_input_type" value="1"/>手工录入
                    <input type="radio" name="attribute_input_type" class="attribute_input_type" value="2"/>从下面列表选择
                    <input type="radio" name="attribute_input_type" class="attribute_input_type" value="3"/>多行文本
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">可选值</td>
                <td>
                    <textarea name="option_values"  class="option_values" cols="60" rows="4" ><?php echo ($option_values); ?></textarea>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">属性</td>
                <td>
                    <textarea name="intro" cols="60" rows="4"><?php echo ($intro); ?></textarea>
                    <span class="require-field">*</span>
                </td>
            </tr>
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

</div>

<script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/common.js"></script>

    <script type="text/javascript">
        $(function(){
            //////////////////////////////默认值  开始////////////////////////////
            $('.attribute_type').val([<?php echo ((isset($attribute_type) && ($attribute_type !== ""))?($attribute_type):2); ?>]);
            $('.attribute_input_type').val([<?php echo ((isset($attribute_input_type) && ($attribute_input_type !== ""))?($attribute_input_type):2); ?>]);
           //////////////////////////////默认值  开始//////////////////////////////////
           //////////////////////////////单值/多值特效  开始////////////////////////////

        //>>1.找到多选按钮
        $('.attribute_type').click(function(){
            $(this).each(function(){
                if($(this).val()==1){
                    //单值
                    $('.attribute_input_type').click(function(){
                        $(this).each(function(){
                            if($(this).val()==1 || $(this).val()==3){
                                //禁用文本框.
                                $('.option_values').prop("disabled",true);
                            }else{
                                $('.option_values').prop("disabled",false);


                            }
                        });
                    });
                }else{
                    alert(1);
                    $('.attribute_input_type').click(function(){
                        $(this).each(function(){
                            $('.option_values').prop("disabled",false);
                        });
                    });
                }
            });
        });




           //////////////////////////////单值/多值特效  结束////////////////////////////

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