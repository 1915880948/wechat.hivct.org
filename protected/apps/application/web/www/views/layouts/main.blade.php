<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title',Yii::t('www','你好志愿者网'))</title>
  <meta http-equiv=X-UA-Compatible content="IE=edge">
  <meta name=format-detection content="telephone=no">
  <meta name=format-detection content="email=no">
  <meta name=apple-mobile-web-app-capable content=yes>
  <meta name=apple-mobile-web-app-status-bar-style content=black>
  <meta name=full-screen content=yes>
  <meta name=browsermode content=application>
  <meta name=x5-orientation content=portrait>
  <meta name=x5-fullscreen content=true>
  <meta name=x5-page-mode content=app>
  <meta name=viewport content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no,minimal-ui">
  {!! yCsrfTag() !!}
  <link rel="stylesheet" href="{{yStatic('vendor/material/css/materialize.min.css')}}">
  <link rel="stylesheet" href="{{yStatic('vendor/material/css/materialicon.css')}}">
  <link rel="stylesheet" href="{{yStatic('css/main.css')}}">
  @stack('head-style')
  @stack('head-script')
</head>
<body>
@yield('content')
<script type="text/javascript" src="{{yStatic('js/jquery3.js')}}"></script>
{{--<script src="{{gStatic('vendor/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>--}}

<script type="text/javascript" src="{{yStatic('vendor/material/js/materialize.min.js')}}"></script>
<script src="{{yStatic('js/app.js')}}"></script>
<script src="{{gStatic('vendor/yii/yii.js')}}"></script>
<script src="{{gStatic('vendor/plugins/layer/layer.js')}}"></script>
@stack('foot-script')
</body>
</html>
