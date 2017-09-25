<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0, maximum-scale=1.0,user-scalable=no">
<title>"福"气到家</title>
<link href="/Public/VOne/css/style.css" rel="stylesheet">
</head>
<body class="game_bg">
<div class="countdown hide"> 3</div>
<div class="rain-wrap show">
   <img src="/Public/VOne/images/3.png" style=""/>
  <div class="over_date left">倒计时 <span class="date_time">100</span> 秒</div>
  <div class="over_date right">总金额 <span class="money">0</span> 元</div>
</div>
<div class="pop hide">
  <div class="pop_bg">
    <!--弹窗顶部-->
    <div class="wall dw"><img src="/Public/VOne/images/boxtop.png">
      <!--<div class="pop_close" id="close" onclick="window.location.reload();" ></div>-->
    </div>
    <!--提示-->
    <div class="fd_pop hide" id="fd_pop1">
      <div class="fd_con">
        <div class="fd_font" id="tips">
          <div class="amount_tips hide">
              拥有金额： <span>0元</span>
          </div>
          <div class="share_tips hide">
              还有<span>0次</span>游戏机会
              <a  href="javascript:;"  id="qiang">去抢红包</a>
          </div>
          <div class="btn_tips" style="">
               <a class="pop_btn left share_btn" href="javascript:;" ><img src="/Public/VOne/images/btn_1.png" alt="去分享" title="去分享"></a>
               <a class="pop_btn right " href="<?php echo U('/VOne/shop');?>" ><img src="/Public/VOne/images/btn_2.png" alt="花掉它" title="花掉它" ></a>
          </div>
            <div class="order_tips hide">
               <!--  <div id="order_info">风扇 * 1个  &nbsp;&nbsp;&nbsp;&nbsp; <span class="green">已发货</span></div>
                <div id="order_deliver">物流单号是：21212121</div> -->
            </div>
        </div>
      </div>
    </div>
    <!--中奖了-->
    <div class="fd_pop hide" id="fd_pop6">
         <div class="fd_title wall">
             <!--<img src="/Public/VOne/images/font8.png">-->
         </div>
         <div class="wd_font">
            获得<span id="amount">0</span>元红包！<br>
            购买商品可以当现金抵用哦
        </div>
        <div class="price_btn">
            <a class="pop_btn left share_btn" href="javascript:;" ><img src="/Public/VOne/images/btn_1.png" alt="去分享" title="去分享"></a>
            <a class="pop_btn right" href="<?php echo U('/VOne/shop');?>" ><img src="/Public/VOne/images/btn_2.png" alt="花掉它" title="花掉它"></a>
        </div>
    </div>
    <!--弹窗底部-->
    <div class="wall boxbt"><img src="/Public/VOne/images/boxbt.png"></div>
</div>
 <!--分享弹窗图 + 文字说明-->
</div>
<div id="share hide">
  <img class="share" src="/Public/VOne/images/share.png" alt="分享箭头图">
  <a class="close_share" href="javascript:;" style="inline-block;width:100%;height:40px;position:absolute;bottom:0;z-index:1000;display:none;"></a>
</div>
<script type="text/javascript" src="/Public/VOne/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/Public/VOne/js/index.js" ></script>
<script src="/Public/plugin/layer/layer.js"></script>
</body>
<script type="text/javascript" src="/Public/VOne/js/rain.js" ></script>
<?php echo W('Share/Vone');?>
</html>