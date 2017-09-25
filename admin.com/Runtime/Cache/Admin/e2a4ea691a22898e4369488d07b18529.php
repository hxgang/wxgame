<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>ECSHOP 管理中心 - 添加品牌 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="http://www.19890407.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css"/>
    <link href="http://www.19890407.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css"/>
    
    <link href="http://www.19890407.com/Public/Admin/zTree/css/zTreeStyle/zTreeStyle.css" rel="stylesheet" type="text/css"/>

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
                <td class="label">菜单名称</td>
                <td>
                    <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>"> <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">菜单的URL</td>
                <td>
                    <input type="text" name="url" maxlength="60" value="<?php echo ($url); ?>"> <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">父菜单</td>
                <td>
                    <input type="hidden" name="parent_id" maxlength="60" value="<?php echo ($parent_id); ?>" class="parent_id">
                    <input type="text" name="parent_text" maxlength="60"  class="parent_text" disabled="disabled" value="默认是顶级分类">
                    <span class="require-field">*</span>
                    <ul id="treeDemo" class="ztree"></ul>
                </td>
            </tr>
            <!--<tr>-->
                <!--<td class="label">权限</td>-->
                <!--<td>-->
                   <!--<div id="permission_ids"></div>-->
                    <!--<ul id="treeDemo_permission" class="ztree"></ul>-->
                <!--</td>-->
            <!--</tr>-->
            <tr>
                <td class="label">简介</td>
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
                    <input type="submit" class="button ajax-post_1" value=" 确定 "/>
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
            /*============================  菜单树  ========================================*/
            var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id",
                    }
                },
                callback: {
                    onClick: function(event, treeId, treeNode){
                        //第三个参数会得到当前单击的对象
                        $('.parent_text').val(treeNode.name);
                        $('.parent_id').val(treeNode.id);
                    }
                }
            };

            //>>2.(这里是json形式的数组)，准备树中需要的数据
            var zNodes = <?php echo ($nodes); ?>;
            //>>3.将id为treeDemo的ul变成一个树，返回值是该对象。
            var treeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            //>>4.展开节点
            treeObj.expandAll(true);

            /*>>5.-----------只有是编辑回显的时候，才需要将节点选中，并且父分类那里有值-----*/
            <?php if(!empty($id)): ?>//这是php语言，thinkphp中empty标签。
            var parent_id=<?php echo ($parent_id); ?>; //让php语言在js中使用
            var parentNode=treeObj.getNodeByParam('id',parent_id); //根据id去找值为parent_id的节点。
            if(parentNode){
                treeObj.selectNode(parentNode); //选中给定值的节点。
                $('.parent_id').val(parentNode.id);
                $('.parent_text').val(parentNode.name);
            }<?php endif; ?>
            /*============================  权限树  ========================================*/

            //>>1.树的设置
            var setting_permission = {
                check: {
                    enable: true  //允许被选中
                },
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id",
                    }
                },
                callback: {
                    onCheck:function(event,treeId,treeNode){
                        //找到每个点击的节点。
                        var nodes=treeObj_permission.getCheckedNodes(true);
                        //选中一个节点，就增加一个对应的隐藏域
                        $('#permission_ids').empty();
                        $(nodes).each(function(){
                            $('#permission_ids').append("<input type='hidden' name='permission_ids[]' value='"+this.id+"'>");
                        });
                    }
                }
            };

            //>>2.(这里是json形式的数组)，准备树中需要的数据
            var zNodes_permission = <?php echo ($nodes_permission); ?>;
            //>>3.将id为treeDemo的ul变成一个树，返回值是该对象。
            var treeObj_permission = $.fn.zTree.init($("#treeDemo_permission"), setting_permission, zNodes_permission);
            //>>4.展开节点
            treeObj_permission.expandAll(true);
            /*>>5.-----------只有是编辑回显的时候，才需要将节点选中，并且父分类那里有值-----*/
            <?php if(!empty($id)): ?>var permission_ids = <?php echo ($permission_ids); ?>;
            $(permission_ids).each(function(){
                //根据每一个节点的属性id,找到每一个权限然后打钩
                var node = treeObj_permission.getNodeByParam('id',this);
                treeObj_permission.checkNode(node,true,false,true);  //node:需要选中的节点, 第一个true: 表示选中,  第二个false:表示不关联, 第三true: 表示选中时激活事件
            });<?php endif; ?>
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