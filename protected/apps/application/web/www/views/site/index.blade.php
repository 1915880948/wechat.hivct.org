@extends('layouts/main')@section('title','首页')


@section('content')
  <div class="wrapper" id="_form">
    <header><a href="/" class="logo">你好志愿者网（www.hivct.org）</a></header>
    <div class="mpart">
      <div class="vision" style="transform: translate3d(0px, 0px, 0px); transform-style: preserve-3d; backface-visibility: hidden;">
        <div class="s_mide layer" data-depth=".35" style="position: relative; display: block; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px); transform-style: preserve-3d; backface-visibility: hidden;"></div>
        <div class="s_botm layer" data-depth-x=".1" data-depth-y=".08" style="position: absolute; display: block; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px); transform-style: preserve-3d; backface-visibility: hidden;"></div>
        <div class="s_botm layer" data-depth-x=".18" data-depth-y=".15" style="position: absolute; display: block; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px); transform-style: preserve-3d; backface-visibility: hidden;"></div>
      </div>
    </div>
    <div class="tool_index">
      <h2 class="title1"><strong>学习资料</strong></h2>
      <div class="sst-grid clear">
        <a href="{{yUrl(['/check/fastflow'])}}"> <i class="iconfont icon-ziliao iconfont40"></i>操作流程</a>
        <a href="javascript:;" onclick="$.alert('开发中....')"><i class="iconfont icon-yiliao_medical8 iconfont40"></i>如何上传</a>
      </div>
      <h2 class="title3"><strong>调研</strong></h2>
      <div class="sst-grid clear">
        <a href="{{yUrl(['/check/aiyijian',])}}"> <i class="iconfont icon-wenhao-xianxingyuankuang iconfont40"></i>何为爱易检</a>
        <a href="{{yUrl(['/user/recv','type'=>'survey'])}}"> <i class="iconfont icon-yiliao_medical7 iconfont40"></i>爱易检问卷</a>
      </div>
    </div>
  </div>
  @include('global.navbar')
@stop
