@extends('layouts.main')@section('title','艾滋病自我检测试剂调查问卷')

@push('head-style')
  <style>
    .weui-label{width:95%}
    .weui-cell__hd{ width:70% }
    .weui-input{ text-align:right }
    /*.weui-cell__bd{ width:60% }*/
    .weui-cell__ft{ flex:0; width:1.5rem; }
    .weui-cells_form .weui-cell__ft{ font-size:0.45rem }
  </style>
@endpush
@section('content')
  <header class="app-header">
    <h1 class="app-title">HIV快速检测</h1>
  </header>
  <div class="weui-cells weui-cells_form">
    <div class="weui-cells__title">你知道本地哪里可以检测HIV：</div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd ">医院</div>
      <div class="weui-cell__ft">
        <input id="partner_sns" name="partner_sns" value="1" class="weui-switch" type="checkbox">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">疾控中心</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">社区小组</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">药店</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">个体诊所</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__hd">其他</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="sex_after_drug_3month_num" id="sex_after_drug_3month_num" placeholder="请输入"></div>
      <div class="weui-cell__ft">
        {{--<button class="" style="width:1rem;">人</button>--}}
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">您是否接受过HIV检测？</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__hd">接受过几次HIV检测？</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="sex_after_drug_3month_num" id="sex_after_drug_3month_num" placeholder="请输入"></div>
      <div class="weui-cell__ft">
        <button class="" style="width:1rem;">次</button>
      </div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__hd">最近一年内接受过几次HIV检测？</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="sex_after_drug_3month_num" id="sex_after_drug_3month_num" placeholder="请输入"></div>
      <div class="weui-cell__ft">
        <button class="" style="width:1rem;">次</button>
      </div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__hd">最近6个月内接受过几次HIV检测？</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="sex_after_drug_3month_num" id="sex_after_drug_3month_num" placeholder="请输入"></div>
      <div class="weui-cell__ft">
        <button class="" style="width:1rem;">次</button>
      </div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label for="" class="weui-label">您最近一次参加HIV检测日期</label></div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="last_hiv_checkdate" id="last_hiv_checkdate" value="" data-toggle='date'>
      </div>
      <div class="weui-cell__ft">
        <input class="weui-input" type="text" name="last_hiv_checkdate_choose" id="last_hiv_checkdate_choose" placeholder="或选择"></div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">是否知道自己最近一次的HIV检测结果？</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label">最近一次主动检测HIV还是被动员检测的？ </label></div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="hiv_check_mode" id="hiv_check_mode" placeholder="请选择" onfocus="this.blur()">
      </div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label">最近一次参加检测的原因？ </label></div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="hiv_check_reason" id="hiv_check_reason" placeholder="点击选择最近一次参加检测的原因" onfocus="this.blur()">
      </div>
    </div>
    <div id="hiv_check_reason_other" class="hide" style="display:none">
      <div class="weui-cells__title">请手工填入参加检测的原因</div>
      <div class="weui-cells">
        <div class="weui-cell">
          <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="hiv_check_reason_other" placeholder="请输入原因">
          </div>
        </div>
      </div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label">最近一次通过何种方式参加HIV检测？ </label></div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="last_hiv_check_mode" id="last_hiv_check_mode" placeholder="点击选择最近一次参加检测方式" onfocus="this.blur()">
      </div>
    </div>
    <div id="last_hiv_check_mode_other" class="hide" style="display:none">
      <div class="weui-cells__title">请手工填入参加检测的方式</div>
      <div class="weui-cells">
        <div class="weui-cell">
          <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="last_hiv_check_mode_other" placeholder="请输入">
          </div>
        </div>
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">对于参加HIV检测是否有顾虑？</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label">你之前对参加HIV检测的主要顾虑是什么？ </label></div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="hiv_check_care" id="hiv_check_care" placeholder="点击选择您的顾虑" onfocus="this.blur()">
      </div>
    </div>
    <div id="hiv_check_care_other" class="hide" style="display:none">
      <div class="weui-cells__title">请手工填入顾虑原因</div>
      <div class="weui-cells">
        <div class="weui-cell">
          <div class="weui-cell__bd">
            <input class="weui-input" type="text" name="hiv_check_care_other" placeholder="请输入">
          </div>
        </div>
      </div>
    </div>
    <div class="weui-cells__title">你期望获得HIV检测的渠道：</div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd ">医院</div>
      <div class="weui-cell__ft">
        <input id="partner_sns" name="partner_sns" value="1" class="weui-switch" type="checkbox">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">疾控中心</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">社区小组</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">药店</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">个体诊所</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell ">
      <div class="weui-cell__hd">其他</div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="sex_after_drug_3month_num" id="sex_after_drug_3month_num" placeholder="请输入"></div>
      <div class="weui-cell__ft">
        {{--<button class="" style="width:1rem;">人</button>--}}
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">如果对以上部门提供的HIV检测存在顾虑，则是否愿意获自费购买HIV检测试剂？</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd"><label class="weui-label">你希望多久再次申请获得一次项目邮寄给你的免费检测试剂：？ </label></div>
      <div class="weui-cell__bd">
        <input class="weui-input" type="text" name="hiv_check_time" id="hiv_check_time" placeholder="点击选择时间" onfocus="this.blur()">
      </div>
    </div>
    <div class="weui-cell weui-cell_switch">
      <div class="weui-cell__bd">本次是否申请梅毒检测试剂：</div>
      <div class="weui-cell__ft">
        <input class="weui-switch" type="checkbox" id="partner_bar" name="partner_bar" value="1">
      </div>
    </div>
    <!---->
    <!---->
    <div class="weui-btn-area">
      <a class="weui-btn weui-btn_primary" href="{{yUrl(['/survey/selfcheckingpartner'])}}" id="showTooltips">继续 配偶/性伴及其他检测</a>
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

