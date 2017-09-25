'use strict';
var domain = $('input[name="domain"]').val();
$(function () {
    var url = 'http://' + domain + '/Interface/index?class=VOne&method=getGoodsList&params={}';
    $.getJSON(url, function (res) {
        var _html = '';
        $.each(res.data, function (k, v) {
            _html += '<dl>' +
                '<dt class="col-xs-5">' +
                '<img src="' + v.logo + '" alt="' + v.name + '" id="goods_logo" data-id="' + v.id + '" onclick=goto(this) />' +
                '</dt>' +
                '<dd class="col-xs-7">' +
                '<p id="goods_name">' + v.name + '</p>' +
                '<p id="goods_keyword">' + v.keyword + '</p>' +
                '<div id="price">￥<span>' + v.shop_price + '</span></div>' +
                '<div id="btn"><button class="btn btn-xs btn-danger" data-sale="' + v.sales + '" data-id="' + v.id + '"  onclick="buy(this)" id="goods_id">奉请</button>' +
                '<button class="btn btn-xs btn-success" data-id="' + v.id + '" onclick="back(this)">返回</button>' +
                '</div>' +
                '</dd>' +
                '</dl>';
        });
        $('#goods_info').empty().append(_html);
    });
    //go to lists
    $('#leave_1').click(function () {
        $('.addr').hide();
    });
    $('#leave_2').click(function () {
        $('.detail').hide();
    });
    // go to addr
    $('#decide_2').click(function () {
        handle(2);
        return false;
    });
    $('#decide_1').click(function () {
        handle(1);
        return false;
    });
});
function handle(flag) {
    var event = event || window.event;
    event.preventDefault(); // 兼容标准浏览器
    window.event.returnValue = false; // 兼容IE6~8
    //验证
    var name = $('#name_' + flag).val();
    var addr = $('#addr_' + flag).val();
    var phone = $('#phone_' + flag).val();
    var goods_id = $('input[name="goods_id"]').val();
    var name_flag = false, addr_flag = false, phone_flag = false,age_flag = false;
    if (!name) {
        $('#name_' + flag).closest('.form-group').addClass('has-error');
        $('#name_' + flag).closest('.form-group').find('label').html('请正确填写收货人');
    } else {
        $('#name_' + flag).closest('.form-group').removeClass('has-error');
        $('#name_' + flag).closest('.form-group').find('label').html('收货人');
        name_flag = true;
    }
    if (!addr) {
        $('#addr_' + flag).closest('.form-group').addClass('has-error');
        $('#addr_' + flag).closest('.form-group').find('label').html('请正确填写收货地址');
    } else {
        $('#addr_' + flag).closest('.form-group').removeClass('has-error');
        $('#addr_' + flag).closest('.form-group').find('label').html('收货地址');
        addr_flag = true;
    }
    if (!(/^1[34578]\d{9}$/.test(phone))) {
        $('#phone_' + flag).closest('.form-group').addClass('has-error');
        $('#phone_' + flag).closest('.form-group').find('label').html('请正确填写联系电话');

    } else {
        $('#phone_' + flag).closest('.form-group').removeClass('has-error');
        $('#phone_' + flag).closest('.form-group').find('label').html('联系电话');
        phone_flag = true;
    }
    var age =  $('#age_'+flag+'> label.active > input').val();
    console.log(age);
    if(age == undefined){
        $('#age_' + flag).closest('.form-group').addClass('has-error');
        $('#age_' + flag).closest('.form-group').find('label').first().html('请选择年龄段');
    }else{
        $('#age_' + flag).closest('.form-group').removeClass('has-error');
        $('#age_' + flag).closest('.form-group').find('label').first().html('年龄段');
        age_flag = true;
    }
    if (name_flag && addr_flag && phone_flag && age_flag) {
        var pro = $('select[name="province_' + flag + '"]').val();
        var city = $('select[name="city_' + flag + '"]').val();
        var area = $('select[name="area_' + flag + '"]').val();
        // 3.接口 下单
        var url = 'http://' + domain + '/Interface/index?class=VOne&method=create';
        $.post(url, {"params": '{"name":"' + name + '","addr":"' + addr + '","phone":"' + phone + '","goods_id":"' + goods_id + '","pro":"' + pro + '","city":"' + city + '","area":"' + area + '","age":'+age+'}'}, function (data) {
            if (data.res == 0 && data.data.err_code == 1) {
                layer.msg('下单成功 即将跳转...', function () {
                    window.location.href = data.data.url;
                }, 1000);
            } else {
                layer.msg(data.data.msg, function () {
                });
                return false;
            }
        });
    } else {
        return false;
    }
}
function buy(e) {
    var goods_id = $(e).attr('data-id');
    $('input[name="goods_id"]').val(goods_id);

    var price = $(e).closest('dd').find('#price').html();
    $('.addr .tip .amount').html(price);

    var goods_sale = $(e).attr('data-sale');
    $('.addr .tip .total b').html(goods_sale + '人');
    $("#distpicker_2").distpicker();
    $('.addr').show();
}

function back(e) {
    //window.history.go(-1);
    location.href='/VOne/index';
}
function goto(e) {
    $("#distpicker_1").distpicker(); //三级联动
    var domain = $('input[name="domain"]').val();
    var url = 'http://' + domain + '/Interface/index?class=VOne&method=getDetail'; 
    var goods_id = $(e).attr('data-id');
    $.ajax({
        url: url,
        data: {"params": '{"goods_id":' + goods_id + '}'},
        type: 'POST',
        success: function (data) {
            if (data.res == 0 && data.data.err_code == 1) {
                //成功
                var _html = "<p style=' line-height:30px; text-align: center;border-bottom: 1px solid #aaa; margin-bottom:10px;color: #aaa;'>暂无更多开光佛品信息</p>";
                if (data.data.info.detail) {
                    _html = data.data.info.detail;
                }
                if (data.data.info.video_url) {
                    $('#goods_detail_info #video').attr('src', 'http://player.youku.com/embed/'+data.data.info.video_url); 
                }else{
                      $('#goods_detail_info #video').attr('src', 'http://player.youku.com/embed/XMzA0NDA0MjI3Mg'); 
                }
                $('.detail .tip .amount').html('￥' + data.data.info.shop_price);
                $('.detail .tip .total').html(data.data.info.name);
                $('input[name="goods_id"]').val(data.data.info.id);

                $('#goods_detail_info .info').html(_html);
                $('.goods').hide();

                $('.detail').show();
            } else {
                 layer.msg(data.data.msg,function(){});
            }
        }
    });
}