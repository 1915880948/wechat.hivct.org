<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title',Yii::t('www','你好志愿者网'))</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="mobile-web-app-capable" content="yes">
  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">
  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  {!! yCsrfTag() !!}
  <link rel="stylesheet" href="//cdn.bootcss.com/weui/1.1.1/style/weui.min.css">
  <link rel="stylesheet" href="//cdn.bootcss.com/jquery-weui/1.0.1/css/jquery-weui.min.css">
  @yield('head-style')
  @yield('head-script')
</head>
<body>
@yield('content')
@extends('widget.footer')
@extends('widget.rightside')
<script src="{{gStatic('vendor/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>
<script src="{{yStatic('js/app.js')}}"></script>
{{--<script src="//cdn.staticfile.org/moment.js/2.18.1/moment.min.js"></script>--}}
<script src="{{gStatic('vendor/yii/yii.js')}}"></script>
<script src="{{gStatic('vendor/plugins/layer/layer.js')}}"></script>
@yield('foot-script')
</body>
</html>
