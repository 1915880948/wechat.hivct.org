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
    <p> 3、审核不通过的，不能更新检测结果。</p>
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
            <div class="input_images"></div>
            <div class="col-md-3" style="margin: 10px;">
              <button class="up_images" id="up_images_uploader" style="background: #ede6ff;">+上传</button>
              <button class="save_up_images" id="save_up_images" style="background: #ede6ff;">保存</button>
            </div>
            @if($images)
              <div class="form-group col-md-12" style="margin: 10px;">
                <label class="col-md-2 control-label">订单审核</label>
                <div class="col-md-3">
                  <select class="form-control apply_result" id="apply_result">
                    <option value="0" {{$orderData['is_to_examine']==0?'selected':''}}>未审核</option>
                    <option value="1" {{$orderData['is_to_examine']==1?'selected':''}}>通过</option>
                    <option value="2" {{$orderData['is_to_examine']==2?'selected':''}}>未通过</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <textarea class="form-control examine_reason" id="examine_reason" cols="9" rel="3" placeholder="未通过原因" style="display: none;">{{$orderData['examine_reason']}}</textarea>
                </div>
                <label class="col-md-3 control-label">
                  <input type="button" class="input-group-btn btn btn-default btn-sm input-small examine_save" value="保存" style="background: #3fd5c0;color: #ffffff;">
                </label>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    @if($orderData['is_to_examine'] == 1 )
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
                <label class="col-md-8 control-label">支付宝账号</label>
                <div class="col-md-4">
                  {{ $orderData['alipay'] }}
                </div>
              </div>
              <div class="col-xs-12">
                  <label class="col-md-3 control-label">艾滋病检测结果</label>
                  <div class="col-md-6">
                      <select class="form-control input-inline input-medium adis_result">
                          @foreach($checkArr as $k=>$v)
                              <option value="{{$k}}" {{$orderData['adis_result']==$k?'selected':''}}>{{$v}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="col-xs-6">
                      <label class="col-md-6 control-label">是否确证</label>
                      <div class="col-md-6">
                          <select class="form-control input-inline adis_is_confirm">
                              @foreach($isNotArr as $k=>$v)
                                  <option value="{{$k}}" {{$orderData['adis_is_confirm']==$k?'selected':''}}>{{$v}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <label class="col-md-4 control-label">确证时间</label>
                      <div class="col-md-8">
                          <input class="form-control adis_confirm_time" value="{{$orderData['adis_confirm_time']}}" >
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <label class="col-md-6 control-label">是否治疗</label>
                      <div class="col-md-6">
                          <select class="form-control input-inline  adis_is_cure">
                              @foreach($isNotArr as $k=>$v)
                                  <option value="{{$k}}" {{$orderData['adis_is_cure']==$k?'selected':''}}>{{$v}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <label class="col-md-4 control-label">治疗时间</label>
                      <div class="col-md-8">
                          <input class="form-control adis_cure_time" value="{{$orderData['adis_cure_time']}}">
                      </div>
                  </div>
              </div>
              <div class="col-xs-12">
                <label class="col-md-3 control-label">梅毒检测结果</label>
                <div class="col-md-6">
                  <select class="form-control input-inline input-medium syphilis_result">
                      @foreach($checkArr as $k=>$v)
                          <option value="{{$k}}" {{$orderData['syphilis_result']==$k?'selected':''}}>{{$v}}</option>
                      @endforeach
                  </select>
                </div>
                  <div class="col-xs-6">
                      <label class="col-md-6 control-label">是否确证</label>
                      <div class="col-md-6">
                          <select class="form-control input-inline syphilis_is_confirm">
                              @foreach($isNotArr as $k=>$v)
                                  <option value="{{$k}}" {{$orderData['syphilis_is_confirm']==$k?'selected':''}}>{{$v}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <label class="col-md-4 control-label">确证时间</label>
                      <div class="col-md-8">
                          <input class="form-control syphilis_confirm_time" value="{{$orderData['syphilis_confirm_time']}}" >
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <label class="col-md-6 control-label">是否治疗</label>
                      <div class="col-md-6">
                          <select class="form-control input-inline  syphilis_is_cure">
                              @foreach($isNotArr as $k=>$v)
                                  <option value="{{$k}}" {{$orderData['syphilis_is_cure']==$k?'selected':''}}>{{$v}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <label class="col-md-4 control-label">治疗时间</label>
                      <div class="col-md-8">
                          <input class="form-control syphilis_cure_time" value="{{  $orderData['syphilis_cure_time']}}">
                      </div>
                  </div>

              </div>
              <div class="col-xs-12">
                <label class="col-md-3 control-label">甲肝检测结果</label>
                <div class="col-md-6">
                  <select class="form-control input-inline input-medium hepatitis_b_result">
                      @foreach($checkArr as $k=>$v)
                          <option value="{{$k}}" {{$orderData['hepatitis_b_result']==$k?'selected':''}}>{{$v}}</option>
                      @endforeach
                  </select>
                </div>
                  <div class="col-xs-6">
                      <label class="col-md-6 control-label">是否确证</label>
                      <div class="col-md-6">
                          <select class="form-control input-inline hepatitis_b_is_confirm">
                              @foreach($isNotArr as $k=>$v)
                                  <option value="{{$k}}" {{$orderData['hepatitis_b_is_confirm']==$k?'selected':''}}>{{$v}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <label class="col-md-4 control-label">确证时间</label>
                      <div class="col-md-8">
                          <input class="form-control hepatitis_b_confirm_time" value="{{$orderData['hepatitis_b_confirm_time']}}" >
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <label class="col-md-6 control-label">是否治疗</label>
                      <div class="col-md-6">
                          <select class="form-control input-inline  hepatitis_b_is_cure">
                              @foreach($isNotArr as $k=>$v)
                                  <option value="{{$k}}" {{$orderData['hepatitis_b_is_cure']==$k?'selected':''}}>{{$v}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <label class="col-md-4 control-label">治疗时间</label>
                      <div class="col-md-8">
                          <input class="form-control hepatitis_b_cure_time" value="{{ $orderData['hepatitis_b_cure_time'] }}">
                      </div>
                  </div>

              </div>
              <div class="col-xs-12">
                <label class="col-md-3 control-label">乙肝检测结果</label>
                <div class="col-md-6">
                  <select class="form-control input-inline input-medium hepatitis_c_result">
                      @foreach($checkArr as $k=>$v)
                          <option value="{{$k}}" {{$orderData['hepatitis_c_result']==$k?'selected':''}}>{{$v}}</option>
                      @endforeach
                  </select>
                </div>
                  <div class="col-xs-6">
                      <label class="col-md-6 control-label">是否确证</label>
                      <div class="col-md-6">
                          <select class="form-control input-inline hepatitis_c_is_confirm">
                              @foreach($isNotArr as $k=>$v)
                                  <option value="{{$k}}" {{$orderData['hepatitis_c_is_confirm']==$k?'selected':''}}>{{$v}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <label class="col-md-4 control-label">确证时间</label>
                      <div class="col-md-8">
                          <input class="form-control hepatitis_c_confirm_time" value="{{$orderData['hepatitis_c_confirm_time']}}" >
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <label class="col-md-6 control-label">是否治疗</label>
                      <div class="col-md-6">
                          <select class="form-control input-inline  hepatitis_c_is_cure">
                              @foreach($isNotArr as $k=>$v)
                                  <option value="{{$k}}" {{$orderData['hepatitis_c_is_cure']==$k?'selected':''}}>{{$v}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="col-xs-6">
                      <label class="col-md-4 control-label">治疗时间</label>
                      <div class="col-md-8">
                          <input class="form-control hepatitis_c_cure_time" value="{{ $orderData['hepatitis_c_cure_time'] }}">
                      </div>
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
    @endif
    <div class="col-xs-6">
      <div class="portlet blue-hoki box">
        <div class="portlet-title">
          <div class="caption">
            <i class="fa fa-cogs"></i>订单号
          </div>
          <div class="actions"></div>
        </div>
        <div class="portlet-body">
          <div class="row static-info">
            <div class="col-md-4 name"> 内部流水号:</div>
            <div class="col-md-8 value"> {{ ($orderData['out_trade_no']) }} </div>
          </div>
          <div class="row static-info">
            <div class="col-md-4 name"> 微信订单号:</div>
            <div class="col-md-8 value"> {{ ($orderData['wx_transaction_id']) }}</div>
          </div>
        </div>
      </div>
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
              @if($userinfo->is_admin)
                <select class="form-control input-inline input-medium order_status">
                  <option value="-1">请选择操作状态</option>
                  @foreach($orderStatus as $k=>$v)
                    <option value="{{$k}}" {{ $orderData['order_status']==$k?'selected':'' }}>{{$v}}</option>
                  @endforeach
                </select>
              @else
                {{$orderStatus[$orderData['order_status']] or ''}}
              @endif
            </div>
          </div>
          <div class="row static-info">
            <div class="col-xs-4"></div>
            <div class="col-xs-8">
              @if($userinfo->is_admin)
                <input type="button" class="input-group-btn btn btn-default btn-sm input-small update" value="更新订单状态" style="background: #3fd5c0;color: #ffffff;">
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
@push('head-style')
  <style type="text/css"></style>
@endpush
@push('foot-script')
  <script src="{{gStatic('vendor/plugins/qiniu/plupload.min.js')}}"></script>
  <script src="{{gStatic('vendor/plugins/plupload/i18n/zh_CN.js')}}"></script>
  <script src="{{gStatic('vendor/plugins/qiniu/qiniu.min.js')}}"></script>
  <script src="{{gStatic('vendor/plugins/qiniu/progress.js')}}"></script>
  <script src="{{gStatic('vendor/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
  <script>
      $(function () {
          $('.adis_confirm_time,.adis_cure_time,.syphilis_confirm_time,.syphilis_cure_time,.hepatitis_b_confirm_time,.hepatitis_b_cure_time,.hepatitis_c_confirm_time,.hepatitis_c_cure_time').datepicker({
              autoclose: true,
              format: 'yyyy-mm-dd',
          });

          $(".up_images").click(function () {
              uploader();
          });
          $("#save_up_images").click(function () {
              var images = '';
              $('.input_images img').each(function () {
                  images += $(this).attr('src') + ',';
              });
              if (images) {
                  $.post("{{yUrl(['site/payimages'])}}", {
                      'user_id': "{{$orderData['uid']}}",
                      'uuid': "{{$orderData['uuid']}}",
                      'images': images
                  }, function (res) {
                      if (res.code == 200) {
                          layer.msg('保存成功！！', {'icon': 1, time: 1200}, function () {
                              location.reload();
                          });
                      }
                  });
              }
          });
          examine_reason();
          $('#apply_result').change(function () {
              examine_reason();
          });
          $('.examine_save').click(function () {
              $.post("{{yUrl(['site/applydeal'])}}",
                  {
                      'uuid': "{{$orderData['uuid']}}",
                      'is_to_examine': $(".apply_result").val(),
                      'examine_reason': $(".examine_reason").val()
                  }, function (res) {
                      if (res.code == 200) {
                          layer.msg('保存成功！！', {'icon': 1, time: 1200}, function () {
                              location.reload();
                          });
                      }
                  }
              );
          });

          $(".save").click(function () {
              $.post("{{yUrl(['site/deal'])}}",
                  {
                      'uuid': "{{ $orderData['uuid'] }}",
                      'method': 'deal_check',
                      'adis_result': $(".adis_result").val(),
                      'adis_is_confirm': $(".adis_is_confirm").val(),
                      'adis_confirm_time': $(".adis_confirm_time").val(),
                      'adis_is_cure': $(".adis_is_cure").val(),
                      'adis_cure_time': $(".adis_cure_time").val(),
                      'syphilis_result': $(".syphilis_result").val(),
                      'syphilis_is_confirm': $(".syphilis_is_confirm").val(),
                      'syphilis_confirm_time': $(".syphilis_confirm_time").val(),
                      'syphilis_is_cure': $(".syphilis_is_cure").val(),
                      'syphilis_cure_time': $(".syphilis_cure_time").val(),
                      'hepatitis_b_result': $(".hepatitis_b_result").val(),
                      'hepatitis_b_is_confirm': $(".hepatitis_b_is_confirm").val(),
                      'hepatitis_b_confirm_time': $(".hepatitis_b_confirm_time").val(),
                      'hepatitis_b_is_cure': $(".hepatitis_b_is_cure").val(),
                      'hepatitis_b_cure_time': $(".hepatitis_b_cure_time").val(),
                      'hepatitis_c_result': $(".hepatitis_c_result").val(),
                      'hepatitis_c_is_confirm': $(".hepatitis_c_is_confirm").val(),
                      'hepatitis_c_confirm_time': $(".hepatitis_c_confirm_time").val(),
                      'hepatitis_c_is_cure': $(".hepatitis_c_is_cure").val(),
                      'hepatitis_c_cure_time': $(".hepatitis_c_cure_time").val(),

                      //'order_status': $(".order_status").val(),
                      'check_doctor': $("#check_doctor").val(),
                      'check_desc': $("#check_desc").val()
                  }, function (res) {
                      if (res.code == 200) {
                          layer.msg('操作成功！！', {'icon': 1, time: 1200}, function () {
                              location.reload();
                          });
                      }
                  }
              );
          });

          $(".update").click(function () {

              var orderStatus = $(".order_status").val();
              if (orderStatus === '-1') {
                  layer.msg('未选择订单状态');
                  return;
              }

              $.post("{{yUrl(['site/deal'])}}",
                  {
                      'uuid': "{{ $orderData['uuid'] }}",
                      'method': 'deal_status',
                      'order_status': $(".order_status").val()
                  }, function (res) {
                      if (res.code == 200) {
                          layer.msg('操作成功！！', {'icon': 1, time: 1200}, function () {
                              location.reload();
                          });
                      }
                  }
              );
          });
      });

      function examine_reason() {
          $('#examine_reason').css("display", $("#apply_result").val() == 2 ? "block" : "none");
          // if ($("#apply_result").val() == 2) {
          //     document.getElementById("examine_reason").style.display = "block";
          // } else {
          //     document.getElementById("examine_reason").style.display = "none";
          // }
      }

      function uploader(id) {
          return Qiniu.uploader({
              runtimes: 'html5,flash,html4',    //上传模式,依次退化
              browse_button: "up_images_uploader",       //上传选择的点选按钮，**必需**
              uptoken_url: '{{yUrl(['/site/uptoken','type'=>'image'])}}',            //Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
              // uptoken : '', //若未指定uptoken_url,则必须指定 uptoken ,uptoken由其他程序生成
              // unique_names: true, // 默认 false，key为文件名。若开启该选项，SDK为自动生成上传成功后的key（文件名）。
              // save_key: true,   // 默认 false。若在服务端生成uptoken的上传策略中指定了 `sava_key`，则开启，SDK会忽略对key的处理
              domain: "{{env('QINIU_DOMAIN')}}",   //bucket 域名，下载资源时用到，**必需**
              get_new_uptoken: true,  //设置上传文件的时候是否每次都重新获取新的token
              //              container: 'container',           //上传区域DOM ID，默认是browser_button的父元素，
              max_file_size: '100mb',           //最大文件体积限制
              flash_swf_url: '{{yStatic('vendor/plugins/plupload/Moxie.swf')}}',  //引入flash,相对路径
              max_retries: 3,                   //上传失败最大重试次数
              dragdrop: false,                   //开启可拖曳上传
              //              drop_element: 'field-reagent-image',        //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
              chunk_size: '4mb',                //分块上传时，每片的体积
              auto_start: true,                 //选择文件后自动上传，若关闭需要自己绑定事件触发上传
              multi_selection: false,
              filters: {
                  mime_types: [ //只允许上传文件格式
                      {title: "image files", extensions: "jpg,png,jpeg"}
                  ]
              },
              init: {
                  'FilesAdded': function (up, files) {
                  },
                  'BeforeUpload': function (up, file) {
                  },
                  'UploadProgress': function (up, file) {
                  },
                  'UploadComplete': function () {
                  },
                  'FileUploaded': function (up, file, info) {
                      var res = JSON.parse(info);
                      console.log(res.key);
                      var input_image = '<a href="{{env('QINIU_DOMAIN')}}/' + res.key + '" target="_blank"> <img src="{{env('QINIU_DOMAIN')}}/' + res.key + '" width="200"/> </a>';

                      $('.input_images').append(input_image);
                  },
                  'Error': function (up, err, errTip) {
                      console.log(err, errTip)
                  }
              }
          });
      }
  </script>
@endpush
