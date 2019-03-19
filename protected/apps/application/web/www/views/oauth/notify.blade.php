@extends('layouts.main')@section('title','提示信息')

@section('content')
  <div class="detail-wrap">
    <div class="detail-wrap__hd">
      <h1 class="title">提示信息</h1>
      <p class="summary">签名错误，请后退到上一页，然后重新提交</p>
    </div>
  </div>
  @include('global.navbar')
@stop

@push('foot-script')
  {{--<script src="{{yStatic('js/wechat.preview.min.js')}}"></script>--}}
  <script>
      $(function () {
          // $('.detail-wrap').preview();
      });
  </script>
@endpush
