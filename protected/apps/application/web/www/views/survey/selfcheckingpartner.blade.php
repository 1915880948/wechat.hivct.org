@extends('layouts.main')@section('title','艾滋病自我检测试剂调查问卷')

@push('head-style')
  <style>
    .weui-label{ width:95% }
    .weui-cell__hd{ width:80% }
    .weui-input{ text-align:right }
    /*.weui-cell__bd{ width:60% }*/
    .weui-cell__ft{ flex:0; width:1.5rem; }
    .weui-cells_form .weui-cell__ft{ font-size:0.45rem }
  </style>
@endpush

@section('content')
  <header class="app-header">
    <h1 class="app-title">配偶/性伴及其他检测</h1>
  </header>
  <div class="weui-cells weui-cells_form">
    <form id="_form">
      {!! yInput('hidden','id',$request->get('id')) !!}
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">您的配偶/性伴是否检测过HIV？</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="partner_is_check_hiv" id="partner_is_check_hiv" placeholder="请选择" onfocus="this.blur()">
        </div>
      </div>
      <div class="app-hide" id="partner_is_check_hiv_results">
        <div class="weui-cell">
          <div class="weui-cell__hd"><label class="weui-label">您知道配偶/性伴的检测结果是？</label></div>
          <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="partner_check_result" id="partner_check_result" placeholder="请选择" onfocus="this.blur()">
          </div>
        </div>
      </div>
      <div class="weui-cell weui-cell_switch">
        <div class="weui-cell__bd">是否愿意动员配偶/性伴进行HIV检测：</div>
        <div class="weui-cell__ft">
          <input class="weui-switch" type="checkbox" id="partner_mobilize" name="partner_mobilize" value="1">
        </div>
      </div>
      <div class="weui-btn-area">
        <input type="hidden" name="eventId" value="{{$request->get('eventId')}}"/> <input type="hidden" name="step" value="{{$request->get('step')}}"/>
        {!! yLink('继续 转介及后续服务','javascript:;',['class'=>'weui-btn weui-btn_primary','id'=>'next-btn','data'=>[
        'next'=>yUrl($surveyUrl['next']),
        'post'=>yUrl($surveyUrl['post'])
        ]]) !!}
      </div>
    </form>
  </div>

@stop

@push('foot-script')
  <script src="{{yStatic('js/city-picker.js')}}"></script>
  <script>
      $(function () {
//          $('#partner_is_check_hiv').on('click', function () {
//              if ($('#partner_is_check_hiv').val() == "是") {
//                  $('#partner_is_check_hiv_results').toggleClass('app-hide', !$(this).is(":checked"));
//              }
//          });
          $("#partner_is_check_hiv").select({
              title: "选择是否检测过",
              items: ["是", "否", '不知道'],
              onChange: function () {
                  if ($("#partner_is_check_hiv").val() == '是') {
                      $('#partner_is_check_hiv_results').removeClass('app-hide');
                  } else {
                      $('#partner_is_check_hiv_results').addClass('app-hide');

                  }
              }
          });
          $('#partner_check_result').select({
              title: "请选择检测结果",
              items: ["阳性", "阴性", "不知道"]
          });

          $('#next-btn').on('click', function () {
              var self = $(this);
              $.jsonPost($(self).data('post'), $('#_form').serializeArray(), function (result) {
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

