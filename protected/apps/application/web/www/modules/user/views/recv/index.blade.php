@extends('layouts.main')@section('title','收货信息')

@section('content')
  <header class="app-header">
    <h1 class="app-title">请先输入收货信息</h1>
  </header>
  <form id="_form">
    <div class="weui-cells weui-cells_form">
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">选择发货地：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="logistics" id="logistics" placeholder="请选择发货地" onfocus="this.blur()">
        </div>
      </div>
      <div class="products">
        @foreach($products as $type => $_products)
          <div class="weui-cells__title">{{$model->getTypeName($type)}}</div>
          @if($type == 'free')
            <div class="weui-cells weui-cells_radio">
              <label class="weui-cell weui-check__label" for="xx0">
                <div class="weui-cell__bd">
                  <p>不选择任何试剂</p>
                </div>
                <div class="weui-cell__ft">
                  <input type="radio" class="weui-check" name="product[{{$type}}]" value="0" id="xx0"> <span class="weui-icon-checked"></span>
                </div>
              </label>
              @foreach($_products as $product)
                <label class="weui-cell weui-check__label" for="xx{{$product['id']}}">
                  <div class="weui-cell__bd">
                    <p>{{$product['name']}}</p>
                  </div>
                  <div class="weui-cell__ft">
                    <input type="radio" class="weui-check" name="product[{{$type}}]" value="{{$product['id']}}" id="xx{{$product['id']}}" @if(isset($rel[$product['id']])) data-rel="{{json_encode($rel[$product['id']])}} @endif">
                    <span class="weui-icon-checked"></span>
                  </div>
                </label>
              @endforeach
            </div>
          @else
            @foreach($_products as $product)
              <div class="weui-cell weui-cell_switch">
                <div class="weui-cell__bd">{{$product['name']}} @if($product['price']>0) ({{$product['price']}}) @endif</div>
                <div class="weui-cell__ft">
                  <input id="xx{{$product['id']}}" name="product[{{$type}}][{{$product['id']}}]" class="weui-switch" type="checkbox" @if(isset($rel[$product['id']])) data-rel="{{json_encode($rel[$product['id']])}}" @endif data-price="{{$product['price']}}">
                </div>
              </div>
            @endforeach
          @endif

        @endforeach
      </div>
      <input type="hidden" name="address_uuid" value="{{$address->uuid}}">
      <div class="weui-cells__title">请填写您的收货信息：</div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">收货人：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="name" id="name" value="{{$address->realname}}" placeholder="请使用真实姓名，以名影响收货">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">收货人手机：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="mobile" id="mobile" placeholder="请输入手机号码 " value="{{$address->mobile}}">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">收货城市：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="recv_province" id="recv_province" placeholder="请选择" onfocus="this.blur()" value="{{$address->city}}">
        </div>
      </div>
      <div class="weui-cell">
        <div class="weui-cell__hd"><label class="weui-label">详细地址：</label></div>
        <div class="weui-cell__bd">
          <input class="weui-input" type="text" name="address" id="address" placeholder="请输入" value="{{$address->address}}">
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
      <label for="weuiAgree" class="weui-agree"> <input id="weuiAgree" type="checkbox" class="weui-agree__checkbox" name="default_address" value="1">
        <span class="weui-agree__text">
          将当前输入的地址设置为默认地址
        </span> </label>
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
      var hasDefaultAddress = parseInt('{{$hasDefaultAddress}}', 10);
      var use_address = parseInt('{{$use_address}}', 10);

      var totalPrice = 0;
      $(function () {
          if (hasDefaultAddress > 0 && !use_address) {
              $.confirm('检测到您已经填写过地址信息，是否使用默认地址？', function () {
                  location.href = '{{yUrl(['','use_address'=>1,'type'=>$event_type])}}';
                  return;
              })
          }
          $('input:checkbox').on('click', function () {
              totalPrice = 0;
              $('input:checkbox:checked').each(function () {
                  totalPrice += parseFloat($(this).data('price'));
              })
          });
          $('#sign_date').calendar();
          $("#recv_province").cityPicker({
              showDistrict: true
          });
          $("#logistics").select({
              title: "选择发货地",
              items: {!! $logistics !!}
          }).on('change', function () {
              $('.products input').attr('disabled', false);
              var id = parseInt($(this).data('values'));
              console.log(id);
              $('input[data-rel]').each(function () {
                  if ($.inArray(id, $(this).data('rel')) === -1) {
                      $(this).attr('disabled', true);
                  }
              });
          });
          $('#next-btn').on('click', function () {

              var self = $(this);
              var post = $('#_form').serializeArray();
              post.push({name: "recv_province_code", value: $('#recv_province').data('value')});
              post.push({name: "logistics", value: $('#logistics').data('values')});
//              if (post.recv_province_code == ''){
//                  $.alert('收货城市不能为空');
//                  return ;
//              }
              $.jsonPost($(self).data('post'), post, function (result) {

                  if (result.status) {
                      location.href = '{{$targetUrl}}?eventId=' + result.items.event_uuid;
                      return;
                  }
                  $.alert(result.items[0]);
                  return;
              })
          })
      });
  </script>
@endpush
