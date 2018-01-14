@extends('layouts.main')

@section('title','试剂邮寄进展')

@section('content')
  <div class="timeline">
    <ul>
      <li class="timeline-item">
        <div class="timeline-item-head-first"><i class="weui_icon weui_icon_success_no_circle timeline-item-checked"></i></div>
        <div class="timeline-item-tail"></div>
        <div class="timeline-item-content"><h4 class="recent">广州市 已发出</h4>
          <p class="recent">2016-04-17 12:00:00</p></div>
      </li>
      <li class="timeline-item">
        <div class="timeline-item-head"><i class="weui_icon weui_icon_success_no_circle timeline-item-checked hide"></i></div>
        <div class="timeline-item-tail"></div>
        <div class="timeline-item-content"><h4> 申通快递员 广东广州 收件员 xxx 已揽件</h4>
          <p>2016-04-16 10:23:00</p></div>
      </li>
      <li class="timeline-item">
        <div class="timeline-item-head"><i class="weui_icon weui_icon_success_no_circle timeline-item-checked hide"></i></div>
        <div class="timeline-item-tail"></div>
        <div class="timeline-item-content"><h4> 这是一个时间线组件,非常适合用于一直改变得数据展示,总的来说,这是一套非常美好的组建扩展这是一个时间线组件,非常适合用于一直改变得数据展示,总的来说,这是一套非常美好的组建扩展</h4>
          <p>2016-04-16 10:23:00</p></div>
      </li>
      <li class="timeline-item">
        <div class="timeline-item-head"><i class="weui_icon weui_icon_success_no_circle timeline-item-checked hide"></i></div>
        <div class="timeline-item-tail hide"></div>
        <div class="timeline-item-content"><h4> 商家正在通知快递公司揽件</h4>
          <p>2016-04-15 9:00:00</p></div>
      </li>
    </ul>
  </div>
@stop

@push('foot-script')
  <script>
      $(function () {

      });
  </script>
@endpush
