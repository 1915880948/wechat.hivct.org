@extends('layouts/main')@section('title','首页')


@section('content')
  <div class="swiper-container">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img src="{{yStatic('images/banner.png')}}"></div>
      <div class="swiper-slide"><img src="{{yStatic('images/x.png')}}"></div>
      <div class="swiper-slide"><img src="{{yStatic('images/y.png')}}"></div>
      <div class="swiper-slide"><img src="{{yStatic('images/z.png')}}"></div>
    </div>
    <div class="swiper-pagination"></div>
  </div>

  <div class="card-menu">
    <ul class="card-menu_area">
      <li class="card-menu__item"><a class="menu1" href="#">免费申请试剂</a></li>
      <li class="card-menu__item"><a class="menu2" href="{{yUrl(['/user/order/ship'])}}">试剂邮寄进展</a></li>
    </ul>
    <ul class="card-menu_area">
      <li class="card-menu__item"><a class="menu3" href="#">保证金退还</a></li>
      <li class="card-menu__item"><a class="menu4" href="#">自检结果上传</a></li>
    </ul>
  </div>
  {{--<div class="wrapper" id="_form">--}}
  {{--<header><a href="/" class="logo">你好志愿者网（www.hivct.org）</a></header>--}}
  {{--<div class="mpart">--}}
  {{--<div class="vision" style="transform: translate3d(0px, 0px, 0px); transform-style: preserve-3d; backface-visibility: hidden;">--}}
  {{--<div class="s_mide layer" data-depth=".35" style="position: relative; display: block; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px); transform-style: preserve-3d; backface-visibility: hidden;"></div>--}}
  {{--<div class="s_botm layer" data-depth-x=".1" data-depth-y=".08" style="position: absolute; display: block; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px); transform-style: preserve-3d; backface-visibility: hidden;"></div>--}}
  {{--<div class="s_botm layer" data-depth-x=".18" data-depth-y=".15" style="position: absolute; display: block; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px); transform-style: preserve-3d; backface-visibility: hidden;"></div>--}}
  {{--</div>--}}
  {{--</div>--}}
  {{--<div class="tool_index">--}}
  {{--<h2 class="title1"><strong>学习资料</strong></h2>--}}
  {{--<div class="sst-grid clear">--}}
  {{--<a href="{{yUrl(['/check/fastflow'])}}"> <i class="iconfont icon-ziliao iconfont40"></i>操作流程</a>--}}
  {{--<a href="javascript:;" onclick="$.alert('开发中....')"><i class="iconfont icon-yiliao_medical8 iconfont40"></i>如何上传</a>--}}
  {{--</div>--}}
  {{--<h2 class="title3"><strong>调研</strong></h2>--}}
  {{--<div class="sst-grid clear">--}}
  {{--<a href="{{yUrl(['/check/aiyijian',])}}"> <i class="iconfont icon-wenhao-xianxingyuankuang iconfont40"></i>何为爱易检</a>--}}
  {{--<a href="{{yUrl(['/user/recv','type'=>'survey'])}}"> <i class="iconfont icon-yiliao_medical7 iconfont40"></i>爱易检问卷</a>--}}
  {{--</div>--}}
  {{--</div>--}}
  {{--</div>--}}
  @include('global.navbar')
@stop

@push('head-style')
  <link rel="stylesheet" href="{{yStatic('css/swiper.min.css')}}" />
@endpush

@push('foot-script')
  <script src="{{yStatic('js/swiper.min.js')}}"></script>
  <script>
      var swiper = new Swiper('.swiper-container', {
          pagination: {
              el: '.swiper-pagination',
          }
      });
  </script>
@endpush
