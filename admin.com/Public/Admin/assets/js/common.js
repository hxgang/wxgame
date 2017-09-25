$(function () {

    //>>1.给每个class='ajax-get'的标签绑定点击事件，并且阻止默认操作。
    $('.ajax-get').click(function () {
        var url = $(this).attr('href');
        $.get(url, function (data) {
            //返回的信息，是由success来操作的。？？？？
            showLayer(data);
        });
        return false;
    });
    //>>2.给每个class="ajax-post"标签绑定点击事件，并且发送ajax的post请求。
    $('.ajax-post').click(function () {
        var form = $(this).closest('form');
        //找到了form,就用表单提交的值，没有就用标签上自定义的url属性的值。
        var url = form.length==0?$(this).attr('url'):form.attr('action');
        //对于复选框而言，只有选中了的用serialize才可得。
        var params = form.length==0?$('.id').serialize():form.serialize(); //这样可以得到所有的表单信息。
        $.post(url,params,function(data){
            showLayer(data);
        });
        return false; //阻止默认表单的默认提交事件。
    });

    /**
     * 根据data的值弹出提示框。
     * @param data
     */
    function showLayer(data) {
        layer.msg(data.info, {
            icon: data.status ? 1 : 2,  //1是√，2是×
            time: 1000 //1秒关闭（如果不配置，默认是3秒）
        }, function () {
            location.href = data.url; //提示框隐藏之后就刷新页面。
        });
    }


    /**
     * 复选框全选特效
     */

    //>>1.选择全选，所有的被选中。
    $('.all').change(function () {
        $('.id').prop('checked', $(this).prop('checked'));
    });
    //>>2.全部选中后，自动勾选全选。反之亦然。
    $('.id').change(function(){
        $('.all').prop('checked',$('.id:not(:checked)').length==0);
    });

});





