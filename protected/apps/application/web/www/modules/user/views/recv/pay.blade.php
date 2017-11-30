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
    <form method="post" action="{{yUrl(['/user/recv/submitorder'])}}" id="submit_order" style="width:100%">
      <input type="text" name="_csrf" value="{{yRequest()->getCsrfToken()}}"/> <input type="text" name="payinfo" value="{{$payinfo}}"/>
    </form>
    <div class="weui-form-preview" style="width:100%">
      <div class="weui-form-preview__ft">
        <a class="weui-form-preview__btn weui-form-preview__btn_default" href="{{yUrl(['/site/index'])}}">放弃获取试剂</a>
        {{--<input class="weui-form-preview__btn weui-form-preview__btn_primary" type="submit"  data-pjax=0 data-method="post" data-confirm="您确认要提交吗？" data-params='{"payinfo":"{{$payinfo}}"}'>确认@if($totalPrice>0)并付款@endif</input>--}}
        <a class="weui-form-preview__btn weui-form-preview__btn_primary" href="javascript:;" id="_dosubmit">确认@if($totalPrice>0)并付款@endif</a>
      </div>
    </div>
  </div>
@stop

@push('foot-script')
  <script>
      $(function () {
            {{--var payinfo = '{{$payinfo}}';--}}
          var totalPrice = {{$totalPrice}};
          $('#_dosubmit').on('click', function (e) {
              e.preventDefault();
              $.confirm('您确认要提交订单吗？', '确认', function (e) {
                  if (totalPrice <= 0) {
                      $.jsonPost('{{yUrl(['/user/recv/submitorder2'])}}', {payinfo: '{{$payinfo}}'}, function (result) {
                          $.alert(result.info);
                      })
                  } else {
                      var temp_form = document.createElement("form");
                      temp_form.action = '{{env('WECHAT_PAY_URL')}}';
                      temp_form.method = "post";
                      temp_form.style.display = "none";
                      var opt = document.createElement("input");
                      opt.name = 'json_payinfo';
                      opt.value = '{{$payinfo}}';
                      temp_form.appendChild(opt);
                      document.body.appendChild(temp_form);
                      temp_form.submit();
                  }
              });
          });
      });
  </script>
@endpush
