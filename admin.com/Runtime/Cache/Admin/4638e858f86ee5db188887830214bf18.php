<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NB云端后台管理系统</title>
    <meta name="description" content="NB云端后台管理系统">
    <meta name="keywords" content="index">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="icon" type="image/png" href="/Public/Admin/assets/i/favicon.png">
    <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="http://game.cn/Public/Admin/assets/css/amazeui.min.css" />
    <link rel="stylesheet" href="http://game.cn/Public/Admin/assets/css/admin.css">
    <link rel="stylesheet" href="http://game.cn/Public/Admin/assets/css/app.css">
    <script src="http://game.cn/Public/Admin/assets/js/jquery.min.js"></script>
</head>
<body data-type="index">
<header class="am-topbar am-topbar-inverse admin-header">
    <div class="am-topbar-brand">
        <a href="javascript:;" class="tpl-logo">
            <img src="http://game.cn/Public/Admin/assets/img/logo.png" alt="">
        </a>
    </div>
    <div class="am-icon-list tpl-header-nav-hover-ico am-fl am-margin-right">

    </div>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list tpl-header-list">
            <!--<li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                    <span class="am-icon-bell-o"></span> 提醒 <span class="am-badge tpl-badge-success am-round">5</span></span>
                </a>
                <ul class="am-dropdown-content tpl-dropdown-content">
                    <li class="tpl-dropdown-content-external">
                        <h3>你有 <span class="tpl-color-success">5</span> 条提醒</h3><a href="###">全部</a></li>
                    <li class="tpl-dropdown-list-bdbc"><a href="#" class="tpl-dropdown-list-fl"><span class="am-icon-btn am-icon-plus tpl-dropdown-ico-btn-size tpl-badge-success"></span> 【预览模块】移动端 查看时 手机、电脑框隐藏。</a>
                        <span class="tpl-dropdown-list-fr">3小时前</span>
                    </li>
                    <li class="tpl-dropdown-list-bdbc"><a href="#" class="tpl-dropdown-list-fl"><span class="am-icon-btn am-icon-check tpl-dropdown-ico-btn-size tpl-badge-danger"></span> 移动端，导航条下边距处理</a>
                        <span class="tpl-dropdown-list-fr">15分钟前</span>
                    </li>
                    <li class="tpl-dropdown-list-bdbc"><a href="#" class="tpl-dropdown-list-fl"><span class="am-icon-btn am-icon-bell-o tpl-dropdown-ico-btn-size tpl-badge-warning"></span> 追加统计代码</a>
                        <span class="tpl-dropdown-list-fr">2天前</span>
                    </li>
                </ul>
            </li>
            <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                    <span class="am-icon-comment-o"></span> 消息 <span class="am-badge tpl-badge-danger am-round">9</span></span>
                </a>
                <ul class="am-dropdown-content tpl-dropdown-content">
                    <li class="tpl-dropdown-content-external">
                        <h3>你有 <span class="tpl-color-danger">9</span> 条新消息</h3><a href="###">全部</a></li>
                    <li>
                        <a href="#" class="tpl-dropdown-content-message">
                                <span class="tpl-dropdown-content-photo">
                      <img src="assets/img/user02.png" alt=""> </span>
                            <span class="tpl-dropdown-content-subject">
                      <span class="tpl-dropdown-content-from"> 禁言小张 </span>
                                <span class="tpl-dropdown-content-time">10分钟前 </span>
                                </span>
                            <span class="tpl-dropdown-content-font"> Amaze UI 的诞生，依托于 GitHub 及其他技术社区上一些优秀的资源；Amaze UI 的成长，则离不开用户的支持。 </span>
                        </a>
                        <a href="#" class="tpl-dropdown-content-message">
                                <span class="tpl-dropdown-content-photo">
                      <img src="assets/img/user03.png" alt=""> </span>
                            <span class="tpl-dropdown-content-subject">
                      <span class="tpl-dropdown-content-from"> Steam </span>
                                <span class="tpl-dropdown-content-time">18分钟前</span>
                                </span>
                            <span class="tpl-dropdown-content-font"> 为了能最准确的传达所描述的问题， 建议你在反馈时附上演示，方便我们理解。 </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                    <span class="am-icon-calendar"></span> 进度 <span class="am-badge tpl-badge-primary am-round">4</span></span>
                </a>
                <ul class="am-dropdown-content tpl-dropdown-content">
                    <li class="tpl-dropdown-content-external">
                        <h3>你有 <span class="tpl-color-primary">4</span> 个任务进度</h3><a href="###">全部</a></li>
                    <li>
                        <a href="javascript:;" class="tpl-dropdown-content-progress">
                                <span class="task">
                        <span class="desc">Amaze UI 用户中心 v1.2 </span>
                                <span class="percent">45%</span>
                                </span>
                            <span class="progress">
                        <div class="am-progress tpl-progress am-progress-striped"><div class="am-progress-bar am-progress-bar-success" style="width:45%"></div></div>
                    </span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="tpl-dropdown-content-progress">
                                <span class="task">
                        <span class="desc">新闻内容页 </span>
                                <span class="percent">30%</span>
                                </span>
                            <span class="progress">
                       <div class="am-progress tpl-progress am-progress-striped"><div class="am-progress-bar am-progress-bar-secondary" style="width:30%"></div></div>
                    </span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="tpl-dropdown-content-progress">
                                <span class="task">
                        <span class="desc">管理中心 </span>
                                <span class="percent">60%</span>
                                </span>
                            <span class="progress">
                        <div class="am-progress tpl-progress am-progress-striped"><div class="am-progress-bar am-progress-bar-warning" style="width:60%"></div></div>
                    </span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen" class="tpl-header-list-link"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
-->
            <li class="am-dropdown" data-am-dropdown data-am-dropdown-toggle>
                <a class="am-dropdown-toggle tpl-header-list-link" href="javascript:;">
                    <span class="tpl-header-list-user-nick"><?php echo (session('adminName')); ?></span><span class="tpl-header-list-user-ico"> <img src="http://game.cn/Public/Admin/assets/img/user01.png"></span>
                </a>
                <ul class="am-dropdown-content">
                  <!--  <li><a href="#"><span class="am-icon-bell-o"></span> 资料</a></li>
                    <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>-->
                    <li><a href="/Login/logout" ><span class="am-icon-power-off"></span>退出</a></li>
                </ul>
            </li>
            <li><a href="###" class="tpl-header-list-link"><span class="am-icon-sign-out tpl-header-list-ico-out-size"></span></a></li>
        </ul>
    </div>
</header>
<div class="tpl-page-container tpl-page-header-fixed">
    <div class="tpl-left-nav tpl-left-nav-hover">
        <div class="tpl-left-nav-title">
            NB云管理平台
        </div>
        <div class="tpl-left-nav-list">
            <ul class="tpl-left-nav-menu">
                <li class="tpl-left-nav-item">
                    <a href="<?php echo U('/Index/index');?>" class="nav-link active">
                        <i class="am-icon-home"></i>
                        <span>首页</span>
                    </a>
                </li>

                <?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="tpl-left-nav-item">
                        <?php if(($vo["parent_id"]) == "0"): ?><a href="javascript:;" class="nav-link tpl-left-nav-link-list">
                                <i class="am-icon-wpforms"></i>
                                <span><?php echo ($vo["name"]); ?></span>
                                <i class="am-icon-angle-right tpl-left-nav-more-ico am-fr am-margin-right tpl-left-nav-more-ico-rotate"></i>
                            </a>
                            <?php else: ?>
                            <ul class="tpl-left-nav-sub-menu" style="display: block;">
                                <li>
                                    <a href="/<?php echo ($vo["url"]); ?>">
                                        <i class="am-icon-angle-right"></i>
                                        <span><?php echo ($vo["name"]); ?></span>
                                        <i class="am-icon-star tpl-left-nav-content-ico am-fr am-margin-right"></i>
                                    </a>
                                </li>
                            </ul><?php endif; ?>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>

                <!-- <li class="tpl-left-nav-item">
                     <a href="login.html" class="nav-link tpl-left-nav-link-list">
                         <i class="am-icon-key"></i>
                         <span>登录</span>
                     </a>
                 </li>-->
            </ul>
        </div>
    </div>
    <div class="tpl-content-wrapper">
        ﻿
<div class="tpl-portlet-components">
    <div class="portlet-title">
        <div class="caption font-green bold">
            <span class="am-icon-code"></span> <?php if(empty($data["id"])): ?>新增商品<?php else: ?>编辑商品<?php endif; ?>
        </div>
    </div>
    <div class="tpl-block ">
        <div class="am-g tpl-amazeui-form">
            <div class="am-u-sm-12 am-u-md-9">
                <form class="am-form am-form-horizontal" method="post" action="<?php echo U();?>" onsubmit="sendPostData()">
                    <div class="am-form-group">
                        <label for="user-name" class="am-u-sm-3 am-form-label">商品名称</label>
                        <div class="am-u-sm-9">
                            <input type="text" id="user-name" name="name" value="<?php echo ($data["name"]); ?>" placeholder="商品名称">
                            <small>输入商品名称</small>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="" class="am-u-sm-3 am-form-label">商品价格</label>
                        <div class="am-u-sm-9">
                            <input type="text" name="shop_price" maxlength="60" value="<?php echo ($data["shop_price"]); ?>">
                            <small>输入商品价格</small>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="" class="am-u-sm-3 am-form-label">商品库存</label>
                        <div class="am-u-sm-9">
                            <input pattern="[0-9]*" name="stock"  value="<?php echo ($data["stock"]); ?>" type="number">
                            <small>输入商品库存</small>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-weibo" class="am-u-sm-3 am-form-label">商品图片</label>
                        <div class="am-u-sm-9">
                            <div class="am-form-group am-form-file">
                                <div class="tpl-form-file-img" id="upload_img">
                                    <?php if(empty($data["logo"])): ?><img   src="http://game.cn/Public/Admin/assets/img/a5.png" alt="">
                                    <?php else: ?>
                                        <img   src="<?php echo ($data["logo"]); ?>" alt=""><?php endif; ?>
                                </div>
                                <button type="button" class="am-btn am-btn-danger am-btn-sm">
                                    <i class="am-icon-cloud-upload"></i> 添加商品图片</button>
                                <input id="doc-form-file" multiple="" type="file">
                            </div>
                            <input type="hidden" id="logo" name="logo" value="<?php echo ($data["logo"]); ?>">
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="" class="am-u-sm-3 am-form-label">商品状态</label>
                        <div class="am-u-sm-9">
                            <input type="radio" name="status" class="status" value="1" <?php if(($data["status"]) == "1"): ?>checked<?php endif; ?>  />正常
                            <input type="radio" name="status" class="status" value="0" <?php if(($data["status"]) == "0"): ?>checked<?php endif; ?>> 停用
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-intro" class="am-u-sm-3 am-form-label">简介 / Intro</label>
                        <div class="am-u-sm-9">
                            <textarea name="keyword" rows="3"  id="keyword" placeholder="输入简介"><?php echo ($data["keyword"]); ?></textarea>
                        </div>
                    </div>
                    <div class="am-form-group">
                        <label for="user-intro" class="am-u-sm-3 am-form-label">商品详情</label>
                        <div class="am-u-sm-9">
                            <textarea type="text" id="detail" style="width:900px;height:400px;"><?php echo ($data["detail"]); ?></textarea>
                        </div>
                    </div>
                    <div style="text-align: center">
                        <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>"/>
                        <input type="submit" class="button"  value="保存"/>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<link rel="stylesheet" href="/Public/Admin/sweetalert/sweetalert2.css">
<script type="text/javascript" src="/Public/Admin/sweetalert/sweetalert2.js"></script>
<script type="text/javascript" charset="utf-8" src="http://game.cn/Public/Admin/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="http://game.cn/Public/Admin/ueditor/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="http://game.cn/Public/Admin/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">

    UE.getEditor('detail',{
        autoHeight: false,
        toolbars: [
            ['fullscreen', 'source', 'undo', 'redo' ,'simpleupload', 'insertimage','insertvideo','iframe','preview'],
            ['bold', 'italic', 'underline', 'source','fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc']
        ],
        autoClearinitialContent:false, //编辑器获取焦点时时自动清空初始化时的内容
        wordCount:true,                 //字数统计
        maximumWords:14000,
        wordCountMsg : '已输入 {#count} 个字符，您还可以输入{#leave} 个',
        wordOverFlowMsg : '<span style="color:red;">你输入的字符个数已经超出最大允许值，服务器可能会拒绝保存！</span>',
        initialFrameHeight:500          //高度
    });

    var editor = UE.getEditor('detail');
    function sendPostData(){
        swal({
            title: '',
            text: "确定保存?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '确定',
            cancelButtonText: '取消'
        }).then(function () {
            var is_valide =true;
            if (!UE.getEditor('detail').hasContents()){
                is_valide=false;
                swal("", '商品详情不能为空', "error");
            }else{
                var content2 =UE.getEditor('detail').getContent();
                $('#info').val(content2);
            }
        })
    }

</script>
    <script type="text/javascript" src="http://game.cn/Public/Admin/uploadify/jquery.uploadify.js"></script>
    <script type="text/javascript">
          //=======================文件上传   开始===================//
                //由于是一个flash显示的插件，加载需要插件，如果出现浏览器崩溃情况，可以用一个定时器让页面加载完之后一点时间在显示。
          $(document).ready(function(){
              //响应文件添加成功事件
              $("#doc-form-file").change(function(){

                  //创建FormData对象
                  var data = new FormData();
                  //为FormData对象添加数据
                 $.each($('#doc-form-file')[0].files, function(i, file) {
                      data.append('upload_file'+i, file);
                  });
                  //发送数据
                  $.ajax({
                      url:'<?php echo U("Uploader/index");?>', /*去过那个php文件*/
                      type:'POST',  /*提交方式*/
                      data:data,
                      cache: false,
                      contentType: false,        /*不可缺*/
                      processData: false,         /*不可缺*/
                      success:function(data){
                          if(data.code){
                              $("#upload_img img").attr('src',data.url);
                              $("#logo").val(data.url);
                          }
                      },
                      error:function(){
                          alert('上传出错');
                      }
                  });
              });
          });

    </script>

    </div>
    </div>

<script src="http://game.cn/Public/Admin/assets/js/amazeui.min.js"></script>
<!--<script src="http://game.cn/Public/Admin/assets/js/iscroll.js"></script>-->
<!--<script src="http://game.cn/Public/Admin/assets/js/app.js"></script>-->
<script type="text/javascript" src="http://game.cn/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://game.cn/Public/Admin/assets/js/common.js"></script>
</body>
</html>