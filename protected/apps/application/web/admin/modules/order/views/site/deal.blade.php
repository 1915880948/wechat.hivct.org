@extends('layouts.main')@section('title','订单处理')
@push('head-style')
    <style type="text/css">
        .col-xs-12{margin-bottom: 20px;
        }
    </style>

@endpush

@section('content')
  @include('global.breadcrumb',['title'=>'订单处理','subtitle'=>'订单处理','breads'=>[[
      'label' => '订单处理 ',
      'url'   => yRoute($selfurl),
  ]]])
  <hr/>

  <div class="col-xs-12" style="">
    <label class="col-md-3 control-label">自检结果图片：</label>
    <div class="col-xs-9">
      @foreach($images as $item )
        <div class="col-xs-3">
          @if(strpos($item['image'],'http:')!==false)
            <a href="{{$item['image']}}" target="_blank"> <img src="{{$item['image']}}" width="200"/> </a>
          @else
            <a href="{{env('QINIU_DOMAIN')}}/{{$item['image']}}" target="_blank"> <img src="{{env('QINIU_DOMAIN')}}/{{$item['image']}}" width="200"/> </a>
          @endif
        </div>
      @endforeach
    </div>
  </div>
  <div class="col-xs-12">
    <label class="col-md-3 control-label">支付宝帐号：</label>
    <div class="col-md-9">
      {{ $orderData['alipay'] }}
    </div>
  </div>
  <div class="col-xs-12">
      <label class="col-md-3 control-label">艾滋病检测结果</label>
      <div class="col-md-6">
          <select class="form-control input-inline input-medium adis_result">
              <option value="0">未检测</option>
              <option value="1">阴性</option>
              <option value="2">阳性</option>
          </select>
      </div>
  </div>
  <div class="col-xs-12">
      <label class="col-md-3 control-label">梅毒检测结果</label>
      <div class="col-md-6">
          <select class="form-control input-inline input-medium syphilis_result">
              <option value="0">未检测</option>
              <option value="1">阴性</option>
              <option value="2">阳性</option>
          </select>
      </div>
  </div>
  <div class="col-xs-12">
      <label class="col-md-3 control-label">甲肝检测结果</label>
      <div class="col-md-6">
          <select class="form-control input-inline input-medium hepatitis_b_result">
              <option value="0">未检测</option>
              <option value="1">阴性</option>
              <option value="2">阳性</option>
          </select>
      </div>
  </div>
  <div class="col-xs-12">
      <label class="col-md-3 control-label">乙肝检测结果</label>
      <div class="col-md-6">
          <select class="form-control input-inline input-medium hepatitis_c_result">
              <option value="0">未检测</option>
              <option value="1">阴性</option>
              <option value="2">阳性</option>
          </select>
      </div>
  </div>
  <div class="col-xs-12">
      <label class="col-md-3 control-label">操作状态</label>
      <div class="col-md-6">
          <select class="form-control input-inline input-medium deal_name">
              <option value="12">退款审核</option>
              <option value="13">退款成功</option>
              <option value="14">退款失败</option>
              <option value="18">退款处理中</option>
              <option value="19">退款完成</option>
              <option value="99">订单完成</option>
          </select>
      </div>
      <label class="col-md-3 control-label">
          <input type="button" class="input-group-btn btn btn-default btn-sm input-small save" value="保存" style="background: #3fd5c0;color: #ffffff;"> </label>
  </div>

@endsection
@push('head-style')
  <style type="text/css">
    #ship-content .form-group{
      text-align:center;
      padding:20px;
    }
  </style>
@endpush
@push('foot-script')
  <script>
      $(function () {
          $(".save").click(function (i) {
              if ($(".deal_name").val()) {
                  $.post("{{yUrl(['site/deal'])}}",
                      {
                          'uuid': "{{ $orderData['uuid'] }}",
                          'back_url': "{{$selfurl}}",
                          'order_status': $(".deal_name").val()
                      }, function (res) {
                          if (res.code == 200) {
                              layer.msg('操作成功！！', {'icon': 1, time: 1200}, function () {
                                  location.href = "{{yUrl(['/order/site'])}}";
                              });
                          }
                      }
                  );
              } else {
                  $("#deal-content .form-group").addClass("has-error");
              }
          });
      });
  </script>
@endpush
