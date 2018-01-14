{{--<div class="weui-tabbar">--}}{{--<a href="{{yUrl(['/site'])}}" class="weui-tabbar__item weui-bar__item--on"> <span class="weui-badge" style="position: absolute;top: -.4em;right: 1em;">8</span>--}}{{--<div class="weui-tabbar__icon">--}}{{--<i class="iconfont icon-shouye-xianxing"></i>--}}{{--</div>--}}{{--<p class="weui-tabbar__label">首页</p>--}}{{--</a> <a href="{{yUrl(['/check/fastflow'])}}" class="weui-tabbar__item">--}}{{--<div class="weui-tabbar__icon">--}}{{--<i class="iconfont icon-wxbzhuye"></i>--}}{{--</div>--}}{{--<p class="weui-tabbar__label">流程</p>--}}{{--</a> <a href="{{yUrl(['/user/recv?type=survey'])}}" class="weui-tabbar__item">--}}{{--<div class="weui-tabbar__icon">--}}{{--<i class="iconfont icon-wenti-xianxing"></i>--}}{{--</div>--}}{{--<p class="weui-tabbar__label">调研</p>--}}{{--</a> <a href="{{yUrl(['/user/profile'])}}" class="weui-tabbar__item">--}}{{--<div class="weui-tabbar__icon">--}}{{--<i class="iconfont icon-yonghu-xianxing"></i>--}}{{--</div>--}}{{--<p class="weui-tabbar__label">我</p>--}}{{--</a>--}}{{--</div>--}}
<footer class="m-footerbar">
  <div class="ui-fixed__bottom m-footerbar__main">
    <a class="m-footerbar__item  @if(in_array(yRequest()->getPathInfo(),['','site','site/index','site/'])) is-active @endif" href="{{yUrl(['/'])}}">
      <i class="m-footerbar__icon icon1"></i> <label class="m-footerbar_label">首页</label> </a>
    <a class="m-footerbar__item  @if(yRequest()->getPathInfo()=="site/flow") is-active @endif" href="{{yUrl(['/site/flow'])}}">
      <i class="m-footerbar__icon icon2"></i> <label class="m-footerbar_label">自检流程</label> </a>
    <a class="m-footerbar__item @if(yRequest()->getPathInfo()=="site/cover") is-active @endif" href="{{yUrl(['site/cover'])}}">
      <i class="m-footerbar__icon icon3"></i> <label class="m-footerbar_label">覆盖地区</label> </a>
    <a class="m-footerbar__item @if(yRequest()->getPathInfo()=="site/about") is-active @endif" href="{{yUrl(['site/about'])}}">
      <i class="m-footerbar__icon icon4"></i> <label class="m-footerbar_label">关于我们</label> </a>
  </div>
</footer>
