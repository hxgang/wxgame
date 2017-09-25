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
    <link href="http://www.19890407.com/Public/Admin/uploadify/uploadify.css" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        .upload-pre-item{
            position:relative;
            margin-right:10px;
        }
        .upload-pre-item a{
            position:absolute;
            top:0px;
            right:0px;
            width:15px;
            height:15px;
            text-align:center;
            background: white;
            color:red;
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
    
    <div id="tabbar-div">
        <p>
            <span class="tab-front">通用信息</span>
            <span class="tab-back">商品描述</span>
            <span class="tab-back">会员价格</span>
            <span class="tab-back">商品属性</span>
            <span class="tab-back">商品相册</span>
            <span class="tab-back">关联文章</span>
        </p>
    </div>
    <form method="post" action="<?php echo U();?>">
        <table cellspacing="1" cellpadding="3" width="100%">
            <tr>
                <td class="label">商品名称</td>
                <td>
                    <input type="text" name="name" maxlength="60" value="<?php echo ($name); ?>"> <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">商品分类</td>
                <td>
                    <input type="hidden" name="goods_category_id" class="goods_category_id" maxlength="60">
                    <input type="text" name="goods_category_text" class="goods_category_text" maxlength="60"
                           disabled="disabled">
                </td>
            </tr>
            <tr>
                <td class="label"></td>
                <td>
                    <ul id="treeDemo" class="ztree"></ul>
                </td>
            </tr>
            <tr>
                <td class="label">商品品牌</td>
                <td>
                    <?php echo arr2selected('brand_id',$brands,$brand_id);?>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">商品供货商</td>
                <td>
                    <?php echo arr2selected('supplier_id',$suppliers,$supplier_id);?>
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">本店价格</td>
                <td>
                    <input type="text" name="shop_price" maxlength="60" value="<?php echo ($shop_price); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">市场价格</td>
                <td>
                    <input type="text" name="market_price" maxlength="60" value="<?php echo ($market_price); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">库存</td>
                <td>
                    <input type="text" name="stock" maxlength="60" value="<?php echo ($stock); ?>"> <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">是否上架</td>
                <td>
                    <input type="radio" name="is_on_sale" class="is_on_sale" value="1"/>是
                    <input type="radio" name="is_on_sale" class="is_on_sale" value="0"> 否
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">商品状态</td>
                <td>
                    <input type="checkbox" name="goods_status[]" class="goods_status" value="1"/>精品
                    <input type="checkbox" name="goods_status[]" class="goods_status" value="2"/> 新品
                    <input type="checkbox" name="goods_status[]" class="goods_status" value="4"/> 热销
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">关键字</td>
                <td>
                    <input type="text" name="keyword" maxlength="60" value="<?php echo ($keyword); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">品牌LOGO</td>
                <td>
                    <input type="file" name="upload-logo" id="upload-logo"/>
                    <input type="hidden" class="logo" name="logo" value="<?php echo ($logo); ?>">

                    <div class="upload-img-box upload-goods-box" style="display: <?php echo ($logo?'block':'none'); ?>">
                        <div class="upload-pre-item">
                            <img src="/Uploads/<?php echo ($logo); ?>">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label">是否显示</td>
                <td>
                    <input type="radio" name="status" class="status" value="1"/>是
                    <input type="radio" name="status" class="status" value="0"> 否
                    <span class="require-field">*</span>
                </td>
            </tr>
            <tr>
                <td class="label">排序</td>
                <td>
                    <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):10); ?>">
                    <span class="require-field">*</span>
                </td>
            </tr>
        </table>
        <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
            <tr>
                <td>
                    <textarea name="intro" id="intro"><?php echo ($intro); ?></textarea>
                </td>
            </tr>
        </table>
        <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
            <?php if(is_array($memberLevels)): $i = 0; $__LIST__ = $memberLevels;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$memberLevel): $mod = ($i % 2 );++$i;?><tr>
                    <td class="label"><?php echo ($memberLevel["name"]); ?></td>
                    <td>
                        <input type="text" name="memberPrice[<?php echo ($memberLevel["id"]); ?>]" maxlength="60" value="<?php echo ($prices[$memberLevel['id']]); ?>">
                        <span  class="require-field">*</span>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>

        </table>
        <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
            <tr>
                <td class="label">商品属性</td>
                <td>
                    <input type="text" name="sort" maxlength="60" value="<?php echo ((isset($sort) && ($sort !== ""))?($sort):20); ?>"> <span
                        class="require-field">*</span>
                </td>
            </tr>
        </table>
        <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
            <tr>
                <td>
                    <div class="upload-img-box upload-album-box">
                        <?php if(is_array($albums)): $i = 0; $__LIST__ = $albums;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$album): $mod = ($i % 2 );++$i;?><div class="upload-pre-item" style="display: inline-block">
                                <img src="/Uploads/<?php echo ($album["path"]); ?>">
                                <a albumId="<?php echo ($album["id"]); ?>" href="javascript:;">X</a>
                            </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td><input type="file" name="upload-album" id="upload-album"></td>
            </tr>
        </table>
        <table cellspacing="1" cellpadding="3" width="100%" style="display: none">
            <tr>
                <td>文章搜索：<input type="text" name="title" class="title" maxlength="60" ><input type="button" class="search" value="搜索"></td>

            </tr>
            <tr>
                <td style="width:500px;">
                    <select name="left_select" class="left_select" multiple="multiple" style="width:100%;height:500px;">

                    </select>
                </td>
                <td style="width:500px;">
                    <div class="optionHidden">
                        <?php if(is_array($articles)): $i = 0; $__LIST__ = $articles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><input type="hidden" name="article_id[]" value="<?php echo ($article["id"]); ?>"><?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                    <select name="right_select" class="right_select" multiple="multiple" style="width:100%;height:500px;">
                        <?php if(is_array($articles)): $i = 0; $__LIST__ = $articles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($i % 2 );++$i;?><option value="<?php echo ($article["id"]); ?>"><?php echo ($article["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                    </select>
                </td>
            </tr>
        </table>

        <div style="text-align: center">
            <input type="hidden" name="id" value="<?php echo ($id); ?>"/>
            <input type="submit" class="button ajax-post_1" value=" 确定 "/>
            <input type="reset" class="button" value=" 重置 "/>
        </div>
    </form>


</div>

<div id="footer">
    共执行 1 个查询，用时 0.018952 秒，Gzip 已禁用，内存占用 2.197 MB<br/>
    版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
</div>

<script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://www.19890407.com/Public/Admin/js/common.js"></script>

    <script type="text/javascript" src="http://www.19890407.com/Public/Admin/zTree/js/jquery.ztree.core-3.5.js"></script>
    <script type="text/javascript" src="http://www.19890407.com/Public/Admin/uploadify/jquery.uploadify.js"></script>
    <script type="text/javascript" charset="utf-8" src="http://www.19890407.com/Public/Admin/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="http://www.19890407.com/Public/Admin/ueditor/ueditor.all.min.js"></script>
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="http://www.19890407.com/Public/Admin/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript">
        $(function () {
            //================================切换选项  开始==========================================//
            $('#tabbar-div span').click(function () {
                //改变选中项的样式
                $('#tabbar-div span').removeClass().addClass('tab-back');
                $(this).removeClass().addClass('tab-front');
                //显示对应的选中项的table
                $('form>table').hide();
                var index = $(this).index();
                $('form>table').eq(index).show();
                //当点击【商品描述】时，才加载编辑器
                if (index == 1) {
                    UE.getEditor('intro');
                }
            });
            //================================切换选项  结束==========================================//
            //================================默认值 开始============================================//
            $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);      //>>是否显示，必须是数组，才能让单选框选中
            $('.is_on_sale').val([<?php echo ((isset($is_on_sale) && ($is_on_sale !== ""))?($is_on_sale):1); ?>]);  //>>是否上架
            //================================默认值  结束===========================================//
            //================================商品分类   开始========================================//
            //>>1.树的设置
            var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id",
                    }
                },
                callback: {
                    beforeClick: function (treeId, treeNode, clickFlag) {
                        return !treeNode.isParent;  //是父节点整体结果就返回false,然后就不会选中节点
                    },
                    onClick: function (event, treeId, treeNode) {
                        //第三个参数会得到当前单击的对象
                        console.debug(treeNode);
                        $('.goods_category_text').val(treeNode.name);
                        $('.goods_category_id').val(treeNode.id);
                    }
                }
            };
            //>>2.(这里是json形式的数组)，准备树中需要的数据
            var zNodes = <?php echo ($nodes); ?>;
            //>>3.将id为treeDemo的ul变成一个树，返回值是该对象。
            var treeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            <?php if(!empty($id)): ?>//>>4.编辑页面不全部显示节点，数据回显
            var goods_category_id = <?php echo ($goods_category_id); ?>;
            var node = treeObj.getNodeByParam('id', goods_category_id);
            if (!node) {
                return;
            }
            treeObj.selectNode(node); //选中该节点
            $('.goods_category_id').val(node.id);
            $('.goods_category_text').val(node.name);
            <?php else: ?>
            //>>5.添加页面，所有节点展开
            treeObj.expandAll(true);<?php endif; ?>

                //==================================商品分类   结束========================================//
                //==================================文件上传   开始========================================//
                //由于是一个flash显示的插件，加载需要插件，如果出现浏览器崩溃情况，可以用一个定时器让页面加载完之后一点时间在显示。
            window.setTimeout(function () {
                $("#upload-logo").uploadify({
                    height: 25,    //指定删除插件的高和宽
                    width: 145,
                    swf: 'http://www.19890407.com/Public/Admin/uploadify/uploadify.swf',                          //指定swf的地址
                    uploader: '<?php echo U("Uploader/index");?>',                               //在服务器上处理上传的代码
                    'buttonText': '选择图片',                                              //上传按钮上面的文字
                    'fileSizeLimit': '100KB',                                              //限制大小
                    'formData': {'dir': 'goods'},                                    //通过post方式传递的额外参数,空间的名字
                    'multi': false,                                                      //是否支持多文件上传
                    'onUploadSuccess': function (file, data, response) {                    //上传成功时执行的方法
                        $('.logo').val(data);                                               //把上传的图片；路径给隐藏域。
                        $('.upload-img-box').show();                                        //显示隐藏的div
                        $('.upload-goods-box img').attr('src', "/Uploads/" + data);              //本地图片的显示路径
//                        $('.upload-goods-box img').attr('src',"__YPYUN__/"+data);           //云上图片的显示路径
                    },
                    'onUploadError': function (file, errorCode, errorMsg, errorString) {    //上传失败时该方法执行
                        alert('该文件上传失败!错误信息为:' + errorString);
                    }
                });
            }, 10);
            /*==================================文件上传   结束========================================*/
            /*==================================商品状态回显   开始========================================*/
            <?php if(!empty($id)): ?>var goods_status = <?php echo ($goods_status); ?>; //商品状态
            var goods_status_value = new Array();  //js中初始化数组
            if ((goods_status & 1) == 1) {      //这里最好是用括号括起来
                goods_status_value.push(1);  //把1放入数组
            }
            if ((goods_status & 2) == 2) {
                goods_status_value.push(2);
            }
            if ((goods_status & 4) == 4) {
                goods_status_value.push(4);
            }
            $('.goods_status').val(goods_status_value); //选中<?php endif; ?>
            /*==================================商品状态回显   结束========================================*/
            /*==================================商品相册上传   开始========================================*/
            window.setTimeout(function () {
                $("#upload-album").uploadify({
                    height: 25,    //指定删除插件的高和宽
                    width: 145,
                    swf: 'http://www.19890407.com/Public/Admin/uploadify/uploadify.swf',                          //指定swf的地址
                    uploader: '<?php echo U("Uploader/index");?>',                               //在服务器上处理上传的代码
                    'buttonText': '选择图片',                                              //上传按钮上面的文字
                    'fileSizeLimit': '100KB',                                              //限制大小
                    'formData': {'dir': 'goods'},                                    //通过post方式传递的额外参数,空间的名字
                    'multi': true,                                                      //是否支持多文件上传
                    'onUploadSuccess': function (file, data, response) {                    //上传成功时执行的方法
                       //上传成功就是把展示图片的代码追加到td中,并增加隐藏域保存图片路径
                        var html='<div class="upload-pre-item" style="display:inline-block">\
                                        <img src="/Uploads/'+data+'">\
                                        <a href="javascript:;">X</a>\
                                        <input type="hidden" name="upload_album_path[]" class="upload_album_path" value="'+data+'"/>\
                                </div>';
                        $('.upload-album-box').append(html);
                    },
                    'onUploadError': function (file, errorCode, errorMsg, errorString) {    //上传失败时该方法执行
                        alert('该文件上传失败!错误信息为:' + errorString);
                    }
                });
            }, 10);

            //编辑时，删除上传的相册图片
            $('.upload-album-box').on('click','a',function(){
                var albumId=$(this).attr('albumId');
                if(albumId){
                    //不是新上传(有albumId)--删除数据库中数据及页面节点
                    var aa=$(this);
                    $.post('<?php echo U("deleteGoodsAlbum");?>',{"album_id":albumId},function(data){
                        console.debug(data);
                        if(data.success){
                            //库中删除成功,删除页面节点
                            aa.closest('div').remove();
                        }
                    });
                }else{
                    //新上传--删除页面节点
                    $(this).closest('div').remove();
                }

            });
        /*==================================商品相册上传   结束=======================================*/
        /*==================================关联文章   开始=======================================*/
        //>>给搜索按钮绑定单击事件，把class=title中的内容发送ajax去服务器，模糊查询得到一系列标题，存放在left-serach框里面。
        $('.search').click(function(){
            var title=$('.title').val();
            $('.left_select').empty(); //清空数据
            if(title){   //有值
                $.getJSON('<?php echo U("Article/search");?>',{"title":title},function(data){
                    var optionHtml="";
                    $(data).each(function(){
                        optionHtml += "<option value='"+$(this)[0].id+"'>"+$(this)[0].name+"</option><br/>";
                    });
                    $('.left_select').append(optionHtml);
                });
            }

        });

        //给class=title的搜索框绑定键盘事件，回车的时候就阻止默认提交事件
        $('.title').keypress(function(event){
            if(event.charCode==13){   //键值charcode
                return false;
            }
        });
        //左边<=>右边
        $('.left_select').on('dblclick','option',function(){
            $(this).appendTo('.right_select');
            //为每个option添加隐藏域，用来保存每个文章的id
            select2Hidden();
        });
        $('.right_select').on('dblclick','option',function(){
            $(this).appendTo('.left_select');
            select2Hidden();
        });
        function select2Hidden(){
            var hiddenHtml="";
            $('.right_select option').each(function(){
                //这里this代表每个option节点
                hiddenHtml+="<input type='hidden' name='article_id[]' value='"+this.value+"'/>";
            });
            $('.optionHidden').empty();  //在加入div之前，先把盒子清空
            $('.optionHidden').append(hiddenHtml);
        }
        //对于下拉框而言，只有选中的才会提交。

        /*==================================关联文章   结束=======================================*/






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