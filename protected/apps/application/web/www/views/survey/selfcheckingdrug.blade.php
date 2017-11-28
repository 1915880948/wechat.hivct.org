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
    <h1 class="app-title">毒品使用情况</h1>
  </header>
  <div class="weui-cells weui-cells_form">
    <form id="_form">
      {!! yInput('hidden','id',$request->get('id')) !!}
      <div class="weui-cell weui-cell_switch">
        <div class="weui-cell__bd">您使用过毒品吗？</div>
        <div class="weui-cell__ft">
          <input id="is_use_drug" name="is_use_drug" class="weui-switch" type="checkbox">
        </div>
      </div>
      <div id="drug_form" class="app-hide">
        <div class="weui-cell ">
          <div class="weui-cell__hd">您目前主要使用哪种毒品?</div>
          <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="drug_type" id="drug_type" placeholder="请选择毒品类型" value="{{$survey['drug_type']}}">
          </div>
        </div>
        <div class="weui-cell ">
          <div class="weui-cell__hd">您使用毒品的频率?</div>
          <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="drug_rate" id="drug_rate" placeholder="请选择毒品使用频率" value="{{$survey['drug_rate']}}">
          </div>
        </div>
        <div class="weui-cell weui-cell_switch">
          <div class="weui-cell__bd">最近一个月,您使用过毒品吗?</div>
          <div class="weui-cell__ft">
            <input id="is_use_drug_near_month" name="is_use_drug_near_month" class="weui-switch" type="checkbox" value="{{$survey['is_use_drug_near_month']}}">
          </div>
        </div>
        <div id="drug_near_month" class="app-hide">
          <div class="weui-cell ">
            <div class="weui-cell__hd">最近一个月,您使用毒品的频率?</div>
            <div class="weui-cell__bd">
              <input class="weui-input" type="text" name="drug_near_month_num" id="drug_near_month_num" placeholder="请输入" value="{{$survey['drug_near_month_num']}}">
            </div>
            <div class="weui-cell__ft">
              <h3 class="" style="width:1.5rem;">次/月</h3>
            </div>
          </div>
        </div>
        <div class="weui-cell weui-cell_switch">
          <div class="weui-cell__bd">你曾经注射过毒品吗?</div>
          <div class="weui-cell__ft">
            <input id="is_use_inject" name="is_use_inject" class="weui-switch" type="checkbox" value="{{$survey['is_use_inject']}}">
          </div>
        </div>
        <div id="inject_cond" class="app-hide">
          <div class="weui-cell weui-cell_switch">
            <div class="weui-cell__bd">最近一个月，您注射过毒品吗?</div>
            <div class="weui-cell__ft">
              <input id="is_use_inject_near_month" name="is_use_inject_near_month" value="{{$survey['is_use_inject_near_month']}}" class="weui-switch" type="checkbox">
            </div>
          </div>
          <div id="inject_near_month_cond" class="app-hide">
            <div class="weui-cell ">
              <div class="weui-cell__hd">最近一个月,您注射毒品的频率？</div>
              <div class="weui-cell__bd">
                <input class="weui-input" type="text" name="inject_near_month_num" value="{{$survey['inject_near_month_num']}}" id="inject_near_month_num" placeholder="请输入">
              </div>
              <div class="weui-cell__ft">
                <p class="" style="width:1.5rem;">次/月</p>
              </div>
            </div>
          </div>
          <div class="weui-cell weui-cell_switch">
            <div class="weui-cell__bd">您曾经与别人共用过针具吗？</div>
            <div class="weui-cell__ft">
              <input id="is_use_pinhead" name="is_use_pinhead" class="weui-switch" value="{{$survey['is_use_pinhead']}}" type="checkbox">
            </div>
          </div>
          <div class="weui-cell weui-cell_switch">
            <div class="weui-cell__bd">最近一个月，您注射毒品时与别人共用过针具吗?</div>
            <div class="weui-cell__ft">
              <input id="is_use_pinhead_near_month" name="is_use_pinhead_near_month" value="{{$survey['is_use_pinhead_near_month']}}" class="weui-switch" type="checkbox">
            </div>
          </div>
          <div class="weui-cell ">
            <div class="weui-cell__hd">最近一个月注射毒品时，与别人共用针具的频率如何？</div>
            <div class="weui-cell__bd">
              <input class="weui-input" type="text" name="pinhead_near_month_num" value="{{$survey['pinhead_near_month_num']}}" id="pinhead_near_month_num" placeholder="请选择">
            </div>
            {{--<div class="weui-cell__ft">--}}
            {{--次/月--}}
            {{--</div>--}}
          </div>
        </div>
        {{--最近3个月,您有没有过吸食毒品后发生性行为？ □是     □否（跳至下一栏）--}}
        {{--如果回答“是”，在最近3个月与             人是在吸食毒品后发生的性行为？--}}
        {{--最近1个月,您有没有过吸食毒品后发生性行为？ □是     □否--}}
        {{--如果回答“是”，在最近1个月与             人是在吸食毒品后发生的性行为？--}}
        <div class="weui-cell weui-cell_switch">
          <div class="weui-cell__bd">最近3个月,您有没有过吸食毒品后发生性行为？</div>
          <div class="weui-cell__ft">
            <input id="is_sex_after_drug_3month" name="is_sex_after_drug_3month" class="weui-switch" type="checkbox">
          </div>
        </div>
        <div id="sex_after_drug_3month_cond" class="app-hide">
          <div class="weui-cell ">
            <div class="weui-cell__hd">在最近3个月与多少人是在吸食毒品后发生的性行为?</div>
            <div class="weui-cell__bd">
              <input class="weui-input" type="text" name="sex_after_drug_3month_num" id="sex_after_drug_3month_num" placeholder="请输入"></div>
            <div class="weui-cell__ft">
              <button class="" style="width:1rem;">人</button>
            </div>
          </div>
        </div>
        <div class="weui-cell weui-cell_switch">
          <div class="weui-cell__bd">最近1个月,您有没有过吸食毒品后发生性行为？</div>
          <div class="weui-cell__ft">
            <input id="is_sex_after_drug_1month" name="is_sex_after_drug_1month" class="weui-switch" type="checkbox">
          </div>
        </div>
        <div id="sex_after_drug_1month_cond" class="app-hide">
          <div class="weui-cell ">
            <div class="weui-cell__hd">在最近1个月与多少人是在吸食毒品后发生的性行为?</div>
            <div class="weui-cell__bd">
              <input class="weui-input" type="text" name="sex_after_drug_1month_num" id="sex_after_drug_1month_num" placeholder="请输入"></div>
            <div class="weui-cell__ft">
              <button class="" style="width:1rem;">人</button>
            </div>
          </div>
        </div>
        <!---->
      </div>
      <div class="weui-btn-area">
        <input type="hidden" name="eventId" value="{{$request->get('eventId')}}"/> <input type="hidden" name="step" value="{{$request->get('step')}}"/>
        {!! yLink('继续 结核相关的调查','javascript:;',['class'=>'weui-btn weui-btn_primary','id'=>'next-btn','data'=>[
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
          $("#drug_type").select({
              title: "选择毒品类型",
              items: ['海洛因', '可卡因', '零号胶囊', 'Rush', '大麻', '吗啡', 'K粉(氯氨酮) ', '摇头丸', '麻古', '其他']
          });
          $("#drug_rate").select({
              title: "选择使用毒品的频率",
              items: [">=1次/天", "1-6次/周", '1-3次/月', '<1次/月']
          });
          $('#pinhead_near_month_num').select({
              title: "请选择共用针具的频率",
              items: ["未共用", "有时共用", "每次都共用"]
          });
//          $('#next-btn').on('click', function () {
//              var self = $(this);
//              $.jsonPost($(self).data('post'), $('#_form').serializeArray(), function (result) {
//                  if (result.status) {
//                      location.href = $(self).data('next') + '?id=' + result.items.id;
//                      return;
//                  }
//                  $.alert(JSON.stringify(result.items));
//              })
//          })
          $('#is_use_drug').on('click', function () {
              $('#drug_form').toggleClass('app-hide', !$(this).is(":checked"));
          });
          $('#is_use_drug_near_month').on('click', function () {
              $('#drug_near_month').toggleClass('app-hide', !$(this).is(":checked"));
          });
          $('#is_use_inject').on('click', function () {
              $('#inject_cond').toggleClass('app-hide', !$(this).is(":checked"));
          });
          $('#is_use_inject_near_month').on('click', function () {
              $('#inject_near_month_cond').toggleClass('app-hide', !$(this).is(":checked"));
          });
          $('#is_sex_after_drug_3month').on('click', function () {
              $('#sex_after_drug_3month_cond').toggleClass('app-hide', !$(this).is(":checked"));
          });
          $('#is_sex_after_drug_1month').on('click', function () {
              $('#sex_after_drug_1month_cond').toggleClass('app-hide', !$(this).is(":checked"));
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

