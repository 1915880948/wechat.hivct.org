@extends('layouts.main')@section('title','快速检测试剂操作流程')

@push('head-style')
  <style>
    .app-title{font-size:0.4rem;}
    .weui-cell__hd{ width:10% }
    .weui-cell__ft{ text-align:left }
    .weui-cells_form .weui-cell__ft{ font-size:0.45rem }
  </style>
@endpush

@section('content')
  {{--<header class="app-header">--}}
    {{--<h1 class="app-title">快速检测试剂操作流程</h1>--}}
  {{--</header>--}}
  <div class="bd">
    <div class="page__bd">
      <div class="weui-navbar">
        <a class="weui-navbar__item weui-bar__item--on" href="#tab1"> 末梢血金标法 </a> <a class="weui-navbar__item" href="#tab2"> 口腔黏膜渗出液金标法 </a>
      </div>
      <div class="weui-tab__bd">
        <div id="tab1" class="weui-tab__bd-item weui-tab__bd-item--active">
          <header class="app-header">
            <h1 class="app-title">末梢血金标法检测试剂（指尖血）操作流程</h1>
          </header>
          <div class="weui-cells">
            <div class="weui-cell">
              <div class="weui-cell__hd">1.</div>
              <div class="weui-cell__ft">检查检测试剂外包装完整无破损，有效期是否在保质期内</div>
            </div>
            <div class="weui-cell">
              <div class="weui-cell__hd">2.</div>
              <div class="weui-cell__ft">撕开检测试剂外包装</div>
            </div>
            <div class="weui-cell">
              <div class="weui-cell__hd">3.</div>
              <div class="weui-cell__ft">消毒采血部位</div>
            </div>
            <div class="weui-cell">
              <div class="weui-cell__hd">4.</div>
              <div class="weui-cell__ft">按下采血针刺破采血部位</div>
            </div>
            <div class="weui-cell">
              <div class="weui-cell__hd">5.</div>
              <div class="weui-cell__ft">用吸管将血滴入加样处</div>
            </div>
            <div class="weui-cell">
              <div class="weui-cell__hd">6.</div>
              <div class="weui-cell__ft">滴入缓冲液后静置15分钟</div>
            </div>
            <div class="weui-cell">
              <div class="weui-cell__hd">7.</div>
              <div class="weui-cell__ft">判读并拍摄结果照片</div>
            </div>
          </div>
        </div>
        <div id="tab2" class="weui-tab__bd-item">
          <header class="app-header">
            <h1 class="app-title">口腔黏膜渗出液金标法检测试剂<br/>（唾液试剂） 操作流程</h1>
          </header>
          <div class="weui-cells">
            <div class="weui-cell">
              <div class="weui-cell__hd">1.</div>
              <div class="weui-cell__ft">检测前半小时刷牙，清洁口腔</div>
            </div>
            <div class="weui-cell">
              <div class="weui-cell__hd">2.</div>
              <div class="weui-cell__ft">打开试剂盒，撕开检测试剂外包装</div>
            </div>
            <div class="weui-cell">
              <div class="weui-cell__hd">3.</div>
              <div class="weui-cell__ft">采样刷一面擦拭上牙龈，另一面擦拭下牙龈</div>
            </div>
            <div class="weui-cell">
              <div class="weui-cell__hd">4.</div>
              <div class="weui-cell__ft">将采样刷放进装了缓冲液的试管中，上下轻轻抽动6-8次</div>
            </div>
            <div class="weui-cell">
              <div class="weui-cell__hd">5.</div>
              <div class="weui-cell__ft">取出采样刷，用吸管吸取3-4滴缓冲液至试验板的圆孔处</div>
            </div>
            <div class="weui-cell">
              <div class="weui-cell__hd">6.</div>
              <div class="weui-cell__ft">静置20分钟</div>
            </div>
            <div class="weui-cell">
              <div class="weui-cell__hd">7.</div>
              <div class="weui-cell__ft">判读并拍摄结果照片</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

@push('foot-script')
  <script>
      $(function () {

      });
  </script>
@endpush
