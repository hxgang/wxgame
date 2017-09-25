'use strict';
$(function () {
    var domain = $('input[name="domain"]').val();
    var url = 'http://www.phperror.cn/Interface/index?class=VOne&method=isStart';
    $.ajax({
        url: url,
        data: {"params": ''},
        type: 'POST',
        success: function (data) {
            if (data.res == 0 && data.data.err_code == 2) {
                //显示不同页面
                if (data.data.orders) {
                    var _order = data.data.orders;
                    var _html = '';
                    $.each(_order, function (k, v) {
                        var _class = Number(v.shipping_status) ? 'green' : '#890007';  //0未发货 1 配货中  2 已发货
                        _html += '<div id="order_info" style="font-size:14px;"><span class="order_info_name">' + v.goods_name + '</span> * ' + v.goods_num + '  &nbsp;&nbsp;&nbsp;&nbsp; <span style="color:' + _class + '">' + v.status + '</span></div>';
                        if (Number(v.shipping_status) > 1) {
                            _html += '<div id="order_deliver">物流单号是：' + v.deliver + '</div>';
                        }

                    });
                    $('.order_tips').empty().append(_html).hide();
                }
                if (data.data.member_info) {
                    var _info = data.data.member_info;
                    if (Number(_info.share)) {
                        $('.share_tips span').html(_info.share + '次');
                    } else {
                        $('.share_tips').css('color', '#890007');
                        $('.share_tips').empty().html('~多次分享,可以多次游戏哦~');
                    }
                    $('.share_tips').show();
                }
                $('.amount_tips span').html(_info.amount);
                $('.pop,#fd_pop1,.amount_tips').show();
                $('.countdown').hide();
            } else if (data.res == 0 && data.data.err_code == 1) {
                game();
            } else {
                layer.msg(data.msg, function () {
                });
            }
        }, error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError);
            layer.msg('~服务君太忙了,请稍后再试哦 1~', function () {
            });
        }
    });
    $('.share_btn').click(function () {
        $(".pop,.fd_pop,#fd_pop6,#fd_pop1").hide();
        $('#share,.share,.close_share').show();
        $('.close_share').click(function () {
            $('#share,.share,.close_share').hide();
            // $(".pop,#fd_pop1,.amount_tips").show();
            window.location.reload();
        });
    });
    $('#qiang').click(function () {
        $(".pop,#fd_pop6,#fd_pop1").hide();
        game(1);
    });
    $('#order_tips').click(function () {
        var display = $('.order_tips').css('display');
        console.log(display);
        if (display == 'block') {
            $(this).html('查看订单详情 ↓↓↓');
            $('.order_tips').hide();
        } else {
            $(this).html('取消查看 ↑↑↑');
            $('.order_tips').show();
        }

    });
});
function clickFun() {
    var src = $(this).attr("src");
    src = src.substring(src.length - 5, src.length - 4);
    $(this).attr("src", "/Public/VOne/images/fd" + src + "-1.png");
    $(this).fadeOut(500);
    //$(this).show();
    // 随机产生金额，并显示
    var old = Number($('.money').text());
    var money = Number((Math.random() * 2 + 1).toFixed(0));
    var old = old + money;
    $('.money').text(old);
}
function game(share = 0) {
    $('.countdown').show();
    var countdown = $(".countdown").html();

    var interval1 = setInterval(function () {
        //倒计时开始
        if (countdown == 1) {
            clearInterval(interval1);
            //显示游戏开始页面
            $('.countdown').hide();
            $('.rain-wrap').show();
            $('.rain-wrap').redEnvelope({'clickFun': clickFun});
            var over_time = $(".date_time").html();
            var interval2 = setInterval(function () {
                if (over_time == 0) {
                    clearInterval(interval2);
                    var _old = $('.money').text();
                    $('#amount').text(_old);
                    var domain = $('input[name="domain"]').val();
                    var url = 'http://www.phperror.cn/Interface/index?class=VOne&method=storeAmount';
                    $.ajax({
                        url: url,
                        data: {"params": '{"amount":' + _old + ',"share":' + share + '}'},
                        type: 'POST',
                        success: function (data) {
                            $('.rain-wrap').redEnvelope({'stop': stop});
                            //stopGame();
                            if (data.res == 0 && data.data.err_code == 2) {
                                $(".pop,#fd_pop2").show();
                                $(".rain-wrap").remove();
                            } else if (data.res == 0 && data.data.err_code == 1) {
                                $(".pop,#fd_pop6,#win_pop1").show();
                                $(".rain-wrap,#fd_pop2").remove();
                            } else {
                                $(".rain-wrap").remove();
                                layer.msg(data.data.msg, function () {
                                });
                            }
                        }, error: function (xhr, ajaxOptions, thrownError) {
                            console.log(thrownError);
                            $(".rain-wrap").remove();
                            $('.rain-wrap').redEnvelope({'stop': stop});
                            layer.msg('~服务君太忙了,请稍后再试哦 2~', function () {
                            });
                        }
                    });
                } else {
                    over_time--;
                    $(".date_time").html(over_time);
                }
            }, 1000);
        } else {
            countdown--;
            $(".countdown").html(countdown);
        }
    }, 1000);
}