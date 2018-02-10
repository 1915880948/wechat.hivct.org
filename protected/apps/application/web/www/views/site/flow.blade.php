@extends('layouts.main')@section('title','')

@section('content')
  <div class="detail-wrap">
    <div class="detail-wrap__hd">
      <h1 class="title">艾滋病怎么自检 详细自检过程</h1>
      <p class="summary">导语：艾滋病自测是很简单的检查自己是否患上艾滋病一个方法，但具体检测过程是怎样的呢？</p>
    </div>
    <div class="detail-wrap__bd">
      <p>　　检查自己是否得了艾滋病不一定要去医院哦！艾滋病自检方法的流行让检查艾滋病不再是麻烦的事情！那么艾滋病自检方法是有哪些步骤呢？</p>
      <p><img src="{{yStatic('images/temp_img1.png')}}"></p>
      <h2>艾滋病自检方法</h2>
      <h3>第一步：查看试纸</h3>
      <p>
        　　为方便大家操作，HIV检测试纸被装入塑料卡座内，使用更加方便，检测原理不变，仍旧是双抗原夹心法。（金标法）<br> 　　各部位说明如下：<br> 　　各部位说明如下：小圆孔（S区）为加样孔，受检血滴要滴入该孔。<br> 　　窄长形凹陷区为判定结果区，其中，T为检测线的位置，C为对照线的位置。<br>
      </p>
      <h3>第二步：采血</h3>
      <p>
        　　采血器具：采血针（中等粗细的缝衣针也可）、酒精、棉球。<br> 　　采血部位：指尖或耳垂。<br> 　　采血方法：先用酒精棉球消毒采血部位和采血针，然后采备。<br> 　　注意：第一滴血要弃去，用第二、三滴血做检测。血滴直接滴入加样孔，或先吸入洁净的吸管，然后滴入加样孔。 </p>
      <p><img src="{{yStatic('images/temp_img2.png')}}"></p>
      <h3>第三步：判断结果</h3>
      <p>
        　　加样后10-15分钟内观察结果。<br> 　　1、试纸上只出现一条红线（对照线C）为阴性结果。<br> 　　2、试纸上出现两条红线（对照线C和检测线T）为阳性结果。<br> 　　3、试纸上未出现红线，表示测试实验失败，请另取卡重新检测。 </p>
      <p><img src="{{yStatic('images/temp_img3.png')}}"></p>
      <p>&nbsp;</p>
      <p class="weui-agree"><label for="weuiAgree"> <input id="weuiAgree" class="weui-agree-checkbox" type="checkbox"/>
          <span class="weui-agree-text">阅读并同意</span></label> <a href="javascript:void(0);" class="open-popup" data-target="#full">《知情同意书》</a>
      </p>
      <p><a href="javascript:;" class="weui-btn weui_btn_disabled join_in f-black" id="join">参与调查领试剂</a></p>
      <div id="full" class='weui-popup__container'>
        <div class="weui-popup__overlay"></div>
        <div class="weui-popup__modal" style="padding-bottom:100px;">
          <header class='app-header'>
            <h2 class="app-second-title">知情同意书</h2>
            <p class="app-sub-title"></p>
          </header>
          <article class="weui-article">
            <p>
              艾滋病是由于人体感染艾滋病病毒后，造成抵抗力下降，以至免疫系统全面崩溃而出现各种机会性感染、肿瘤的致死性传染病。到目前为止，艾滋病还没有可预防的疫苗和可治愈的药物。通过治疗可以延长生命、改善生活质量。主要通过性接触、血液、母婴三种途径传播。为了解是否感染艾滋病病毒，我们为您检测并为您保密。 </p>
            <h1> 一、检测的目的</h1>
            <p>
              接受检测后，我们会为您解释检测结果、提供咨询。这样就不必因整天担忧自己可能患有艾滋病而惶恐不安；如果查明感染了艾滋病病毒，应接受早期治疗，及早采取健康的生活方式，延缓病情发展；我们还会告诉您一些预防措施，及早采取措施保护家人，防止将病毒传播给他人。 另外，如果感染了病毒，您的爱人或性伴他们可能会问您是怎么感染的，这可能使你们发生一些矛盾。但我们觉得，您的爱人或性伴迟早会知道的，而早知道采取措施、尽早接受诊断和治疗。为了你的爱人或家人及您自己的健康，建议您从长远考虑，接受检测。 </p>
            <h1>二、检测程序</h1>
            <p>您是否检测完全出于您的自愿。如果同意，我们将抽取您少量的血液（大约2毫升）用于艾滋病病毒抗体初筛检测，并在二周内通知您检测结果。但在感染后2-12周的窗口期内，可能存在无法检测出HIV抗体的情况。但万一检测出感染了艾滋病病毒，我们建议您通过适当方式及时将检测结果告诉自己的爱人。检测结果出来后，我们还会为您提供一些相关咨询和帮助。如果您愿意，请在这张艾滋病病毒抗体初生检测知情同意书上签字，以表明您完全理解检测的目的和程序，并同意接受检测。 </p>
          </article>
          <a href="javascript:;" class="weui-btn weui-btn_primary close-popup">关闭</a>
        </div>
      </div>
    </div>
    @include('global.navbar')
    @stop

    @push('foot-script')
      <script>
          $(function () {
              $('.join_in').click(function () {
                  if ($(this).hasClass('weui_btn_disabled')) {
                      $.alert("请先阅读知同意书，阅读并同意后方可继续 ！", "提醒！");
                      return false;
                  }
                  var tag = "{{$is_allow}}";
                  if (tag == "0") {
                      $.toast('近一个月您有申请记录');
                  } else {
                      location.href = "{{yUrl(['/user/recv'])}}";
                  }
              });

              $('#weuiAgree').on('change', function () {
                  if ($(this).is(':checked')) {
                      $('#join').addClass('weui-btn_warn f-white').removeClass('f-black weui_btn_disabled');
                  } else {
                      $('#join').removeClass('weui-btn_warn f-white').addClass('f-black weui_btn_disabled');
                  }

              })
          });
      </script>
  @endpush
