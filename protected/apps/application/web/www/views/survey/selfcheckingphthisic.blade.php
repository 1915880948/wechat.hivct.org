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
    <form id="_form">
      {!! yInput('hidden','id',$request->get('id')) !!}
      <div class="weui-cells__title">最近是否出现下列结核相关症状：</div>
      <div class="weui-cell weui-cell_switch">
        <div class="weui-cell__bd ">咳嗽、咳痰持续2周以上</div>
        <div class="weui-cell__ft">
          <input id="cough_2week" name="cough_2week"  class="weui-switch" type="checkbox">
        </div>
      </div>
      <div class="weui-cell weui-cell_switch">
        <div class="weui-cell__bd">反复咳出的痰中带血</div>
        <div class="weui-cell__ft">
          <input class="weui-switch" type="checkbox" id="cough_withblood" name="cough_withblood" >
        </div>
      </div>
      <div class="weui-cell weui-cell_switch">
        <div class="weui-cell__bd">夜间经常出汗</div>
        <div class="weui-cell__ft">
          <input class="weui-switch" type="checkbox" id="sweat_on_night" name="sweat_on_night" >
        </div>
      </div>
      <div class="weui-cell weui-cell_switch">
        <div class="weui-cell__bd">无法解思的体重明显下降</div>
        <div class="weui-cell__ft">
          <input class="weui-switch" type="checkbox" id="weight_downgrade" name="weight_downgrade" >
        </div>
      </div>
      <div class="weui-cell weui-cell_switch">
        <div class="weui-cell__bd">经常容易疲劳或呼吸短促</div>
        <div class="weui-cell__ft">
          <input class="weui-switch" type="checkbox" id="always_tired" name="always_tired" >
        </div>
      </div>
      <div class="weui-cell weui-cell_switch">
        <div class="weui-cell__bd">反复发热持续2周以上</div>
        <div class="weui-cell__ft">
          <input class="weui-switch" type="checkbox" id="fever_2week" name="fever_2week" >
        </div>
      </div>
      <div class="weui-cell weui-cell_switch">
        <div class="weui-cell__bd">淋巴结肿大</div>
        <div class="weui-cell__ft">
          <input class="weui-switch" type="checkbox" id="lymphadenectasis" name="lymphadenectasis" >
        </div>
      </div>
      <div class="weui-cell weui-cell_switch">
        <div class="weui-cell__bd">结核病人接触史</div>
        <div class="weui-cell__ft">
          <input class="weui-switch" type="checkbox" id="tuberculosis_contact_history" name="tuberculosis_contact_history" >
        </div>
      </div>
      <div class="weui-cell weui-cell_switch">
        <div class="weui-cell__bd">无结核相关症状</div>
        <div class="weui-cell__ft">
          <input class="weui-switch" type="checkbox" id="no_tuberculosis" name="no_tuberculosis" >
        </div>
      </div>
      <div class="weui-cells__title">是否做过相关检查？</div>
      <div class="weui-cell weui-cell_switch">
        <div class="weui-cell__bd">最近是否做过结核检查（痰检或X胸片）？</div>
        <div class="weui-cell__ft">
          <input class="weui-switch" type="checkbox" id="is_phthisic_checked" name="is_phthisic_checked" >
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
          <input class="weui-switch" type="checkbox" id="is_syphilis" name="is_syphilis" >
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
          <input class="weui-switch" type="checkbox" id="is_hepatitis_b" name="is_hepatitis_b" >
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
          <input class="weui-switch" type="checkbox" id="is_hepatitis_c" name="is_hepatitis_c" >
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
        {{--<a class="weui-btn weui-btn_primary" href="{{yUrl(['/survey/selfcheckinghiv'])}}" id="showTooltips">继续 HIV快速检测</a>--}}
      </div>
      <div class="weui-btn-area">
        {{--<a class="weui-btn weui-btn_primary" href="{{yUrl(['/survey/selfcheckingphthisic'])}}" id="showTooltips">继续 结核相关的调查</a>--}}
        {!! yLink('继续 HIV快速检测','javascript:;',['class'=>'weui-btn weui-btn_primary','id'=>'next-btn','data'=>[
          'next'=>yUrl(['/survey/selfcheckinghiv']),
          'post'=>yUrl(['/survey/save','type'=>'phthisic'])
        ]]) !!}
      </div>
    </form>
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
          $('#next-btn').on('click', function () {
              var self = $(this);
              $.jsonPost($(self).data('post'), $('#_form').serializeArray(), function (result) {
                  if (result.status) {
                      location.href = $(self).data('next') + '?id=' + result.items.id;
                      return;
                  }
                  $.alert(result.items[0]);
              })
          })
      });
  </script>
@endpush

