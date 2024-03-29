@extends('layouts.main')@section('title','艾滋病自我检测试剂调查问卷')

@push('head-style')
  <style>
    .weui-cell__hd{ width:60% }
    .weui-cell__bd{ width:60% }
    .weui-input{ text-align:right }
    .weui-cell__ft{ flex:1; }
    /*.paddingleft{ padding-left:.5rem; width:90% }*/
  </style>
@endpush
@section('content')
  <header class="app-header">
    <h1 class="app-title">性行为情况</h1>
  </header>
  <div class="weui-cells weui-cells_form">
    <form id="_form">
      {!! yInput('hidden','id',$request->get('id')) !!}
      <div class="weui-cell weui-cell_switch">
        <div class="weui-cell__bd paddingleft">你曾经有过性行为吗？</div>
        <div class="weui-cell__ft">
          <input name="has_sex"  type="hidden" value="0">
          <input id="has_sex" name="has_sex" class="weui-switch" type="checkbox" value="{{$survey['has_sex']}}">
        </div>
      </div>
      <div id="sex_survey" class="app-hide">
        <div class="weui-cell ">
          <div class="weui-cell__hd">您第一次发生性行为的年龄：</div>
          <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="sex_age" id="sex_age" value="{{$survey['sex_age']}}" placeholder="请输入年龄数"></div>
        </div>
        <div class="weui-cell ">
          <div class="weui-cell__hd">除配偶/固定性伴外，您寻找其他性伴侣的方式：</div>
          <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="partner" id="partner" value="{{$survey['partner']}}" placeholder="请选择">
          </div>
        </div>
        {{--<div class="weui-cells__tips">选择除配偶/固定性伴外，您寻找其他性伴侣的方式</div>--}}
        <div class="weui-cells__title">除配偶/固定性伴外，您寻找其他性伴侣途径：</div>
        <div class="weui-cell weui-cell_switch">
          <div class="weui-cell__bd paddingleft">互联网（社交软件等）</div>
          <div class="weui-cell__ft">
              <input name="partner_sns"  type="hidden" value="0">
            <input id="partner_sns" name="partner_sns" class="weui-switch" type="checkbox" value="{{$survey['partner_sns']}}">
          </div>
        </div>
        <div class="weui-cell weui-cell_switch">
          <div class="weui-cell__bd">酒吧</div>
          <div class="weui-cell__ft">
              <input name="partner_bar"  type="hidden" value="0">
            <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="{{$survey['partner_bar']}}">
          </div>
        </div>
        <div class="weui-cell weui-cell_switch">
          <div class="weui-cell__bd">KTV</div>
          <div class="weui-cell__ft">
              <input name="partner_ktv"  type="hidden" value="0">
            <input id="partner_ktv" name="partner_ktv" class="weui-switch" type="checkbox" value="{{$survey['partner_ktv']}}">
          </div>
        </div>
        <div class="weui-cell weui-cell_switch">
          <div class="weui-cell__bd">公园</div>
          <div class="weui-cell__ft">
              <input name="partner_park"  type="hidden" value="0">
            <input id="partner_park" name="partner_park" class="weui-switch" type="checkbox" value="{{$survey['partner_park']}}">
          </div>
        </div>
        <div class="weui-cell weui-cell_switch">
          <div class="weui-cell__bd">其他</div>
          <div class="weui-cell__ft">
            <input class="weui-input" type="text" name="partner_other" id="partner_other" placeholder="其他" value="{{$survey['partner_other']}}">
          </div>
        </div>
        <div class="weui-cell">
          <div class="weui-cell__hd"><label class="weui-label">常用性行为：</label></div>
          <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="sex_type" id="sex_type" placeholder="请选择" onfocus="this.blur()" value="{{$survey['sex_type']}}">
          </div>
        </div>
        <div id="sex_type_other_choose" class="app-hide">
          <div class="weui-cells__title">其他性行为方式</div>
          <div class="weui-cells">
            <div class="weui-cell">
              <div class="weui-cell__bd">
                <input class="weui-input" type="text" name="sex_type_other" placeholder="请选择" value="{{$survey['sex_type_other']}}">
              </div>
            </div>
          </div>
        </div>
        <div class="weui-cell">
          <div class="weui-cell__hd"><label class="weui-label">您的性取向 </label></div>
          <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="sex_direction" id="sex_direction" placeholder="请选择" onfocus="this.blur()" value="{{$survey['sex_direction']}}">
          </div>
        </div>
      </div>
      <div class="heterosexuals hide">
        <div class="weui-cells__title">异性性行为调查：</div>
        <div class="weui-cell weui-cell_switch">
          <div class="weui-cell__bd paddingleft">你近3个月内有过性行为吗？</div>
          <div class="weui-cell__ft">
              <input name="has_sex_3month"  type="hidden" value="0">
            <input id="has_sex_3month" name="has_sex_3month" class="weui-switch" type="checkbox">
          </div>
        </div>
        <div class="app-hide" id="sex_3month">
          <div class="weui-cell cell_switch">
            <div class="weui-cell__hd">近3个月内您有多少个异性伙伴：</div>
            <div class="weui-cell__bd">
              <input class="weui-input" type="number" name="hetero_partner_num" id="hetero_partner_num" placeholder="请输入人数">
            </div>
          </div>
          <div class="weui-cells__title">最近3个月内，每次与异性发生性行为时，是否全程使用安全套：</div>
          <div class="weui-cell weui-cell_switch">
            <div class="weui-cell__bd">最近3个月内，每次与异性发生性行为时，是否全程使用安全套：</div>
            <div class="weui-cell__ft">
                <input name="condom_full_use"  type="hidden" value="0">
              <input id="condom_full_use" name="condom_full_use" class="weui-switch" type="checkbox">
            </div>
          </div>
          <div class="weui-cell ">
            <div class="weui-cell__hd">在最近3个月没有全程使用安全套的比例：</div>
            <div class="weui-cell__bd">
              <input class="weui-input" type="text" name="condom_percent" id="condom_percent" placeholder="请选择">
            </div>
          </div>
          <div class="weui-cell ">
            <div class="weui-cell__hd">最近一次与异性发生性行为是否使用安全套：</div>
            <div class="weui-cell__bd">
              <input class="weui-input" type="text" name="condom_near" id="condom_near" placeholder="请选择">
            </div>
          </div>
          <div class="weui-cell weui-cell_switch">
            <div class="weui-cell__bd">与异性发生性行为出现过未全程使用安全套(如在性行为发生一段时间才使用安全套)：</div>
            <div class="weui-cell__ft">
                <input name="condom_full_use_not"  type="hidden" value="0">
              <input id="condom_full_use_not" name="condom_full_use_not" class="weui-switch" type="checkbox">
            </div>
          </div>
        </div>
      </div>
      <div class="homosexuals hide">
        <div class="weui-cells__title">同性性行为调查：</div>
        <div class="weui-cell weui-cell_switch">
          <div class="weui-cell__bd">您曾有肛交行为吗：</div>
          <div class="weui-cell__ft">
              <input name="anal_sex"  type="hidden" value="0">
            <input id="anal_sex" name="anal_sex" class="weui-switch" type="checkbox" value="0">
          </div>
        </div>
        <div class="app-hide" id="sex_same">
          <div class="weui-cell ">
            <div class="weui-cell__hd">您的性角色是：</div>
            <div class="weui-cell__bd">
              <input class="weui-input" type="text" name="anal_sex_role" id="anal_sex_role" placeholder="请选择">
            </div>
          </div>
          <div class="weui-cell ">
            <div class="weui-cell__hd">近3个月内您有多少个同性伙伴：</div>
            <div class="weui-cell__bd">
              <input class="weui-input" type="number" name="anal_sex_partner_num" id="anal_sex_partner_num" placeholder="请输入人数">
            </div>
          </div>
          <div class="weui-cell weui-cell_switch">
            <div class="weui-cell__bd">最近3个月内，每次与同性发生性行为时，是否全程使用安全套：</div>
            <div class="weui-cell__ft">
                <input name="anal_sex_full_use"  type="hidden" value="0">
              <input id="anal_sex_full_use" name="anal_sex_full_use" class="weui-switch" type="checkbox">
            </div>
          </div>
          <div class="weui-cell ">
            <div class="weui-cell__hd">在最近3个月没有全程使用安全套的比例：</div>
            <div class="weui-cell__bd">
              <input class="weui-input" type="text" name="anal_sex_percent" id="anal_sex_percent" placeholder="请选择">
            </div>
          </div>
          <div class="weui-cell ">
            <div class="weui-cell__hd">最近一次与同性发生性行为是否使用安全套：</div>
            <div class="weui-cell__bd">
              <input class="weui-input" type="text" name="anal_sex_near" id="anal_sex_near" placeholder="请选择">
            </div>
          </div>
          <div class="weui-cell weui-cell_switch">
            <div class="weui-cell__bd">与同性发生性行为出现过未全程使用安全套(在肛交发生一段时间才使用安全套，如射精前阶段)：</div>
            <div class="weui-cell__ft">
                <input name="anal_sex_full_use_not"  type="hidden" value="0">
              <input id="anal_sex_full_use_not" name="anal_sex_full_use_not" class="weui-switch" type="checkbox">
            </div>
          </div>
        </div>
      </div>
      <div class="weui-btn-area">
        <input type="hidden" name="eventId" value="{{$request->get('eventId')}}"> <input type="hidden" name="step" value="{{$request->get('step')}}">
        {!! yLink('继续 毒品使用情况调查','javascript:;',['class'=>'weui-btn weui-btn_primary','id'=>'next-btn','data'=>[
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

          $('#has_sex').on('click', function () {
              $('#sex_survey').toggleClass('app-hide', !$(this).is(":checked"));
          }).trigger('change');

          $('#has_sex_3month').on('click', function () {
              $('#sex_3month').toggleClass('app-hide', !$(this).is(":checked"));
          });
          $('#anal_sex').on('click', function () {
              $('#sex_same').toggleClass('app-hide', !$(this).is(":checked"));
          });
          $("#partner").select({
              title: "选择性伴侣的方式",
              items: ['主动', '被动']
          });
          $("#sex_type").select({
              title: "选择性行为方式 ",
              items: ["阴道交", "口交", '肛交', '手淫', '乳交', '器具', '其他']
          }).on('change', function () {
              if ($(this).val() == '其他') {
                  $('#sex_type_other_choose').removeClass('app-hide');
              } else {
                  $('#sex_type_other_choose').addClass('app-hide');
              }
          });
          $('#sex_direction').select({
              title: "请选择您的性取向",
              items: ["同性", "异性", "双向", "不确定"]
          }).on('change', function () {
              var val = $(this).val();
              if (val === '同性') {
                  $('.homosexuals').show();
                  $('.heterosexuals').hide();
              }
              else if (val === '异性') {
                  $('.homosexuals').hide();
                  $('.heterosexuals').show();
              } else {
                  $('.homosexuals,.heterosexuals').show();
              }
          });
          $('#hetero_partner_num').on('change', function () {
              if ($(this).val() == '0') {

              }
          });
          $('#condom_percent,#anal_sex_percent').select({
              title: "请选择没有全程使用的比例",
              items: ["100%", "80-99%", "60-79%", "40-59%", "20-39%", '1-19%', '0%']
          });
          $('#condom_near,#anal_sex_near').select({
              title: "最近一次是否使用安全套",
              items: ["是", "否", "没有发生性行为"]
          });
          $('#anal_sex_role').select({
              title: "选择您的性角色",
              items: ["完全是主动肛交（纯1）", "主要是主动肛交（主要是1）", "两者兼有，两者差不多", "主要是被动肛交（主要是0）", "完全被动肛交（纯0）"]
          });
        @if ($survey['has_sex'])
        $('#has_sex').trigger('click');
          $('#sex_direction').trigger('change');
        @endif

        $('#next-btn').on('click', function () {
            var self = $(this);
            if( $('#has_sex:checked') === false){
                $('#_form')[0].reset();
            }
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

