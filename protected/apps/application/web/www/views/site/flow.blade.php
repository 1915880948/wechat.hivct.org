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
      <p><a href="{{yUrl(['/user/recv'])}}" class="weui-btn weui-btn_warn ">参与调查领试剂</a></p>
    </div>
  </div>
  @include('global.navbar')
@stop

@push('foot-script')
  <script>
      $(function () {

      });
  </script>
@endpush
