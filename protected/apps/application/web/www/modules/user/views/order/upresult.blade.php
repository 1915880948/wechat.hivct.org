@extends('layouts.main')@section('title','自检结果上传')
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
      <h4 class="weui-media-box__title">自检结果上传</h4>
    </div>
  </div>
  <div class="weui-cells weui-cells_form">
    <div class="weui-cells__title f-black ">选择订单</div>
    <div class="weui-cells weui-cells_radio">
      {{--<label class="weui-cell weui-check__label f-888" for="xx0">--}}
      {{--<div class="weui-cell__bd">--}}
      {{--<p>不选择任何试剂</p>--}}
      {{--</div>--}}
      {{--<div class="weui-cell__ft">--}}
      {{--<input type="radio" class="weui-check" name="product[{{$type}}]" value="0" id="xx0"> <span class="weui-icon-checked"></span>--}}
      {{--</div>--}}
      {{--</label>--}}

      @foreach($orderList as $product)
        <label class="weui-cell weui-check__label f-888" for="xx{{$product['uuid']}}">
          <div class="weui-cell__bd">
            <p>{{$product['description']}}</p>
          </div>
          <div class="weui-cell__ft">
            <input type="radio" class="weui-check" name="orderlist" value="{{$product['uuid']}}" id="xx{{$product['uuid']}}" @if($loop->first)checked="checked" @endif>
            <span class="weui-icon-checked"></span>
          </div>
        </label>
      @endforeach
    </div>
    <div class="weui-cell">
      <div class="weui-cell__bd">
        <div class="weui-uploader">
          <div class="weui-uploader__bd">
            <ul class="weui-uploader__files" id="uploaderFiles"></ul>
            <div class="weui-uploader__input-box" id="fileArr">
              <form id="file_form" enctype="multipart/form-data">
                <input type="hidden" name="token">
              </form>
              <input class="weui-uploader__input uploader" id="uploader" type="file" accept="image/*"/>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{--    @if( gPayStatus($orderData['pay_status']) == '已支付' && (gOrderStatus($orderData['pay_status'])=='已发货' || gOrderStatus($orderData['pay_status'])=='已收货') )--}}
  <a href="javascript:;" class="weui-btn weui-btn_primary apply_back" style="margin-top:1rem;">保存</a>
  {{--@endif--}}
@stop

@push('foot-script')
  <script src="{{yStatic('qiniu/moxie.dev.js')}}"></script>
  {{--<script src="{{yJsFileVer(yStatic('qiniu/plupload.dev.js'),env('ASSET_VERSION'))}}"></script>--}}
  {!! yJsFileVer(yStatic('qiniu/plupload.dev.js'),env('ASSET_VERSION')) !!}
  <script src="{{yStatic('qiniu/qiniu2.min.js') }}"></script>
  {{--<script src="{{yStatic('qiniu/progress.js')}}"></script>--}}
  <script>
      var uploader;
      $(function () {
          // order_list();
          $(".apply_back").click(function () {
              var images = '';
              $('input[name="images[]"]').each(function () {
                  images += $(this).val() + ',';
              });
              var orderUUID = $("input[name='orderlist']:checked").val()||'';
              if (orderUUID === '' || !images) {
                  $.alert('请选择订单且上传上应的图片！','警告');
                  return false;
              }
              var data = {
                  'order_uuid':orderUUID ,
                  'alipay': $('.alipay').val(),
                  'images': images
              };
              $.post("{{ yUrl(['images/index']) }}", data, function (res) {
                  if (res.code == '200') {
                      $.toast('操作成功！');
                      location.href = "{{yUrl(['order/payback'])}}";
                  }
              })
          });
          uploader = Qiniu.uploader({
              runtimes: 'html5,flash,html4',      // 上传模式，依次退化
              browse_button: 'uploader',          // 上传选择的点选按钮，必需
              uptoken_url: "{{yUrl(['/site/uptoken'],true)}}",         // Ajax请求uptoken的Url，强烈建议设置（服务端提供）
              unique_names: true, // 默认 false，key为文件名。若开启该选项，SDK为自动生成上传成功后的key（文件名）。
              // save_key: true,   // 默认 false。若在服务端生成uptoken的上传策略中指定了 `sava_key`，则开启，SDK会忽略对key的处理
              get_new_uptoken: true,              // 设置上传文件的时候是否每次都重新获取新的uptoken
              domain: "{{env('QINIU_DOMAIN')}}",     // bucket域名，下载资源时用到，必需
              max_file_size: '100mb',             // 最大文件体积限制
              max_retries: 3,                     // 上传失败最大重试次数
              dragdrop: false,                    // 开启可拖曳上传
              chunk_size: '4mb',                  // 分块上传时，每块的体积
              auto_start: true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传
              container: 'fileArr',                //难道因为这？
              multi_selection: false,
              filters: {
                  mime_types: [ //只允许上传文件格式
                      // { title : "Image files", extensions : "jpg,gif,png" }
                  ],
                  prevent_duplicates: true
              },
              resize: {
                  width: 800,
                  height: 800,
                  // crop: true,
                  preserve_headers: false
              },
              init: {
                  'FilesAdded': function (up, files) {
                  },
                  'BeforeUpload': function (up, file) {
                  },
                  'UploadProgress': function (up, file) {
                      NProgress.start();
                  },
                  'FileUploaded': function (up, file, info) {
                      NProgress.done();
                      layer.msg('上传成功', {time: 1200}, function () {
                      });
                      if (typeof info !== "object") {
                          var res = JSON.parse(info);
                      } else {
                          var res = JSON.parse(info.response);
                      }
                      var sourceLink = "{{env('QINIU_DOMAIN')}}/" + res.key; //获取上传成功后的文件的Url
                      console.log(sourceLink);

                      var imgLink = Qiniu.imageView2({
                          mode: 0,  // 缩略模式，共6种[0-5]
                          w: 150,   // 具体含义由缩略模式决定
                          h: 150   // 具体含义由缩略模式决定
                          //                        q: 60,   // 新图的图像质量，取值范围：1-100
                          //                        format: 'webp'  // 新图的输出格式，取值范围：jpg，gif，png，webp等
                      }, res.key);

                      var html_file = '<li class="weui-uploader__file weui-uploader__file_status" >\n' +
                          '                        <div class="weui-uploader__file-content"><img src="' + imgLink + '"></div>\n' +
                          '                        </li>';
                      var input_file = ' <input type="hidden" name="images[]" value="' + res.key + '">';
                      if ($('#uploaderFiles li').length > 5) {
                          $.toast('最多上传4张图片！');
                      } else {
                          $('#uploaderFiles').append(html_file);
                          $("#file_form").append(input_file);
                      }

                  },
                  'Error': function (up, err, errTip) {
                      //上传出错时，处理相关的事情
                  },
                  'UploadComplete': function () {
                      //队列文件处理完毕后，处理相关的事情

                  }
              }
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
