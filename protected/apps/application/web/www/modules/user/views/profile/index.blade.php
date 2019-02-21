@extends('layouts.main')@section('title','')

@section('content')
  <div class="wrapper">
    <header><a href="/" class="logo">你好志愿者网（www.hivct.com）</a></header>
    <div class="plus">
      <div class="vision">
        <div class="s_mide layer" data-depth=".35"></div>
        <div class="s_botm layer" data-depth-x=".1" data-depth-y=".08"></div>
        <div class="s_botm layer" data-depth-x=".18" data-depth-y=".15"></div>
      </div>
      <div class="user" id="update_user">
        <a href="javascript:;"> <img src="{{$account['headimgurl']}}"/> <strong>{{$account['nickname']}}</strong> </a>
      </div>
    </div>
    <div class="weui-cells">
      <a class="weui-cell weui-cell_access" href="{{yUrl(['/user/profile/update'])}}">
        <div class="weui-cell__bd">
          <p><span>个人资料</span></p>
        </div>
        <div class="weui-cell__ft"></div>
      </a>
    </div>
    <div class="weui-cells__title">我参与的</div>
    <div class="weui-cells">
      <a class="weui-cell weui-cell_access" href="{{yUrl(['/user/survey'])}}">
        <div class="weui-cell__bd">
          <p><span>我参与的调研</span></p>
        </div>
        <div class="weui-cell__ft"></div>
      </a>
    </div>
    <div class="weui-cells__title">我的</div>
    <div class="weui-cells">
      <a class="weui-cell weui-cell_access" href="{{yUrl(['/user/order'])}}">
        <div class="weui-cell__bd">
          <p><span>我的订单</span></p>
        </div>
        <div class="weui-cell__ft"></div>
      </a>
    </div>
  </div>
  @include('global.navbar')
@stop

@push('foot-script')
  <script src="{{yStatic('js/parallax.min.js')}}"></script>
  <script>
      $(function () {
          $('.vision').parallax();
      });
  </script>
@endpush
