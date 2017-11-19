<!DOCTYPE html><!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]--><!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]--><!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
  <meta charset="utf-8"/>
  <title>Metronic | User Login 3</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <meta content="" name="description"/>
  <meta content="" name="author"/>
  <link href="{{yStatic('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{yStatic('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{yStatic('assets/global/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{yStatic('assets/global/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{yStatic('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{yStatic('assets/global/css/components-md.min.css')}}" rel="stylesheet" id="style_components" type="text/css"/>
  <link href="{{yStatic('assets/global/css/plugins-md.min.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{yStatic('assets/pages/css/login-3.min.css')}}" rel="stylesheet" type="text/css"/>
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
  <link rel="shortcut icon" href="favicon.ico"/>
  {!! yCsrfTag() !!}
  @stack('head-style')
</head>
<body @yield('bodyClass')>
@yield('content')
@stack('foot-script')
<script src="{{yStatic('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{yStatic('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
<script src="{{yStatic('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{yStatic('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<script src="{{yStatic('assets/pages/scripts/login.min.js')}}" type="text/javascript"></script>
</body>
</html>
