@extends('layouts.main')@section('title','艾滋病自我检测试剂调查问卷')

@push('head-style')
  <style>
    .weui-label{width:95%}
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
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label">您的配偶/性伴是否检测过HIV？</label></div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="partner_is_check_hiv" id="partner_is_check_hiv" placeholder="请选择" onfocus="this.blur()">
      </div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label">您知道配偶/性伴的检测结果是？</label></div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="partner_check_result" id="partner_check_result" placeholder="请选择" onfocus="this.blur()">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">是否愿意动员配偶/性伴进行HIV检测：</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-btn-area">
      <a class="weui-btn weui-btn_primary" href="{{yUrl(['/survey/selfcheckingfollowup'])}}" id="showTooltips">继续 转介及后续服务</a>
    </div>
  </div>

@stop

@push('foot-script')
  <script src="{{yStatic('js/city-picker.js')}}"></script>
  <script>
      $(function () {

          $("#partner_is_check_hiv").select({
              title: "选择是否检测过",
              items: ["是", "否", '不知道']
          });
          $('#partner_check_result').select({
              title: "请选择检测结果",
              items: ["阳性", "阴性", "不知道"]
          });

      });
  </script>
@endpush

