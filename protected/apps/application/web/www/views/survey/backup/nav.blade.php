{{--@section('content')--}}
  <ul id="nav_list" class="dropdown-content">
    <li><a href="收集信息.html">收集信息</a></li>
    <li><a href="测试结果.html">测试结果</a></li>
    <li><a href="商品列表.html">购买商品</a></li>
  </ul>
  <nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo center">调查问卷</a>
      <ul class="left">
        <li><a href="/">返回</a></li>
      </ul>
      <ul class="right">
        <li><a class="dropdown-button" href="#!" data-activates="nav_list"><i class="material-icons right">list</i></a></li>
      </ul>
    </div>
  </nav>
{{--@stop--}}
@push('foot-script')
  <script>
      $(function () {
          $(".dropdown-button").dropdown();
      });
  </script>
@endpush
