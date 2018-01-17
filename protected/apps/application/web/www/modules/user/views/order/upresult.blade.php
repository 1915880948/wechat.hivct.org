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
              {{--<form id="file_form" enctype="multipart/form-data">--}}
              {{--<input type="hidden" name="token">--}}
              {{--</form>--}}
              <span class="weui-uploader__input uploader" id="uploader"></span>
            </div>
          </div>
        </div>
      </div>
      <div class="weui-cell__bd">
        <span id="up">上传</span>
      </div>
    </div>
  </div>
  {{--    @if( gPayStatus($orderData['pay_status']) == '已支付' && (gOrderStatus($orderData['pay_status'])=='已发货' || gOrderStatus($orderData['pay_status'])=='已收货') )--}}
  <a href="javascript:;" class="weui-btn weui-btn_primary apply_back">保存</a>
  {{--@endif--}}
@stop

@push('foot-script')

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
      });

      wx.ready(function () {
          var images = {
              localId: [],
              serverId: []
          };
          $(document).on('#uploader', 'click', function () {
              wx.chooseImage({
                  // count: 1,
                  success: function (res) {
                      images.localId = res.localIds;
                      var insert = '<li class="weui-uploader__file" style="background-image:url(' + images.localId[0] + ')"></li>';
                      $('#uploaderFiles').append(insert);
                      // $(".weui_uploader_file").show().css('background-image', 'url(' + images.localId[0] + ')');
                  }
              });
          })
          $(document).on('#up', 'click', function () {
              if (images.localId.length == 0) {
                  alert('请先选择图片');
                  return;
              }
              $.showLoading("请稍等...");
              var i = 0, length = images.localId.length;
              images.serverId = [];

              function upload() {
                  wx.uploadImage({
                      localId: images.localId[i],
                      success: function (res) {
                          i++;
                          //alert('已上传：' + i + '/' + length);
                          console.log(res);
                          images.serverId.push(res.serverId);
                          var url = "<?php echo base_url('vote/home/fetch_url_to_qiniu'); ?>";
                          $.get(url, {'media_id': res.serverId, 'memo': $('.weui_textarea').val()}, function (response) {
                              $.hideLoading();
                              var data = $.parseJSON(response);
                              if (data.ret == 0) {
                                  $.toast(data.msg);
                                  window.location.href = "<?php echo base_url('vote/home/vote_list'); ?>";
                              } else {
                                  $.toast("操作失败", "forbidden");
                                  $.noti({
                                      text: data.msg,
                                      time: 3000
                                  });
                                  return;
                              }
                          });
                          if (i < length) {
                              upload();
                          }
                      },
                      fail: function (res) {
                          alert(JSON.stringify(res));
                      }
                  });
              }

              setTimeout(function () {
                  upload();
              }, 1000);

          });
          wx.error(function (res) {
              console.log(res.errMsg);
          });
      });


      function order_list() {
          $.post("{{ yUrl(['/user/order/payback']) }}", {'method': 'list'}, function (res) {
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
