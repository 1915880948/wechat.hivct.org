@extends('layouts.main')@section('title','艾滋病自我检测试剂调查问卷')

@push('head-style')
  <style>
    .weui-cell__hd{ width:80% }
    .weui-input{ text-align:right }
    /*.weui-cell__bd{ width:60% }*/
    .weui-cell__ft{ flex:0; width:1.5rem; }
    .weui-cells_form .weui-cell__ft{ font-size:0.45rem }
  </style>
@endpush
@section('content')
  <header class="app-header">
    <h1 class="app-title">转介及后续服务</h1>
  </header>
  <div class="weui-cells weui-cells_form">
    <div class="weui-cells__title">如果本次检测阳性，是否愿意接受我们提供以下服务：</div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd ">提供进一步快检服务</div>
      <div class="weui-cell__ft">
        <input id="partner_sns" name="partner_sns" value="1" class="weui-switch" type="checkbox">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">提供确证和CD4检测机构信息</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">提供抗病毒治疗或相关医疗机构信息</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">提供性病诊断治疗机构信息</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">提供机会性感染治疗及其他相关治疗机构信息</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">提供心理咨询和帮助机构信息</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">提供母婴阻断机构信息</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">提供结核诊断治疗机构信息</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__hd" style="width:20%">其他</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="sex_after_drug_3month_num" id="sex_after_drug_3month_num" placeholder="请输入"></div>
      <div class="weui-cell__ft">
        {{--<button class="" style="width:1rem;">人</button>--}}
      </div>
    </div>
    <div class="weui-cells__title">你对感染HIV后是否需要接受治疗的看法是：</div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">积极接受治疗</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">担心药物副作用，暂不接受</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">未到治疗标准就不用治疗</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">担心很快耐药</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">担心吃药后被人发现</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">认为无法治愈，不治疗，任其自然l</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__hd" style="width:20%">其他</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="sex_after_drug_3month_num" id="sex_after_drug_3month_num" placeholder="请输入"></div>
      <div class="weui-cell__ft">
        {{--<button class="" style="width:1rem;">人</button>--}}
      </div>
    </div>
    <!---->
    <!---->
    <div class="weui-btn-area">
      <a class="weui-btn weui-btn_primary" href="{{yUrl(['/survey/selfcheckingh'])}}" id="showTooltips">完成</a>
    </div>
  </div>

@stop

@push('foot-script')
  <script src="{{yStatic('js/city-picker.js')}}"></script>
  <script>
      $(function () {
          $('#last_hiv_checkdate').calendar();
          $("#last_hiv_checkdate_choose").select({
              title: "请选择最近一次HIV检查日期",
              items: ['不记得日期', '从未检测过']
          });
          $('#hiv_check_mode').select({
              title: "主动检测还是被动员？",
              items: ['主动', '被动']
          });
          $('#hiv_check_reason').select({
              title: "检查原因？",
              items: ['注射毒品史', '配偶/固定性伴阳性史', '男男性行为史', '商业异性性行为史',
                  '非商非固定异性性行为史', '献血浆史', '输血/血制品史', '职业暴露史',
                  '母亲阳性史', '手术史', '无高危行为史', '其他']
          });
          $('#last_hiv_check_mode').select({
              title: "何种方式参加检查 ？",
              items: ['医院检测', '社区组织提供HIV检测', '疾控中心', 'VCT门诊检测', '从未检测过', '其他']
          });
          $('#hiv_check_care').select({
              title: "您的顾虑是 ？",
              items: ['检测需要实名', '自认为感染HIV的风险低', '等待检测结果的时间过长',
                  '担心检测阳性后信息暴露', '担心感染而不愿意去检测', '距检测地点较远交通不便', '其他']
          });
          $('#hiv_check_time').select({
              title: "您希望多久再免费邮件试剂 ？",
              items: ['1个月', '2个月', '3个月', '6个月', '一年', '不想再测']
          });

      });
  </script>
@endpush

