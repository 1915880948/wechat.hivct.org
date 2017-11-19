@extends('layouts.main-blank'){{--@var( $time = 3)--}}{{--@var( $url = yUrl(['/site/index']) )--}}@section('title','出错啦 ！！！')

@push('head-style')
  <meta http-equiv="refresh" content="{{$time}};URL={{yUrl($url)}}">
@endpush

@section('bodyClass')
  class="login"
@endsection

@section('content')

  <div class="logotext" style="margin:0px auto;padding:100px 10px 10px 10px; text-align:center"></div>
  <div class="content">
    <div class="row">
      <div class="col-md-12 page-404">
        <div class="number font-red ">出错啦 ！！！</div>
        <div class="details text-center">
          <p> {{$exception->getMessage()}}</p>
        </div>
        <div class="text-right">
          <a href="{{yUrl($url)}}">{{$time}} 秒后返回首页，如果没有自动跳转，请点击</a>
        </div>
      </div>
    </div>
  </div>
@stop
