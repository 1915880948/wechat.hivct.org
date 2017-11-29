@extends('layouts.main')@section('title','')

@section('content')
  <div class="bd">
    <div class="page__bd">
      <div class="weui-cells">
        <div class="weui-cell weui-cell_access" href="javascript:;">
          <div class="weui-cell__bd" style="color:#333">
            <h3>您所选择的试剂和发货地</h3>
          </div>
          <div class=""><a href="javascript:;" class="open-popup" data-target="#full"><i class="iconfont icon-addition" style="font-size:20px"></i></a></div>
        </div>
      </div>
      <div class="weui-cells__title">试剂列表：</div>
      @foreach($products as  $type => $product)
        <div class="weui-cells">
          <div class="weui-cell ">
            <div class="weui-cell__bd">
              <p style="margin-left:15px;">{{$product['name']}} @if($product['price'] > 0)（{{$product['price']}}）@endif</p>
            </div>
          </div>
        </div>
      @endforeach
      <div class="weui-cells__title">发货地：</div>
      <div class="weui-cells">
        <div class="weui-cell ">
          <div class="weui-cell__bd">
            <p style="margin-left:15px;">{{$logistcisInfo['title']}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="weui-tabbar">
    <div class="weui-form-preview" style="width:100%">
      <div class="weui-form-preview__ft">
        <a class="weui-form-preview__btn weui-form-preview__btn_default" href="{{yUrl(['/site/index'])}}">放弃获取试剂</a>
        {{--data-confirm="您确认要提交吗？"--}}
        <a class="weui-form-preview__btn weui-form-preview__btn_primary" href="{{yUrl(['/user/recv/submitorder'])}}" data-method="post"  data-params='{"payinfo":"{{$payinfo}}"}'>确认@if($totalPrice>0)并付款@endif</a>
      </div>
    </div>
  </div>
@stop

@push('foot-script')
  <script>
      $(function () {
          var payinfo = '{{$payinfo}}';
          console.log(payinfo);
          {{--$('.weui-form-preview__btn_primary').on('click', function () {--}}
              {{--$.jsonPost('{{yUrl(['/user/recv/submitorder'])}}', {data: payinfo}, function (result) {--}}
                  {{--console.log();--}}
              {{--})--}}
          {{--});--}}

      });
  </script>
@endpush
