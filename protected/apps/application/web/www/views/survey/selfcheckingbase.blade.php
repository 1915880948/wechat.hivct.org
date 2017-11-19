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
          <input class="weui-input" type="text" name="name" id="name" placeholder="请输入您的姓名">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">民族</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="nation" id="nation" placeholder="请选择" onfocus="this.blur()">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">性别 </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="gender" id="gender" placeholder="请选择" onfocus="this.blur()">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label for="" class="weui-label">出生年月</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="birthday" id="birthday" value="" data-toggle='date'>
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">文化程度 </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="education" id="education" placeholder="请选择" onfocus="this.blur()">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">婚姻状况 </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="marriage" id="marriage" onfocus="this.blur()" placeholder="请选择">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">主要职业 </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="job" id="job" onfocus="this.blur()" placeholder="请选择">
        </div>
      </div>
      <div id="otherjob" class="app-hide">
        <div class="weui-cells__title">请手工填入您的职业</div>
        <div class="weui-cells">
          <div class="weui-cell">
            <div class="weui-cell__bd">
              <input class="weui-input" type="text" name="job_other" placeholder="请输入文本">
            </div>
          </div>
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">月平均收入 </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="income" id="income" onfocus="this.blur()" placeholder="请选择">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">户籍所在地 </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="household" id="household" onfocus="this.blur()" placeholder="请选择">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">现居地 </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="livecity" id="livecity" onfocus="this.blur()" placeholder="请选择">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">当地居住时长 </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="livetime" id="livetime" onfocus="this.blur()" placeholder="请选择">
        </div>
      </div>
      <div class="weui-btn-area">
        {{--<a class="weui-btn weui-btn_primary" data-next="{{yUrl(['/survey/selfcheckingsex'])}}" id="next-btn">继续 性行为调查</a>--}}
        {!! yLink('继续 性行为调查','javascript:;',['class'=>'weui-btn weui-btn_primary','id'=>'next-btn','data'=>[
          'next'=>yUrl(['/survey/selfcheckingsex']),
          'post'=>yUrl(['/survey/save','type'=>'base'])
        ]]) !!}
      </div>
    </div>
  </form>
@stop

@push('foot-script')
  <script src="{{yStatic('js/city-picker.js')}}"></script>
  <script>
      $(function () {
          $('#birthday').calendar();
          $("#nation").select({
              title: "选择民族",
              items: ["汉族", "壮族", "满族", "回族", "苗族", "维吾尔族", "土家族", "彝族", "蒙古族", "藏族", "布依族", "侗族", "瑶族", "朝鲜族", "白族", "哈尼族", "哈萨克族", "黎族", "傣族", "畲族", "傈僳族", "仡佬族", "东乡族", "高山族", "拉祜族", "水族", "佤族", "纳西族", "羌族", "土族", "仫佬族", "锡伯族", "柯尔克孜族", "达斡尔族", "景颇族", "毛南族", "撒拉族", "布朗族", "塔吉克族", "阿昌族", "普米族", "鄂温克族", "怒族", "京族", "基诺族", "德昂族", "保安族", "俄罗斯族", "裕固族", "乌孜别克族", "门巴族", "鄂伦春族", "独龙族", "塔塔尔族", "赫哲族", "珞巴族"]
          });
          $("#gender").select({
              title: "选择性别 ",
              items: ["男", "女"]
          });
          $('#education').select({
              title: "请选择您的教育程度",
              items: ["文盲", "小学", "初中", "高中/中专", "大专/大学", "研究生及以上"]
          });
          $('#marriage').select({
              title: "请选择婚姻状况",
              items: ["未婚", "已婚", "同居", "离异或丧偶", "保密"]
          });
          $('#job').select({
              title: "请选择婚职业",
              items: ["学生", "餐饮食品业", "商业服务业", "医务人员", "自由职业", "离退休人员", "待业", "其他"]
          }).on('change', function () {
              if ($(this).val() == "其他") {
                  $('#otherjob').removeClass('app-hide');
              } else {
                  $('#otherjob').addClass('app-hide');
              }
          });
          $('#income').select({
              title: "请选择月平均收入",
              items: ["无收入", "0-1000元", "1001-2999元", "3000-4999元", "5000-9999元", "10000-19999元", "2万元以上"]
          });
          $('#household').select({
              title: "请选择户籍所在地",
              items: ['本市', '本省外市', '外省', '外籍']
          });
          $('#livetime').select({
              title: "请选择当地居住时长",
              items: ['<3月', '3-6月', '6月-1年', '1-5年', '5年以上']
          });
          $("#livecity").cityPicker({
              showDistrict: false
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

