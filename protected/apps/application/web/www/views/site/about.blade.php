@extends('layouts.main')@section('title','关于我们')

@section('content')
  <div class="detail-wrap">
    <div class="detail-wrap__hd">
      <h1 class="title">爱易检是什么？</h1>
      <p class="summary">爱易检是一种快速、简便且保密的艾滋病快速检测方式。 20分钟出结果，准确率高达 99%！</p>
    </div>
    <div class="detail-wrap__bd">
      <h2>艾滋病健康基金会（AHF）中国项目</h2>
      <p> AHF中国项目始于2006年，在国家和地方层面上支持和推动相关政府、疾控、医疗和社区组织等机构开展合作，通过实施完善和简化的咨询、检测、关怀、治疗和随访模式，提高当地艾滋病预防和治疗应对能力，扩大检测覆盖面和可及性，最大程度地发现艾滋病病毒感染者，为更多的感染者尽早提供抗病毒治疗及机会性感染救治服务。同时，我们与合作伙伴共同开展形式多样和有效的社区宣传和倡导，提高人们对艾滋病的认知水平，减少对艾滋病病毒感染者和病人的歧视，最终实现终止艾滋病病毒传播的目标。
      <h2>同直公益</h2>
      <p>机构介绍（请补充）</p>
      <h2>爱易检模式北京地区试点</h2>
      <p>2013年AHF中国项目与同直公益合作，率先在北京地区高危人群中开展互联网+HIV快速自我检测试点研究（以下简称“爱易检”）。项目同伴教育员为有检测意愿对象邮寄HIV快速检测试剂，并对HIV自检阳性者提供一对一陪同转介至当地疾控中心或定点治疗机构进行确诊及关怀治疗等服务。试点期间，通过互联网共发放检测试剂8000人份，反馈HIV自检结果7261人份，约80%为首次HIV检测者，HIV自检阳性率达10%以上。</p>
      <h2>各省同伴教育员联系方式</h2>
      {{--<img src="{{yStatic('images/contact.png')}}" />--}}
      <style>

      .weui-flex__item{border-top:1px solid #EEEEEE;border-left:1px solid #EEEEEE;text-align:left;display:table-cell;vertical-align:middle;line-height:1.5}
      .weui-flex__item:last-child{border-right:1px solid #EEEEEE}
      </style>
      <div style="display:  table;">
        <div class="weui-flex">
          <div class="weui-flex__item"><strong>项目机构名称</strong></div>
          <div class="weui-flex__item"><strong>同伴教育员所属组织</strong></div>
          <div class="weui-flex__item"><strong>姓名</strong></div>
        </div>
        <div class="weui-flex">
          <div class="weui-flex__item">AHF中国项目办</div>
          <div class="weui-flex__item">同直公益</div>
          <div class="weui-flex__item">莫莫</div>
        </div>
        <div class="weui-flex">
          <div class="weui-flex__item">天津第二人民医院</div>
          <div class="weui-flex__item">天津艾馨家园</div>
          <div class="weui-flex__item">耿勇</div>
        </div>
        <div class="weui-flex">
          <div class="weui-flex__item">临汾红丝带学校</div>
          <div class="weui-flex__item">蓝翔心语</div>
          <div class="weui-flex__item">李晋涛</div>
        </div>
        <div class="weui-flex">
          <div class="weui-flex__item">哈尔滨市传染病院</div>
          <div class="weui-flex__item">哈尔滨康乃馨关爱之家</div>
          <div class="weui-flex__item">董占明</div>
        </div>
        <div class="weui-flex">
          <div class="weui-flex__item">浙江省性艾协会</div>
          <div class="weui-flex__item">阳光海岸彩虹服务中心</div>
          <div class="weui-flex__item">蒋少强</div>
        </div>
        <div class="weui-flex">
          <div class="weui-flex__item">卧龙区疾病预防控制中心</div>
          <div class="weui-flex__item">南阳市心灵港湾工作组</div>
          <div class="weui-flex__item">魏涛</div>
        </div>
        <div class="weui-flex">
          <div class="weui-flex__item">湖南省卫计委宣教科</div>
          <div class="weui-flex__item">左岸彩虹</div>
          <div class="weui-flex__item">小熊</div>
        </div>
        <div class="weui-flex">
          <div class="weui-flex__item">广西疾控中心</div>
          <div class="weui-flex__item">广西碧云湖社区</div>
          <div class="weui-flex__item">宋立黎</div>
        </div>
        <div class="weui-flex">
          <div class="weui-flex__item">海南省热带医学研究会预防控制专业委员会</div>
          <div class="weui-flex__item">三亚明日工作组</div>
          <div class="weui-flex__item">陈浩</div>
        </div>
        <div class="weui-flex">
          <div class="weui-flex__item">重庆市公共卫生医疗救治中心</div>
          <div class="weui-flex__item">蓝宇工作组</div>
          <div class="weui-flex__item">熊伟翔</div>
        </div>
        <div class="weui-flex">
          <div class="weui-flex__item">四川省性艾协会</div>
          <div class="weui-flex__item">宜宾市蓝梦健康咨询服务中心</div>
          <div class="weui-flex__item">温学刚</div>
        </div>
        <div class="weui-flex">
          <div class="weui-flex__item">云南省艾滋病关爱中心</div>
          <div class="weui-flex__item">彩云天空</div>
          <div class="weui-flex__item">杨杨</div>
        </div>
        <div class="weui-flex">
          <div class="weui-flex__item">云南省昭通市昭阳区社区卫生服务中心</div>
          <div class="weui-flex__item">乌蒙彩虹</div>
          <div class="weui-flex__item">张云海</div>
        </div>
        <div class="weui-flex">
          <div class="weui-flex__item">中国医科大学附属第一医院(沈阳)</div>
          <div class="weui-flex__item">彩虹港湾</div>
          <div class="weui-flex__item">康强</div>
        </div>
        <div class="weui-flex">
          <div class="weui-flex__item">新疆</div>
          <div class="weui-flex__item">新疆男孩彩虹梦想志愿者爱心服务中心</div>
          <div class="weui-flex__item">孟祥宁</div>
        </div>
        <div class="weui-flex">
          <div class="weui-flex__item"></div>
          <div class="weui-flex__item"></div>
          <div class="weui-flex__item"></div>
        </div>
      </div>
    </div>
  </div>
  @include('global.navbar')
@stop

@push('foot-script')
  {{--<script src="{{yStatic('js/wechat.preview.min.js')}}"></script>--}}
  <script>
      $(function () {
          // $('.detail-wrap').preview();
      });
  </script>
@endpush
