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
  <link rel="stylesheet" href="{{yStatic('amaze/css/amazeui.min.css')}}">
  @yield('head-style')
  @yield('head-script')
</head>
<body>
<header data-am-widget="menu" class="am-header am-header-default">
  <div class="am-header-left am-header-nav">
    <a href="#doc-oc-demo1"> <i class="am-header-icon am-icon-home"></i> </a>
  </div>
  <h1 class="am-header-title">
    <a href="#title-link" class=""> @yield('navtitle', '你好志愿者网') </a>
  </h1>
  <div class="am-header-right am-header-nav">
    <a href="#doc-oc-demo1" class="am-btn am-btn-primary" data-am-offcanvas="{target: '#doc-oc-demo1', effect: 'push'}">
      <i class="am-header-icon am-icon-bars"></i> </a>
  </div>
</header>
{{--@if(gHasError())--}}
{{--<div class="alert alert-warning alert-dismissible">--}}
{{--<h4><i class="icon fa fa-warning"></i> {{env('ERROR_TITLE')}}!</h4>--}}
{{--{{gGetError()}}--}}
{{--</div>--}}
{{--@endif--}}
@yield('content')
@extends('widget.footer')
@extends('widget.rightside')
<script src="{{gStatic('vendor/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{yStatic('amaze/js/amazeui.min.js')}}"></script>
<script src="{{yStatic('js/app.js')}}"></script>
{{--<script src="//cdn.staticfile.org/moment.js/2.18.1/moment.min.js"></script>--}}
<script src="{{gStatic('vendor/yii/yii.js')}}"></script>
<script src="{{gStatic('vendor/plugins/layer/layer.js')}}"></script>
@yield('foot-script')
</body>
</html>
