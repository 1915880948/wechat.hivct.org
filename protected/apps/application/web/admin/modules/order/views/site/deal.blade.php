@extends('layouts.main')@section('title','订单处理')
@push('head-style')

@endpush

@section('content')
  @include('global.breadcrumb',['title'=>'订单处理','subtitle'=>'订单处理','breads'=>[[
      'label' => '订单处理 ',
      'url'   => yRoute($selfurl),
  ]]])
  <div class="note note-success">
    <h4 class="block">操作逻辑</h4>
    <p> 1、未上传图片前，且用户没有申请退款时，不能修改订单状态</p>
    <p> 2、未上传图片时，后台管理员可以帮助用户上传</p>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="portlet blue-hoki box">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-cogs"></i>自检结果图片
          </div>
          <div class="actions"></div>
        </div>
        <div class="portlet-body">
          <div class="row static-info">
            @forelse($images as $item )
              <div class="col-md-3">
                @if(strpos($item['image'],'http:')!==false)
                  <a href="{{$item['image']}}" target="_blank"> <img src="{{$item['image']}}" width="200"/> </a>
                @else
                  <a href="{{env('QINIU_DOMAIN')}}/{{$item['image']}}" target="_blank"> <img src="{{env('QINIU_DOMAIN')}}/{{$item['image']}}" width="200"/> </a>
                @endif
              </div>
            @empty
              <div class="col-md-12">
                图片尚未上传（选择图片上传-->这里允许多文件上传）
              </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6">
      <div class="portlet blue-hoki box">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-cogs"></i>更新检测结果
          </div>
          <div class="actions"></div>
        </div>
        <div class="portlet-body">
          <div class="row static-info">
            <div class="col-xs-12">
              <label class="col-md-3 control-label">支付宝账号</label>
              <div class="col-md-6">
                {{ $orderData['alipay'] }}
              </div>
            </div>
            <div class="col-xs-12">
              <label class="col-md-3 control-label">艾滋病检测结果</label>
              <div class="col-md-6">
                <select class="form-control input-inline input-medium adis_result">
                  <option value="0">未检测</option>
                  <option value="1" {{$orderData['adis_result']==1?'selected':''}}>阴性</option>
                  <option value="2" {{$orderData['adis_result']==2?'selected':''}}>阳性</option>
                </select>
              </div>
            </div>
            <div class="col-xs-12">
              <label class="col-md-3 control-label">梅毒检测结果</label>
              <div class="col-md-6">
                <select class="form-control input-inline input-medium syphilis_result">
                  <option value="0">未检测</option>
                  <option value="1" {{$orderData['syphilis_result']==1?'selected':''}}>阴性</option>
                  <option value="2" {{$orderData['syphilis_result']==2?'selected':''}}>阳性</option>
                </select>
              </div>
            </div>
            <div class="col-xs-12">
              <label class="col-md-3 control-label">甲肝检测结果</label>
              <div class="col-md-6">
                <select class="form-control input-inline input-medium hepatitis_b_result">
                  <option value="0">未检测</option>
                  <option value="1" {{$orderData['hepatitis_b_result']==1?'selected':''}}>阴性</option>
                  <option value="2" {{$orderData['hepatitis_b_result']==2?'selected':''}}>阳性</option>
                </select>
              </div>
            </div>
            <div class="col-xs-12">
              <label class="col-md-3 control-label">乙肝检测结果</label>
              <div class="col-md-6">
                <select class="form-control input-inline input-medium hepatitis_c_result">
                  <option value="0">未检测</option>
                  <option value="1" {{$orderData['hepatitis_c_result']==1?'selected':''}}>阴性</option>
                  <option value="2" {{$orderData['hepatitis_c_result']==2?'selected':''}}>阳性</option>
                </select>
              </div>
            </div>
            <div class="col-xs-12">
              <label class="col-md-3 control-label">检测医生</label>
              <div class="col-md-6">
                <input class="form-control " type="text" name="check_doctor" id="check_doctor" value="{{$orderData['check_doctor']}}" placeholder="检测医生">
              </div>
            </div>
            <div class="col-xs-12">
              <label class="col-md-3 control-label">检测描述</label>
              <div class="col-md-6">
                <textarea class="form-control " cols="9" rel="3" id="check_desc">{{$orderData['check_desc']}}</textarea>
              </div>
              <label class="col-md-3 control-label">
                <input type="button" class="input-group-btn btn btn-default btn-sm input-small save" value="保存" style="background: #3fd5c0;color: #ffffff;">
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xs-6">
      <div class="portlet blue-hoki box">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-cogs"></i>订单状态处理
          </div>
          <div class="actions"></div>
        </div>
        <div class="portlet-body">
          <div class="row static-info">
            <div class="col-xs-4">订单状态</div>
            <div class="col-xs-8">
              <select class="form-control input-inline input-medium deal_name" {{ $userinfo->is_admin?'':'disabled' }} >
                @foreach($orderStatus as $k=>$v)
                  <option value="{{$k}}" {{ $orderData['order_status']==$k?'selected':'' }}>{{$v}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row static-info">
            <div class="col-xs-4"></div>
            <div class="col-xs-8">
              <input type="button" class="input-group-btn btn btn-default btn-sm input-small update" value="更新订单状态" style="background: #3fd5c0;color: #ffffff;">
            </div>
          </div>
        </div>
      </div>
    </div>
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
                          'adis_result': $(".adis_result").val(),
                          'syphilis_result': $(".syphilis_result").val(),
                          'hepatitis_b_result': $(".hepatitis_b_result").val(),
                          'hepatitis_c_result': $(".hepatitis_c_result").val(),
                          'order_status': $(".deal_name").val(),
                          'check_doctor': $("#check_doctor").val(),
                          'check_desc': $("#check_desc").val()
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
