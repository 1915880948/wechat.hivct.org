@extends('layouts.main')@section('title','艾滋病自我检测试剂调查问卷')
@push('head-style')
  <style>
    .weui-cells__title{
      font-size:0.5rem;
      color:skyblue;
    }
    .weui-cell__hd{ width:60% }
    .weui-input{ text-align:right }
    /*.weui-cell__bd{ width:60% }*/
    .weui-cell__ft{ flex:0; width:1.5rem; }
    .weui-cells_form .weui-cell__ft{ font-size:0.45rem }
  </style>
@endpush
@section('content')
  <header class="app-header">
    <h1 class="app-title">请输入您的基本信息</h1>
  </header>
  <form id="_form">
    <div class="weui-cells weui-cells_form">
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">姓名</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="name" id="name" value="{{ $survey['name'] }}" placeholder="请输入您的姓名">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">民族</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="nation" id="nation" placeholder="请选择" onfocus="this.blur()" value="{{$survey['nation']}}">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">性别 </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="gender" id="gender" value="{{$survey['gender']?$survey['gender']:'男'}}" placeholder="请选择" onfocus="this.blur()">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label for="" class="weui-label">出生年月</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="birthday" id="birthday" value="{{$survey['birthday']}}" data-toggle='date'>
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">文化程度 </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="education" id="education" placeholder="请选择" value="{{$survey['education']}}" onfocus="this.blur()">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">婚姻状况 </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="marriage" id="marriage" onfocus="this.blur()" placeholder="请选择" value="{{$survey['marriage']}}">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">主要职业 </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="job" id="job" onfocus="this.blur()" placeholder="请选择" value="{{$survey['job']}}">
        </div>
      </div>
      <div id="otherjob" class="app-hide">
        <div class="weui-cells__title">请手工填入您的职业</div>
        <div class="weui-cells">
          <div class="weui-cell">
            <div class="weui-cell__bd">
              <input class="weui-input" type="text" name="job_other" placeholder="请输入文本" value="{{$survey['job_other']}}">
            </div>
          </div>
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">月平均收入 </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="income" id="income" onfocus="this.blur()" placeholder="请选择" value="{{$survey['income']}}">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">户籍所在地 </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="household" id="household" onfocus="this.blur()" placeholder="请选择" value="{{$survey['household']}}">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">现居地 </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="livecity" id="livecity" data-code="110000" value="{{$survey['livecity']}}" onfocus="this.blur()" placeholder="请选择">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">当地居住时长 </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="livetime" id="livetime" onfocus="this.blur()" placeholder="请选择" value="{{$survey['livetime']}}">
        </div>
      </div>
      <div class="weui-btn-area">
        <input type="hidden" name="eventId" value="{{$request->get('eventId')}}"> <input type="hidden" name="step" value="{{$request->get('step')}}">
        {!! yLink('继续 性行为调查','javascript:;',['class'=>'weui-btn weui-btn_primary','id'=>'next-btn','data'=>[
          'next'=>yUrl($surveyUrl['next']),
          'post'=>yUrl(['/survey/save','type'=>'base'])
        ]]) !!}
      </div>
    </div>
  </form>
@stop

@push('foot-script')
  <script src="{{yStatic('js/city-picker.js')}}"></script>
  <script>
    console.log(BASE_OPTION.nation);
      $(function () {
          $('#birthday').calendar({
              value: ['1990-01-01'],
              maxDate: '{{date("Y-m-d")}},'
          });
          $("#nation").select({
              title: "选择民族",
              items: BASE_OPTION.nation
          });
          $("#gender").select({
              title: "选择性别 ",
              items: BASE_OPTION.gender
          });
          $('#education').select({
              title: "请选择您的教育程度",
              items: BASE_OPTION.education
          });
          $('#marriage').select({
              title: "请选择婚姻状况",
              items: BASE_OPTION.marriage
          });
          $('#job').select({
              title: "请选择婚职业",
              items: BASE_OPTION.job
          }).on('change', function () {
              if ($(this).val() == "其他") {
                  $('#otherjob').removeClass('app-hide');
              } else {
                  $('#otherjob').addClass('app-hide');
              }
          });
          $('#income').select({
              title: "请选择月平均收入",
              items: BASE_OPTION.income
          });
          $('#household').select({
              title: "请选择户籍所在地",
              items: BASE_OPTION.household
          });
          $('#livetime').select({
              title: "请选择当地居住时长",
              items: BASE_OPTION.livetime
          });
          $("#livecity").cityPicker({
              showDistrict: false
          });
          $('#next-btn').on('click', function () {
              var self = $(this);
              var code = $('#livecity').data('code');
              var jsonDate = $('#_form').serializeArray();
              jsonDate.push({'name': 'livecity_code', 'value': code});
              $.jsonPost($(self).data('post'), jsonDate, function (result) {
                  if (result.status) {
                      location.href = $(self).data('next');
                      return;
                  }
                  $.alert(result.items[0]);
              })
          })
      });
  </script>
@endpush

