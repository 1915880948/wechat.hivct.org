<!DOCTYPE html><!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
  <meta charset="utf-8"/>
  <title>@yield('title',env('APP_NAME'))</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <meta content="" name="description"/>
  <meta content="" name="author"/>
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <link href="{{yStatic('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{yStatic('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{yStatic('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{yStatic('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{yStatic('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css"/>
  <!-- END GLOBAL MANDATORY STYLES -->
  <!-- BEGIN THEME GLOBAL STYLES -->
  <link href="{{yStatic('assets/global/css/components-md.min.css')}}" rel="stylesheet" id="style_components" type="text/css"/>
  <link href="{{yStatic('assets/global/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css"/>
  <!-- END THEME GLOBAL STYLES -->
  <!-- BEGIN THEME LAYOUT STYLES -->
  <link href="{{yStatic('assets/layouts/layout/css/layout.min.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{yStatic('assets/layouts/layout/css/themes/light2.min.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
  <link href="{{yStatic('assets/layouts/layout/css/custom.min.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{yStatic('css/css.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{yStatic('select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
  <!-- END THEME LAYOUT STYLES -->
  <link rel="shortcut icon" href="favicon.ico"/>
  <!--[if lt IE 9]>
  <script src="{{yStatic('assets/global/plugins/respond.min.js')}}"></script>
  <script src="{{yStatic('assets/global/plugins/excanvas.min.js')}}"></script><![endif]-->
  <script src="{{yStatic('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/global/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
  {!! yCsrfTag() !!}
</head>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
@include('global.header')
<div class="page-container">
  <div class="page-sidebar-wrapper">
    @include('global.sidebar')
  </div>
  <div class="page-content-wrapper" data-pjax id="pjax-container">
    <div class="page-content">
      @stack('head-style')
      @stack('head-script')

      @yield('breadcrumb')
      @if($error = gGetError())
        <div class="m-heading-1 border-green m-bordered">
          <p> {{$error}}
          </p>
        </div>
      @endif
      <div class="row">
        <div class="col-md-12">
          @yield('content','点击左侧菜单开始操作')
        </div>
      </div>
      @stack('foot-script')
    </div>
    @include('global.quick-sidebar')
  </div>
  @include('global.footer')
  <script src="{{yStatic('assets/global/plugins/moment.min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/global/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/global/plugins/morris/raphael-min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/global/plugins/counterup/jquery.waypoints.min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/global/plugins/counterup/jquery.counterup.min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/layouts/layout4/scripts/layout.min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/layouts/layout4/scripts/demo.min.js')}}" type="text/javascript"></script>
  <script src="{{gStatic('vendor/layer/layer.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('select2/select2.min.js')}}" type="text/javascript"></script>
  <script src="//cdn.bootcss.com/clipboard.js/1.7.1/clipboard.min.js"></script>
  <script src="{{gStatic('vendor/yii/yii.js')}}"></script>
  {{--<script src="{{gStatic('app.js')}}" type="text/javascript"></script>--}}
  <script>
      $(function () {
          var clipboard = new Clipboard('.zclipboard', {
              text: function (trigger) {
                  return trigger.getAttribute('data-zclip');
              }
          });
          clipboard.on('success', function (e) {
              layer.msg('COPY SUCCESS');
          }).on('error', function (e) {
              console.error('Action:', e.action);
              console.error('Trigger:', e.trigger);
          });
      })
  </script>
</div>
</body>
</html>
