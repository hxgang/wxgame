<?php if (!defined('THINK_PATH')) exit();?><script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: '<?php echo ($appId); ?>', // 必填，公众号的唯一标识
        timestamp: '<?php echo ($timestamp); ?>', // 必填，生成签名的时间戳
        nonceStr: '<?php echo ($noncestr); ?>', // 必填，生成签名的随机串
        signature: '<?php echo ($signature); ?>',// 必填，签名，见附录1
        jsApiList: [ 'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'hideOptionMenu',
            'showOptionMenu',
            'hideMenuItems',
            'showMenuItems',
            'hideAllNonBaseMenuItem',
            'showAllNonBaseMenuItem',
            'closeWindow',
        ] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
    });
    wx.ready(function(){
        wx.onMenuShareAppMessage({
            title: '<?php echo ($share_title); ?>', // 分享标题
            desc: '<?php echo ($share_desc); ?>', // 分享描述
            link: '<?php echo ($share_link); ?>', // 分享链接
            imgUrl: '<?php echo ($logo); ?>', // 分享图标
            type: '', // 分享类型,music、video或link，不填默认为link
            dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
            success: function () {
                // 用户确认分享后执行的回调函数
                var url = 'http://admin.game.com/Api/Interface/index?class=VOne&method=share';
                $.ajax({
                    url: url,
                    data: {"params": '{"openid":"' + openid +'"}'},
                    type: 'POST',
                    success: function (data) {
                        if(data.res == 0 && data.data.err_code ==1){
                            window.location.href = 'v1/index.htnl';
                        }else{
                            layer.msg("分享失败",function(){});
                            return false;
                        }
                    },error:function(){
                        layer.msg("分享失败",function(){});
                        return false;
                    }
                });
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });

        wx.onMenuShareTimeline({
            title: '<?php echo ($share_title); ?>', // 分享标题
            link: '<?php echo ($share_link); ?>', // 分享链接
            imgUrl: '<?php echo ($logo); ?>', // 分享图标
            success: function () {
                // 用户确认分享后执行的回调函数
                var url = 'http://admin.game.com/Api/Interface/index?class=VOne&method=share';
                $.ajax({
                    url: url,
                    data: {"params": '{"openid":"' + openid +'"}'},
                    type: 'POST',
                    success: function (data) {
                        if(data.res == 0 && data.data.err_code ==1){
                            window.location.href = 'v1/index.htnl';
                        }else{
                            layer.msg("分享失败",function(){});
                            return false;
                        }
                    },error:function(){
                        layer.msg("分享失败",function(){});
                        return false;
                    }
                });
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });

        wx.hideAllNonBaseMenuItem();
        wx.showMenuItems({
            menuList: ['menuItem:share:timeline', 'menuItem:share:appMessage'] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
        });
    });
    wx.error(function(res){
        // config信息验证失败会执行error函数，如签名过期导致验证失败，具体错误信息可以打开config的debug模式查看，也可以在返回的res参数中查看，对于SPA可以在这里更新签名;
    });
</script>