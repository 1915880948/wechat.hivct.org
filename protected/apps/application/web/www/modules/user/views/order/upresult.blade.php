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
    <div class="weui-cell">
      <div class="weui-cell__hd">
        <label for="name" class="weui-label">选择订单</label>
      </div>
      <div class="weui-cell__bd">
        <input class="weui-input" id="order" type="text" value="" data-values="" onfocus="this.blur()">
      </div>
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
              <input class="weui-uploader__input uploader" id="uploader" type="file" accept="image/*">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{--    @if( gPayStatus($orderData['pay_status']) == '已支付' && (gOrderStatus($orderData['pay_status'])=='已发货' || gOrderStatus($orderData['pay_status'])=='已收货') )--}}
  <a href="javascript:;" class="weui-btn weui-btn_primary apply_back">保存</a>
  {{--@endif--}}
@stop

@push('foot-script')
  <script src="{{yStatic('qiniu/plupload.min.js')}}"></script>
  <script src="{{yStatic('qiniu/qiniu.min.js') }}"></script>
  <script src="{{yStatic('qiniu/progress.js')}}"></script>
  <script>
      $(function () {
          order_list();
          $(".apply_back").click(function () {
              var images = '';
              $('input[name="images[]"]').each(function () {
                  images += $(this).val() + ',';
              });
              if (!$("#order").attr('data-values') || !images) {
                  $.toast('请完整填写表单！', 'forbidden');
                  return false;
              }
              var data = {
                  'order_uuid': $("#order").attr('data-values'),
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
          //构建uploader实例

      });
      var uploader = Qiniu.uploader({
          runtimes: 'html5,flash,html4',      // 上传模式，依次退化
          browse_button: 'uploader',          // 上传选择的点选按钮，必需
          uptoken_url: "{{yUrl(['/site/uptoken'])}}",         // Ajax请求uptoken的Url，强烈建议设置（服务端提供）
          // unique_names: true, // 默认 false，key为文件名。若开启该选项，SDK为自动生成上传成功后的key（文件名）。
          // save_key: true,   // 默认 false。若在服务端生成uptoken的上传策略中指定了 `sava_key`，则开启，SDK会忽略对key的处理
          get_new_uptoken: true,              // 设置上传文件的时候是否每次都重新获取新的uptoken
          domain: "{{env('QINIU_DOMAIN')}}",     // bucket域名，下载资源时用到，必需
          max_file_size: '100mb',             // 最大文件体积限制
          max_retries: 3,                     // 上传失败最大重试次数
          dragdrop: false,                    // 开启可拖曳上传
          chunk_size: '1mb',                  // 分块上传时，每块的体积
          auto_start: true,                   // 选择文件后自动上传，若关闭需要自己绑定事件触发上传
          multi_selection: false,
          filters: {
              mime_types: [ //只允许上传文件格式
                  {title: "image files", extensions: "jpg,png,jpeg"}
              ]
          },
          resize: {
              width: 800,
              height: 800,
              crop: true,
              preserve_headers: false
          },
          init: {
              'FilesAdded': function (up, files) {
                  // plupload.each(files, function (file) {
                  //     // 文件添加进队列后，处理相关的事情
                  // });
              },
              'BeforeUpload': function (up, file) {
                  // 每个文件上传前，处理相关的事情
              },
              'UploadProgress': function (up, file) {
                  // 每个文件上传时，处理相关的事情
              },
              'FileUploaded': function (up, file, info) {
                  alert(info);
//                   layer.msg('上传成功', {time: 1200}, function () {
//                   });
//                   var res = JSON.parse(info);
//                   // 查看简单反馈
//                   var domain = up.getOption('domain');
//                   var sourceLink = domain + "/" + res.key; //获取上传成功后的文件的Url
//                   var imgLink = Qiniu.imageView2({
//                       mode: 0,  // 缩略模式，共6种[0-5]
//                       w: 150,   // 具体含义由缩略模式决定
//                       h: 150   // 具体含义由缩略模式决定
// //                        q: 60,   // 新图的图像质量，取值范围：1-100
// //                        format: 'webp'  // 新图的输出格式，取值范围：jpg，gif，png，webp等
//                   }, res.key);
//
//                   var html_file = '<li class="weui-uploader__file weui-uploader__file_status" >\n' +
//                       '                        <div class="weui-uploader__file-content"><img src="' + imgLink + '"></div>\n' +
//                       '                        </li>';
//                   var input_file = ' <input type="hidden" name="images[]" value="' + sourceLink + '">';
//                   if ($('#uploaderFiles li').length > 5) {
//                       $.toast('最多上传4张图片！')
//                   } else {
//                       $('#uploaderFiles').append(html_file);
//                       $("#file_form").append(input_file);
//                   }

              },
              'Error': function (up, err, errTip) {
                  //上传出错时，处理相关的事情
              },
              'UploadComplete': function () {
                  //队列文件处理完毕后，处理相关的事情

              },
              'Key': function (up, file) {
                  return file.name;
                  // // 若想在前端对每个文件的key进行个性化处理，可以配置该函数
                  // // 该配置必须要在unique_names: false，save_key: false时才生效
                  // var key = file.name;
                  // // do something with key here
                  // return key;
              }
          }
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
