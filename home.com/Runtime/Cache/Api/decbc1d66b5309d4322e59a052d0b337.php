<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
<title>"福"气到家</title>
<link href="/Public/VOne/css/bootstrap.min.css" rel="stylesheet">
<link href="/Public/VOne/css/style.css" rel="stylesheet">
<style>
*{
  font-family: 'Open Sans','Helvetica Neue',Arial,"Hiragino Sans GB",sans-serif;
}
.nav{
  text-align: center;line-height:40px;height:40px;background-color: #c33b37;font-weight: bold;color: #ececec;margin-bottom: 10px;
}
.goods{
   /*margin-top:10px;*/
}
.goods dl{
    min-height:120px;
   border-bottom:1px #8c8c8c dotted;
    font-size:24px;
}
dl,dd,dt{
  height:100px;
}
.goods dt{
    height:100%;
}
.goods dt img{
  width:90%;  height:auto;
}
.goods dd{
    height:100%;
  padding:2% 1% 2% 0;
  font-size: 10px;
}
.addr{
  padding:0 10px;
  display: none;
  position: fixed;
  top:0;
  width:100%;
 /*box-shadow: 10px 10px 5px #888888;*/
   background-color: #efece5;
    min-height: 1000px;
    overflow: auto;
    overflow-x: hidden;
    overflow-y: hidden;
}
</style>
</head>
<body >
<div class="container">
   <div class="row goods">
      <div class="row nav">请选择商品</div>
      <div id="goods_info" class="row">
           <dl class="col-xs-12" >
              <dt class="col-xs-5">
                <img src='/Public/VOne/images/fd6.png' alt="商品2" id="goods_logo"/>
              </dt>
              <dd class="col-xs-7">
              </dd>
          </dl>
      </div>
     </div>
    <div class="row addr">
      <div class="row nav">请填写地址</div>
      <form class="form-horizontal" role="form" id="my_addr_form" method="post">
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">收货人</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="name" placeholder="请填写姓名" value="deng">
          </div>
        </div>
        <div class="form-group">
          <label for="phone" class="col-sm-2 control-label">联系电话</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="phone" placeholder="请确保手机通畅" value="18380448380">
          </div>
        </div>
        <div class="form-group">
          <label for="addr" class="col-sm-2 control-label">收货地址</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="addr" placeholder="市、省、县、街道" value="高新">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
              <button  class="btn btn-default" id="leave">狠心离开</button>
               &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <button  class="btn btn-danger" id="decide">货到付款</button> 
        </div>
        <input type="hidden" name='goods_id' value=""/>
      </form>
    </div>
</div>
<script src="/Public/VOne/js/jquery-1.11.2.min.js"></script>
<script src="/Public/VOne/js/shop.js"></script>
<script src="/Public/plugin/layer/layer.js"></script>
</body>
<?php echo W('Share/Vone');?>
</html>