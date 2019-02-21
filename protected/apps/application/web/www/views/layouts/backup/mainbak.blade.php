<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{yApp('name')}} | @yield('title','')</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  {!! yCsrfTag() !!}
  <link rel="stylesheet" href="{{gStatic('vendor/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="http://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="http://cdn.staticfile.org/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{gStatic('vendor/adminlte/css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{gStatic('vendor/adminlte/css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{gStatic('vendor/plugins/iCheck/flat/blue.css')}}">
  <link rel="stylesheet" href="{{gStatic('vendor/plugins/morris/morris.css')}}">
  <link rel="stylesheet" href="{{gStatic('vendor/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">
  <link rel="stylesheet" href="{{gStatic('vendor/plugins/datepicker/datepicker3.css')}}">
  <link rel="stylesheet" href="{{gStatic('vendor/plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{gStatic('vendor/plugins/chosen/chosen.min.css')}}">
  @yield('head-style')
  @yield('head-script')
</head>
<body class="hold-transition skin-blue layout-boxed sidebar-mini skin-purple-light">
<div class="wrapper">
  <header class="main-header">
    <a href="###" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b></b> {{Yii::t('www','彩虹艾滋调研')}}</span> </a>
  </header>
  {{--<aside class="main-sidebar">--}}
  {{--<section class="sidebar">--}}
  {{--@include('widgets.sidebar')--}}
  {{--</section>--}}
  {{--</aside>--}}
  <div class="content-wrapper">
    @if(gHasError())
      <div class="alert alert-warning alert-dismissible">
        <h4><i class="icon fa fa-warning"></i> {{env('ERROR_TITLE')}}!</h4>
        {{gGetError()}}
      </div>
    @endif
    {{--@yield('breadcrumb')--}}
    <section class="content">
      @yield('content')
    </section>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2014-{{date("Y")}} <a href="http://hivct.com">Hivct.COM</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->
<script src="{{gStatic('vendor/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="http://cdn.staticfile.org/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="{{gStatic('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="http://cdn.staticfile.org/raphael/2.2.7/raphael.min.js"></script>
<script src="{{gStatic('vendor/plugins/morris/morris.min.js')}}"></script>
{{--<script src="{{gStatic('vendor/plugins/sparkline/jquery.sparkline.min.js')}}"></script>--}}
{{--<script src="{{gStatic('vendor/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>--}}
{{--<script src="{{gStatic('vendor/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>--}}
{{--<script src="{{gStatic('vendor/plugins/knob/jquery.knob.js')}}"></script>--}}
<script src="http://cdn.staticfile.org/moment.js/2.18.1/moment.min.js"></script>
<script src="{{gStatic('vendor/plugins/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{gStatic('vendor/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{gStatic('vendor/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{gStatic('vendor/plugins/bootbox/bootbox.min.js')}}"></script>
<script src="{{gStatic('vendor/plugins/fastclick/fastclick.js')}}"></script>
<script src="{{gStatic('vendor/plugins/chosen/chosen.jquery.min.js')}}"></script>
<script src="{{gStatic('vendor/adminlte/js/app.min.js')}}"></script>
<script src="{{gStatic('vendor/adminlte/js/demo.js')}}"></script>
<script src="{{gStatic('vendor/yii/yii.js')}}"></script>
<script src="{{gStatic('vendor/plugins/layer/layer.js')}}"></script>
<script src="//cdn.bootcss.com/clipboard.js/1.7.1/clipboard.min.js"></script>
<script>
    $(function () {
        $('.chosen-select').chosen();

    })
</script>
@yield('foot-script')
</body>
</html>
