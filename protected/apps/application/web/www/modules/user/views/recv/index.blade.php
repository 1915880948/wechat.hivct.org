@extends('layouts.main')@section('title','收货信息')

@section('content')
  <header class="app-header">
    <h1 class="app-title">请先输入收货信息</h1>
  </header>
  <form id="_form">
    <div class="weui-cells weui-cells_form">
      @foreach($products as $type => $_products)
        <div class="weui-cells__title">{{$model->getTypeName($type)}}</div>
        @foreach($_products as $product)
          <div class="weui-cell weui-cell_switch">
            <div class="weui-cell__bd">{{$product['name']}} @if($product['price']>0) ({{$product['price']}}) @endif</div>
            <div class="weui-cell__ft">
              <input id="is_use_drug" name="is_use_drug" class="weui-switch" type="checkbox" data-price="{{$product['price']}}">
            </div>
          </div>
        @endforeach
      @endforeach
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">收货人：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="name" id="name" placeholder="请使用真实姓名，以名影响收货">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">收货人手机：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="mobile" id="mobile" placeholder="请输入手机号码 ">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">收货城市：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="recv_province" id="recv_province" placeholder="请选择" onfocus="this.blur()">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">详细地址：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="address" id="address" placeholder="请输入">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">备注信息： </label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="memo" id="memo" placeholder="请选择">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label for="" class="weui-label">申请试剂日期</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="sign_date" id="sign_date" value="{{date('Y-m-d')}}" data-toggle='date'>
        </div>
      </div>
      <div class="weui-btn-area">
        {{--<a class="weui-btn weui-btn_primary" data-next="{{yUrl(['/survey/selfcheckingsex'])}}" id="next-btn">继续 性行为调查</a>--}}
        {!! yLink('确认，并开始进行自我检测','javascript:;',['class'=>'weui-btn weui-btn_primary','id'=>'next-btn','data'=>[
          'next'=>yUrl(['/survey/selfcheckingbase']),
          'post'=>yUrl(['/user/recv/save'])
        ]]) !!}
      </div>
    </div>
  </form>
@stop

@push('foot-script')
  <script src="{{yStatic('js/city-picker.js')}}"></script>

  <script>
    var totalPrice = 0;
      $(function () {
          $('input:checkbox').on('click',function () {
              totalPrice = 0;
              $('input:checkbox:checked').each(function () {
                  totalPrice+= parseFloat($(this).data('price'));
              })
          });
          $('#sign_date').calendar();
          $("#recv_province").cityPicker({
              showDistrict: true
          });
          $('#next-btn').on('click', function () {
              console.log(totalPrice);
              return ;
              var self = $(this);
              var post = {

              };

              $.jsonPost($(self).data('post'), post, function (result) {
                  if (result.status) {
                      location.href = $(self).data('next') + '?id=' + result.items.id;
                      return;
                  }
                  $.alert(result.items[0]);
              })
          })
      });
  </script>
@endpush
