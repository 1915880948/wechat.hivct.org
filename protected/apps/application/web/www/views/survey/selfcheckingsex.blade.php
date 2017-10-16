@extends('layouts.main')@section('title','艾滋病自我检测试剂调查问卷')

@push('head-style')
  <style>
    .weui-cell__hd{ width:60% }
    .weui-cell__bd{ width:60% }
    .weui-input{text-align:right}
    .weui-cell__ft{ flex:1; }
    /*.paddingleft{ padding-left:.5rem; width:90% }*/
  </style>
@endpush
@section('content')
  <header class="app-header">
    <h1 class="app-title">性行为情况</h1>
  </header>
  <div class="weui-cells weui-cells_form">
    <div class="weui-cell ">
      <div class="weui-cell__hd">您第一次发生性行为的年龄：</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="sex_age" id="sex_age" placeholder="请输入年龄数"></div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__hd">寻找其他性伴侣的方式：</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="partner" id="partner" placeholder="请选择方式">
      </div>
    </div>
    <div class="weui-cells__tips">选择除配偶/固定性伴外，您寻找其他性伴侣的方式</div>
    <div class="weui-cells__title">除配偶/固定性伴外，您寻找其他性伴侣途径：</div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd paddingleft">互联网（社交软件等）</div>
      <div class="weui-cell__ft">
        <input id="partner_sns" name="partner_sns" value="1" class="weui-switch" type="checkbox">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">酒吧</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">KTV</div>
      <div class="weui-cell__ft">
        <input id="partner_ktv" name="partner_ktv" value="1" class="weui-switch" type="checkbox">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">公园</div>
      <div class="weui-cell__ft">
        <input id="partner_park" name="partner_park" value="1" class="weui-switch" type="checkbox">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">其他</div>
      <div class="weui-cell__ft">
        <input class="weui-input" type="text" name="partner_other" id="partner_other" placeholder="其他">
      </div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label">常用性行为：</label></div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="sex_type" id="sex_type" placeholder="请选择您常用的性行为方式" onfocus="this.blur()">
      </div>
    </div>
    <div id="sex_type_other_choose" class="hide" style="display:none">
      <div class="weui-cells__title">其他性行为方式</div>
      <div class="weui-cells">
        <div class="weui-cell">
          <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="sex_type_other" placeholder="请输入你常用性行为方式">
          </div>
        </div>
      </div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label">您的性取向 </label></div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="sex_direction" id="sex_direction" placeholder="请选择您的性取向" onfocus="this.blur()">
      </div>
    </div>
    <!---->
    <div class="weui-cells__title">异性性行为调查：</div>
    <div class="weui-cell ">
      <div class="weui-cell__hd">近3个月内您有多少个异性伙伴：</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="number" name="hetero_partner_num" id="hetero_partner_num" placeholder="请输入人数">
      </div>
    </div>
    {{--<div class="weui-cells__title">最近3个月内，每次与异性发生性行为时，是否全程使用安全套：</div>--}}
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">最近3个月内，每次与异性发生性行为时，是否全程使用安全套：</div>
      <div class="weui-cell__ft">
        <input id="condom_full_use" name="condom_full_use" value="1" class="weui-switch" type="checkbox">
      </div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__hd">在最近3个月没有全程使用安全套的比例：</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="condom_percent" id="condom_percent" placeholder="请选择比例">
      </div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__hd">最近一次与异性发生性行为是否使用安全套：</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="condom_near" id="condom_near" placeholder="请选择最近是否使用">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">与异性发生性行为出现过未全程使用安全套(如在性行为发生一段时间才使用安全套)：</div>
      <div class="weui-cell__ft">
        <input id="condom_full_use_not" name="condom_full_use_not" value="1" class="weui-switch" type="checkbox">
      </div>
    </div>
    <!---->
    <div class="weui-cells__title">异性性行为调查：</div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">您曾有肛交行为吗：</div>
      <div class="weui-cell__ft">
        <input id="anal_sex" name="anal_sex" value="1" class="weui-switch" type="checkbox">
      </div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__hd">您的性角色是：</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="anal_sex_role" id="anal_sex_role" placeholder="选择性角色">
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
        <input id="anal_sex_full_use" name="anal_sex_full_use" value="1" class="weui-switch" type="checkbox">
      </div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__bd">在最近3个月没有全程使用安全套的比例：</div>
      <div class="weui-cell__ft">
        <input class="weui-input" type="text" name="anal_sex_percent" id="anal_sex_percent" placeholder="请选择比例">
      </div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__hd">最近一次与异性发生性行为是否使用安全套：</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="anal_sex_near" id="anal_sex_near" placeholder="请选择最近是否使用">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">与异性发生性行为出现过未全程使用安全套(在肛交发生一段时间才使用安全套，如射精前阶段)：</div>
      <div class="weui-cell__ft">
        <input id="anal_sex_full_use_not" name="anal_sex_full_use_not" value="1" class="weui-switch" type="checkbox">
      </div>
    </div>
    <!---->
    <div class="weui-btn-area">
      <a class="weui-btn weui-btn_primary" href="{{yUrl(['/survey/selfcheckingdrug'])}}" id="showTooltips">继续 毒品使用情况调查</a>
    </div>
  </div>

@stop

@push('foot-script')
  <script src="{{yStatic('js/city-picker.js')}}"></script>
  <script>
      $(function () {

          $("#partner").select({
              title: "选择性伴侣的方式",
              items: ['主动', '被动']
          });
          $("#sex_type").select({
              title: "选择性行为方式 ",
              items: ["阴道交", "口交", '肛交', '手淫', '乳交', '器具', '其他']
          });
          $('#sex_direction').select({
              title: "请选择您的性取向",
              items: ["同性", "异性", "双向", "不确定"]
          });
          $('#condom_percent,#anal_sex_percent').select({
              title: "请选择没有例程使用的比例",
              items: ["100%", "80-99%", "60-79%", "40-59%", "20-39%", '1-19%', '0%']
          });
          $('#condom_near,#anal_sex_near').select({
              title: "最近一次是否使用案例套",
              items: ["是", "否", "没有发生性行为"]
          });
          $('#anal_sex_role').select({
              title: "选择您的性角色",
              items: ["完全是主动肛交（纯1）", "主要是主动肛交（主要是1）", "两者兼有，两者差不多", "主要是被动肛交（主要是0）", "完全被动肛交（纯0）"]
          });

      });
  </script>
@endpush

