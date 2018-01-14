@extends('layouts.main')@section('title','')

@section('content')
  <div class="detail-wrap">
    <div class="detail-wrap__hd">
      <h1 class="title">爱易检覆盖地区</h1>
      <p class="summary">爱易检已推广到全国14个省份的15个地区，基本形成了覆盖AHF项目地区线上检测和咨询服务网络.</p>
    </div>
    <div class="detail-wrap__bd">
      <p>截至2017年11月， 爱易检模式已推广到全国14个省份的15个地区（北京、天津、山西、辽宁、黑龙江、河南、浙江、四川、重庆、湖南、广西、海南、新疆、云南及云南昭通），基本形成了覆盖AHF项目地区线上检测和咨询服务网络。</p>
      <p>爱易检是对WHO推荐的“HIV自我检测指南”的创新实践。该模式有效提高了HIV检测服务的可及性及覆盖面，对早检测、早治疗起到积极的推动作用。 </p>
      <h2>覆盖地图：</h2>
      <p><img src="{{yStatic('images/map.png')}}"></p>
    </div>
  </div>
  @include('global.navbar')
@stop

@push('foot-script')
  <script>
      $(function () {

      });
  </script>
@endpush
