+function ($) {
    "use strict";

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    /**
     * 同步提交
     * @param url
     * @param data
     * @param callback
     * @returns {*}
     */
    $.synsJsonPost = function (url, data, callback) {
        data["_csrf"] = csrfToken;
        return $.ajax({
            url: url,
            data: data,
            dataType: 'json',
            method: 'POST',
            async: false,
            success: callback
        });
    };
    /**
     * 异步提交
     * @param url
     * @param data
     * @param callback
     * @param type
     * @returns {*}
     */
    $.jsonPost = function (url, data, callback, type) {
        if (data.length > 0 && data[0]['name'] != 'undefined') {
            data.push({"name": "_csrf", "value": csrfToken});
        } else {
            data["_csrf"] = csrfToken;
        }

        return $.post(url, data, callback, "JSON");
    };
    $.success = function (msg) {
        return layer.msg(msg, {icon: 1});
    };
    $.alert = function (msg, params) {
        return layer.msg(msg, {icon: 2});
    };
    $.confirm = function (msg, btns, success, fail) {
        layer.config({closeBtn: 0});
        return layer.confirm(msg, {
            btn: btns ? btns : ['确认', '取消'] //按钮
        }, success, fail ? fail : function () {

        });
    };
    $('a[data-alert]').hammer().on('tap', function () {
        console.log(11);
        var self = $(this);
        var info = $(self).data('info');
        $(self).removeAttr('href');
        $.success(info);
    });
    /**
     * show ryan Tipsw
     * @param msg
     */
    $.ryanTip = function (msg) {
        $('.dialog-text').html(msg);
        $('#dialog').removeClass('hide');
    };
    $.browser = {
        versions: function () {
            var u = navigator.userAgent, app = navigator.appVersion;
            return {
                trident: u.indexOf('Trident') > -1, //IE内核
                presto: u.indexOf('Presto') > -1, //opera内核
                webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1,//火狐内核
                mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
                ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                android: u.indexOf('Android') > -1 || u.indexOf('Adr') > -1, //android终端
                iPhone: u.indexOf('iPhone') > -1, //是否为iPhone或者QQHD浏览器
                iPad: u.indexOf('iPad') > -1, //是否iPad
                webApp: u.indexOf('Safari') == -1, //是否web应该程序，没有头部与底部
                weixin: u.indexOf('MicroMessenger') > -1, //是否微信 （2015-01-22新增）
                qq: u.match(/\sQQ/i) == " qq" //是否QQ
            };
        }(),
        language: (navigator.browserLanguage || navigator.language).toLowerCase()
    };
    $('.weui-switch').on('change', function () {
        console.log($(this).is(':checked'));
        $(this).val($(this).is(':checked') ? 1 : 0);
    });
}($);
