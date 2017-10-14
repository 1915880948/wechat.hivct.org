<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{yApp('name')}} | @yield('title','')</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  {!! yCsrfTag() !!}
  <link rel="stylesheet" href="{{yStatic('vendor/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="http://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="http://cdn.staticfile.org/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{yStatic('vendor/adminlte/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{yStatic('vendor/adminlte/css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{yStatic('vendor/plugins/iCheck/flat/blue.css')}}">
  <link rel="stylesheet" href="{{yStatic('vendor/plugins/morris/morris.css')}}">
  <link rel="stylesheet" href="{{yStatic('vendor/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
  <link rel="stylesheet" href="{{yStatic('vendor/plugins/datepicker/datepicker3.css')}}">
  <link rel="stylesheet" href="{{yStatic('vendor/plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{yStatic('vendor/plugins/chosen/chosen.min.css')}}">
  {{--<link rel="stylesheet" href="{{yStatic('vendor/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">--}}
  @yield('head-style')
  <!--[if lt IE 9]>
  <script src="http://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="http://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script><![endif]-->
  @yield('head-script')
</head>
<body class="hold-transition skin-blue layout-boxed sidebar-mini skin-purple-light">
<div class="wrapper">
  <header class="main-header">
    <a href="{{yApp('getHomeUrl')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">RP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>RYAN</b> Phonics</span> </a>
    @include('widgets.navtop')
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      {{--@include('widgets.userpanel')--}}
      {{--@include('widgets.search')--}}
      @include('widgets.sidebar')
    </section>
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @if(gHasError())
      <div class="alert alert-warning alert-dismissible">
        <h4><i class="icon fa fa-warning"></i> {{env('ERROR_TITLE')}}!</h4>
        {{gGetError()}}
      </div>
    @endif
    @yield('breadcrumb')
    <section class="content">
      @yield('content')
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
  </footer>
  {{--@include('widgets.control')--}}
</div>
<!-- ./wrapper -->
<script src="{{yStatic('vendor/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="http://cdn.staticfile.org/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{yStatic('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="http://cdn.staticfile.org/raphael/2.2.7/raphael.min.js"></script>
<script src="{{yStatic('vendor/plugins/morris/morris.min.js')}}"></script>
<script src="{{yStatic('vendor/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<script src="{{yStatic('vendor/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{yStatic('vendor/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{yStatic('vendor/plugins/knob/jquery.knob.js')}}"></script>
<script src="http://cdn.staticfile.org/moment.js/2.18.1/moment.min.js"></script>
<script src="{{yStatic('vendor/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{yStatic('vendor/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{yStatic('vendor/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{yStatic('vendor/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{yStatic('vendor/plugins/bootbox/bootbox.min.js')}}"></script>
<script src="{{yStatic('vendor/plugins/fastclick/fastclick.js')}}"></script>
<script src="{{yStatic('vendor/plugins/chosen/chosen.jquery.min.js')}}"></script>
<script src="{{yStatic('vendor/adminlte/js/app.min.js')}}"></script>
<script src="{{yStatic('vendor/adminlte/js/demo.js')}}"></script>
<script src="{{yStatic('vendor/yii/yii.js')}}"></script>
<script src="{{yStatic('vendor/plugins/layer/layer.js')}}"></script>
{{--<script src="{{yStatic('vendor/clipboard/jquery.zeroclipboard.min.js')}}"></script>--}}
<script src="//cdn.bootcss.com/clipboard.js/1.7.1/clipboard.min.js"></script>
<script>
    $(function () {
        $('.chosen-select').chosen();
        $('.v-preview').on('click', function () {
            var v = $(this).data('src');
            layer.open({
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                area: ['480px', '360px'], //宽高
                content: "<img src='" + v + "' style='width:100%'/>"
            });
        });
//        $("body").on('copy', '.zclipboard', function (e) {
//            e.clipboardData.clearData();
//            console.log($(this).data("zclip"));
//            e.clipboardData.setData("text/plain", $(this).data("zclip"));
//            layer.msg('COPY成功');
//            e.preventDefault();
//        });
        var clipboard = new Clipboard('.zclipboard', {
            text: function (trigger) {
                return trigger.getAttribute('data-zclip');
            }
        });
        clipboard.on('success', function (e) {
            layer.msg('COPY SUCCESS');
        });

        clipboard.on('error', function (e) {
            console.error('Action:', e.action);
            console.error('Trigger:', e.trigger);
        });
        $('#changelog').on('click', function () {
            layer.open({
                type: 2,
                title: '更新记录(最后更新时间：{{adminUpdateTime()}})',
                shadeClose: true,
                shade: 0.8,
                area: ['600px', '80%'],
                content: '{{yUrl(['site/changelog'])}}' //iframe的url
            });
        });
        setInterval(function () {
            $.post('{{yUrl(['api/queue'])}}', {_csrf: $('meta[name="csrf-token"]').attr('content')}, function (result) {
                if (result.status) {
                    var s = result.items;
                    var html = [];
                    if (s.video !== undefined && s.video > 0) {
                        html.push("有 " + s.video + "个视频自动被处理");
                    }
                    if (s.process !== undefined) {
                        if (s.process.process > 0){
                            html.push("有 " + s.process.process + "正在处理中");
                        }
                        if (s.process.retry){
                            html.push("有" + s.process.retry + "个需要重试");
                        }
                    }
                    if (s.reset !== undefined &&  s.reset > 0) {
                        html.push("重置" + s.reset + "条视频，它们将再次被处理");
                    }
                    if (html.length > 0) {
                        layer.open({
                            title: '视频处理',
                            type: 1,
                            skin: 'layui-layer-demo', //样式类名
                            closeBtn: 0, //不显示关闭按钮
                            anim: 2,
                            area: ['340px', '215px'],
                            offset: 'rb',
                            shade: 0,
                            shadeClose: true, //开启遮罩关闭
                            time: 5000,
                            content: "<ol>"+html.join("<br />")+"</ol>"
                        });
                    }

                }
            });
        }, 30*1000);
    })
</script>
{{--<script src='http://cdn.bootcss.com/socket.io/1.3.7/socket.io.js'></script>--}}
{{--<script>--}}
{{--var socket = io('http://localhost:2120');--}}
{{--// uid可以是自己网站的用户id，以便针对uid推送以及统计在线人数--}}
{{--uid = 123;--}}
{{--// socket连接后以uid登录--}}
{{--socket.on('connect', function () {--}}
{{--socket.emit('login', uid);--}}
{{--});--}}
{{--// 后端推送来消息时--}}
{{--socket.on('new_msg', function (msg) {--}}
{{--console.log("收到消息：" + msg);--}}
{{--});--}}
{{--// 后端推送来在线数据时--}}
{{--socket.on('update_online_count', function (online_stat) {--}}
{{--console.log(online_stat);--}}
{{--});--}}
{{--</script>--}}
@yield('foot-script')
</body>
</html>
