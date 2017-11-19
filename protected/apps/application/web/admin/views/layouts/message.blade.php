@extends('layouts.main-blank')@section('title','后台登录')

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
        <div class="number @if($mode=="success")font-blue @else font-red @endif">{{$title}}</div>
        <div class="details text-center">
          <p> {{$message}}</p>
        </div>
        <div class="text-right">
          <a href="{{yUrl($url)}}">如果{{$time}}秒没有跳转，点击跳转</a>
        </div>
      </div>
    </div>
  </div>
@stop


