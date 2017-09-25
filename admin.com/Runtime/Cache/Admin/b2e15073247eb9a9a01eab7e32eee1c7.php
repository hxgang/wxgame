<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - <?php echo ($meta_title); ?> </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://www.19890407.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://www.19890407.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />

    <link href="http://www.19890407.com/Public/Admin/ztree/css/zTreeStyle/zTreeStyle.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>"><?php echo mb_substr($meta_title,2,null,'utf-8');?>列表</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?></span>
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
                    <input type="hidden" name="parent_id" class="parent_id" maxlength="60" value="<?php echo ($parent_id); ?>">
                    <input type="text" name="parent_text" class="parent_text" disabled="disabled" value="默认为顶级菜单" maxlength="60">
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label"></td>
                <td>
                    <ul id="treeDemo" class="ztree"></ul>
                </td>
            </tr>

            <tr>
                <td class="label">权限</td>
                <td>
                    <div id="permission_ids"></div>
                    <ul id="treeDemo_permission" class="ztree"></ul>
                </td>
            </tr>
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
                    <input type="radio" class="status" value="1" name="status"/>是<input type="radio" class="status"
                                                                                        value="0" name="status"/>否 <span
                        class="require-field">*</span>
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
                    <input type="submit" class="button" value=" 确定 "/>
                    <input type="reset" class="button" value=" 重置 "/>
                </td>
            </tr>
        </table>
    </form>

</div>

<div id="footer">
共执行 1 个查询，用时 0.018952 秒，Gzip 已禁用，内存占用 2.197 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/common.js"></script>
<script type="text/javascript">
    $(function(){
        //选中是否显示的状态
        $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);
    });
</script>

    <script type="text/javascript" src="http://www.19890407.com/Public/Admin/ztree/js/jquery.ztree.core-3.5.js"></script>
    <script type="text/javascript" src="http://www.19890407.com/Public/Admin/ztree/js/jquery.ztree.excheck-3.5.js"></script>
    <script type="text/javascript">
        $(function(){
          /////////////////////菜单树   开始//////////////////////////////////
            var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id",
                    }
                },
                callback: {
                    onClick: function(event, treeId, treeNode){
                        $('.parent_id').val(treeNode.id);
                        $('.parent_text').val(treeNode.name);
                    }
                }
            };
            //>>2.准备树中需要的数据
            var zNodes =<?php echo ($nodes); ?>;
            //>>3.将id为treeDemo的ul变为一个树, 返回值就是该树的对象
            var treeObject = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            //>>4.使用对象中的方法让其展开
            treeObject.expandAll(true);

            <?php if(!empty($id)): ?>//说明是编辑, 需要根据父id找到树上的节点, 然后选中
            var parent_id = <?php echo ($parent_id); ?>;  //parent_id的值
            //根据parent_id找到对应的节点
            var parentNode =  treeObject.getNodeByParam('id',parent_id);
            if(parentNode){   //如果找到父分类,就选中
                //选中该节点
                treeObject.selectNode(parentNode);
                //将父节点的name和id赋值给
                $('.parent_id').val(parentNode.id);
                $('.parent_text').val(parentNode.name);
            }<?php endif; ?>
            /////////////////////菜单树   结束//////////////////////////////////


            /////////////////////权限树   开始//////////////////////////////////
            var setting_permission = {
                check: {
                    enable: true
                },
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id",
                    }
                },
                callback: {
                    onCheck: function(event, treeId, treeNode){
                        //>>1.得到打钩的所有的节点
                        var checkNodes = treeObject_permission.getCheckedNodes();
                        $('#permission_ids').empty();
                        //>>2.将节点中的id取出来
                         $(checkNodes).each(function(){
                             $("<input type='hidden' name='permission_ids[]' value='"+this.id+"'/>").appendTo('#permission_ids');
                         });
                    }
                }
            };
            //>>2.准备树中需要的数据
            var zNodes_permission =<?php echo ($permissions); ?>;
            //>>3.将id为treeDemo的ul变为一个树, 返回值就是该树的对象
            var treeObject_permission = $.fn.zTree.init($("#treeDemo_permission"), setting_permission, zNodes_permission);
            //>>4.使用对象中的方法让其展开
            treeObject_permission.expandAll(true);
            <?php if(!empty($id)): ?>var permission_ids  = <?php echo ($permission_ids); ?>;
                 $(permission_ids).each(function(){
                     var node = treeObject_permission.getNodeByParam('id',this);  //根据属性以及值找节点
                     treeObject_permission.checkNode(node,true,false,true);
                 });<?php endif; ?>
            /////////////////////菜单树   结束//////////////////////////////////

        });
    </script>

</body>
</html>