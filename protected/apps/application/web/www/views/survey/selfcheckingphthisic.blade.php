@extends('layouts.main')@section('title','艾滋病自我检测试剂调查问卷')

@push('head-style')
  <style>
    .weui-cell__hd{ width:80% }
    .weui-input{ text-align:right }
    /*.weui-cell__bd{ width:60% }*/
    /*.weui-cell__ft{ flex:1; }*/
    .weui-cells_form .weui-cell__ft{ font-size:0.45rem }
    .paddingleft{ padding-left:.5rem; width:90% }
  </style>
@endpush
@section('content')
  <header class="app-header">
    <h1 class="app-title">结核和其他调查</h1>
  </header>
  <div class="weui-cells weui-cells_form">
    <div class="weui-cells__title">最近是否出现下列结核相关症状：</div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd ">咳嗽、咳痰持续2周以上</div>
      <div class="weui-cell__ft">
        <input id="partner_sns" name="partner_sns" value="1" class="weui-switch" type="checkbox">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">反复咳出的痰中带血</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">夜间经常出汗</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">无法解思的体重明显下降</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">经常容易疲劳或呼吸短促</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">反复发热持续2周以上</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">淋巴结肿大</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">结核病人接触史</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">无结核相关症状</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cells__title">是否做过相关检查？</div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">最近是否做过结核检查（痰检或X胸片）？</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="is_phthisic" name="is_phthisic" value="1">
      </div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__hd">结核检测结果是?</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="phthisic_result" id="phthisic_result" placeholder="请选择">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">最近是否做过梅毒检测？</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="is_syphilis" name="is_syphilis" value="1">
      </div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__hd">梅毒检测结果是?</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="syphilis_result" id="syphilis_result" placeholder="请选择">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">最近是否做过乙肝检测？</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="is_hepatitis_b" name="is_hepatitis_b" value="1">
      </div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__hd">乙肝检测结果是?</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="hepatitis_b_result" id="hepatitis_b_result" placeholder="请选择">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">最近是否做过丙肝检测？</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="is_hepatitis_c" name="is_hepatitis_c" value="1">
      </div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__hd">丙肝检测结果是?</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="hepatitis_c_result" id="hepatitis_c_result" placeholder="请选择">
      </div>
    </div>
    <!---->
    <!---->
    <!---->
    <div class="weui-btn-area">
      <a class="weui-btn weui-btn_primary" href="{{yUrl(['/survey/selfcheckinghiv'])}}" id="showTooltips">继续 HIV快速检测</a>
    </div>
  </div>

@stop

@push('foot-script')
  <script src="{{yStatic('js/city-picker.js')}}"></script>
  <script>
      $(function () {

          $("#phthisic_result,#syphilis_result,#hepatitis_b_result,#hepatitis_c_result").select({
              title: "选择检测结果",
              items: ['阳性', '阴性', '不知道']
          });
      });
  </script>
@endpush

