@extends('layouts.main')@section('title','申请退回保证金')
@push('head-style')
  <style type="text/css">
    h4{
      text-align:center;
      margin:10px 0;
    }
    /*.weui-uploader__input-box{*/
    /*width: 124px;*/
    /*height: 123px;*/
    /*}*/
  </style>
@endpush
@section('content')

  <div class="weui-cells">
    <div class="weui-media-box__bd">
      <h4 class="weui-media-box__title">申请退回保证金</h4>
    </div>
  </div>
  <div class="weui-cells weui-cells_form">
    <div class="weui-cells__title f-black ">请选择订单</div>
    <div class="weui-cells weui-cells_radio">
      {{--<label class="weui-cell weui-check__label f-888" for="xx0">--}}
      {{--<div class="weui-cell__bd">--}}
      {{--<p>不选择任何试剂</p>--}}
      {{--</div>--}}
      {{--<div class="weui-cell__ft">--}}
      {{--<input type="radio" class="weui-check" name="product[{{$type}}]" value="0" id="xx0"> <span class="weui-icon-checked"></span>--}}
      {{--</div>--}}
      {{--</label>--}}

      @forelse($orderList as $product)
        <label class="weui-cell weui-check__label f-888" for="xx{{$product['uuid']}}">
          <div class="weui-cell__bd">
            <p>{{$product['description']}}</p>
          </div>
          <div class="weui-cell__ft">
            <input type="radio" class="weui-check" name="orderlist" value="{{$product['uuid']}}" id="xx{{$product['uuid']}}" @if($loop->first)checked="checked" @endif>
            <span class="weui-icon-checked"></span>
          </div>
        </label>
      @empty
        <label class="weui-cell weui-check__label f-888" for="xx_noorder">
          <div class="weui-cell__bd"><p>当前没有可以退回保证金的订单</p></div>
        </label>
      @endforelse
    </div>
    <div class="weui-cell">
      <div class="weui-cell__hd">
        <label for="name" class="weui-label">支付宝帐号</label>
      </div>
      <div class="weui-cell__bd">
        <input class="weui-input alipay" type="text" placeholder="请正确输入支付宝帐号">
      </div>
    </div>
  </div>
  {{--<div class="weui-cells weui-cells_form">--}}
  {{--<div class="weui-cell">--}}
  {{--<div class="weui-cell__hd">--}}
  {{--<label for="name" class="weui-label">选择订单</label>--}}
  {{--</div>--}}
  {{--<div class="weui-cell__bd">--}}
  {{--<input class="weui-input" id="order" type="text"  onfocus="this.blur()">--}}
  {{--<select class="weui-select" name="order" id="order">--}}
  {{--@foreach( $orderList as $item )--}}
  {{--<option value="{{$item['uuid']}}">{{$item['info'].$item['created_at']}}</option>--}}
  {{--@endforeach--}}
  {{--</select>--}}
  {{--</div>--}}
  {{--</div>--}}
  {{--<div class="weui-cell">--}}
  {{--<div class="weui-cell__hd">--}}
  {{--<label for="name" class="weui-label">支付宝帐号</label>--}}
  {{--</div>--}}
  {{--<div class="weui-cell__bd">--}}
  {{--<input class="weui-input alipay" type="text" placeholder="请正确输入支付宝帐号">--}}
  {{--</div>--}}
  {{--</div>--}}
  {{--</div>--}}
  {{--    @if( gPayStatus($orderData['pay_status']) == '已支付' && (gOrderStatus($orderData['pay_status'])=='已发货' || gOrderStatus($orderData['pay_status'])=='已收货') )--}}
  @if($orderList)
    <a href="javascript:;" class="weui-btn weui-btn_primary apply_back" style="margin-top:1rem;">申请退回保证金</a>
  @endif


  {{--@endif--}}
@stop

@push('foot-script')
  <script>
      $(function () {
//            order_list();

          $(".apply_back").click(function () {

              if (!$("#order").val()) {
                  $.toast('请完整填写表单！', 'forbidden');
                  return false;
              }
              var data = {
                  'method': 'payback',
                  'order_uuid': $("#order").val(),
                  'alipay': $('.alipay').val(),

              };
              $.post("{{ yUrl(['order/payback']) }}", data, function (res) {
                  if (res.code == '200') {
                      $.toast('操作成功！');
                      location.href = "{{yUrl(['/site/index'])}}";
                  }
              })
          });


      });

      function order_list() {
          $.post("{{ yUrl(['order/payback']) }}", {'method': 'list'}, function (res) {
              var items = [];
              for (var i = 0; i < res.length; i++) {
                  var order = {title: '', value: ''};
                  order.title = res[i]['info'] + res[i]['created_at'];
                  order.value = res[i]['uuid'];
                  items.push(order);
              }
              $("#order").select({
                  title: "选择订单",
                  items: items
              });
          })
      }
  </script>
@endpush
