<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>韩国馆 管理中心 - 添加品牌 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="http://www.19890407.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css"/>
    <link href="http://www.19890407.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css"/>
    
    <link href="http://www.19890407.com/Public/Admin/zTree/css/zTreeStyle/zTreeStyle.css" rel="stylesheet" type="text/css"/>

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
                <td class="label">用户名</td>
                <td>
                    <input type="text" name="username" maxlength="60" value="<?php echo ($username); ?>">
                    <span   class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">密码</td>
                <td>
                    <input type="password" name="password" maxlength="60" value="<?php echo ($password); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">Email</td>
                <td>
                    <input type="text" name="email" maxlength="60" value="<?php echo ($email); ?>">
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">角色</td>
                <td>
                    <?php if(is_array($roles)): $i = 0; $__LIST__ = $roles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$role): $mod = ($i % 2 );++$i;?><input type="checkbox" name="role_ids[]" value="<?php echo ($role["id"]); ?>" class="role_ids"/><?php echo ($role["name"]); endforeach; endif; else: echo "" ;endif; ?>
                </td>
            </tr>
            <!--<tr>-->
                <!--<td class="label">额外权限</td>-->
                <!--<td>-->
                    <!--<div id="permission_id"></div>-->
                    <!--<ul id="treeDemo" class="ztree"></ul>-->
                <!--</td>-->
            <!--</tr>-->
            <tr>
                <td class="label">简介</td>
                <td>
                    <textarea name="intro" cols="60" rows="4"><?php echo ($intro); ?></textarea>
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
                    <input type="submit" class="button ajax-post-1" value=" 确定 "/>
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

    <script type="text/javascript" src="http://www.19890407.com/Public/Admin/zTree/js/jquery.ztree.core-3.5.js"></script>
    <script type="text/javascript" src="http://www.19890407.com/Public/Admin/zTree/js/jquery.ztree.excheck-3.5.js"></script>
    <script type="text/javascript">
        $(function () {

            //编辑时选中角色
            <?php if(!empty($id)): ?>$('.role_ids').val(<?php echo ($role_ids); ?>);<?php endif; ?>

             /*=============================树状结构=====================================*/
//
//            //>>1.树的设置
//            var setting = {
//                check: {
//                    enable: true  //允许被选中
//                },
//                data: {
//                    simpleData: {
//                        enable: true,
//                        pIdKey: "parent_id",
//                    }
//                },
//                callback: {
//                    onCheck:function(event,treeId,treeNode){
//                        //找到每个点击的节点。
//                        var nodes=treeObj.getCheckedNodes(true);
//                        //选中一个节点，就增加一个对应的隐藏域
//                        $('#permission_id').empty();
//                        $(nodes).each(function(){
//                            $('#permission_id').append("<input type='hidden' name='permission_ids[]' value='"+this.id+"'>");
//                        });
//                    }
//                }
//            };
//
//            //>>2.(这里是json形式的数组)，准备树中需要的数据
//            var zNodes = <?php echo ($nodes); ?>;
//            //>>3.将id为treeDemo的ul变成一个树，返回值是该对象。
//            var treeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
//            //>>4.展开节点
//            treeObj.expandAll(true);
//            /*>>5.-----------只有是编辑回显的时候，才需要将节点选中，并且父分类那里有值-----*/
//            <?php if(!empty($id)): ?>//            //编辑时:
//            var permission_ids = <?php echo ($permission_ids); ?>;
//            $(permission_ids).each(function(){
//                //根据每一个节点的属性id,找到每一个权限然后打钩
//                var node = treeObj.getNodeByParam('id',this);
//                treeObj.checkNode(node,true,false,true);  //node:需要选中的节点, 第一个true: 表示选中,  第二个false:表示不关联, 第三true: 表示选中时激活事件
//            });
//<?php endif; ?>




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