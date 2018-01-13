@extends('layouts.main')@section('title','订单详情')
@push('head-style')
    <style type="text/css">
        h4 {
            text-align: center;
            margin: 10px 0;
        }
    </style>
@endpush
@section('content')

    <div class="weui-cells">
        <div class="weui-media-box__bd">
            <h4 class="weui-media-box__title">订单信息</h4>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">订单标题：</label></div>
                <div class="weui-cell__bd">{{ $orderData['info'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">订单说明：</label></div>
                <div class="weui-cell__bd">{{ $orderData['description'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">付款金额：</label></div>
                <div class="weui-cell__bd" style="color: red;">{{ ($orderData['total_price']/100) }}</div>
            </div>
            @foreach( $detailData as $item)
                <div class="weui-cell">
                    <div class="weui-cell__hd"><label class="weui-label">商品名称：</label></div>
                    <div class="weui-cell__bd">{{ $item['goods_title'] }}-{{ $item['goods_price'] }}</div>
                </div>
                {{--<div class="weui-cell">--}}
                    {{--<div class="weui-cell__hd"><label class="weui-label">商品价格：</label></div>--}}
                    {{--<div class="weui-cell__bd">{{ $item['goods_price'] }}</div>--}}
                {{--</div>--}}
            @endforeach
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">订单标题：</label></div>
                <div class="weui-cell__bd">{{ $orderData['info'] }}</div>
            </div>
        </div>
    </div>
{{--    @if( gPayStatus($orderData['pay_status']) == '已支付' && (gOrderStatus($orderData['pay_status'])=='已发货' || gOrderStatus($orderData['pay_status'])=='已收货') )--}}
    @if( 1 )
        <div class="weui-cells weui-cells_form">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <div class="weui-uploader">
                        <div class="weui-uploader__hd">
                            <p class="weui-uploader__title">支付宝帐号：</p>
                            <div class="weui-uploader__info"><input type="text" name="alipay" class="alipay" placeholder="请正确输入支付宝帐号"> </div>
                        </div>
                        <div class="weui-uploader__bd">
                            <div class="weui">上传图片：</div>
                            <ul class="weui-uploader__files" id="uploaderFiles">
                                <li class="weui-uploader__file weui-uploader__file_status" style="background-image:url(./images/pic_160.png)">
                                    <div class="weui-uploader__file-content"> <i class="weui-icon-warn"></i> </div>
                                </li>
                                <li class="weui-uploader__file weui-uploader__file_status" style="background-image:url(./images/pic_160.png)">
                                    <div class="weui-uploader__file-content">50%</div>
                                </li>
                            </ul>

                            <div class="weui-uploader__input-box" id="fileArr">
                                <input type="hidden" name="images[]" value="123" >
                                <input type="hidden" name="images[]" value="456" >
                                <input type="hidden" name="images[]" value="789" >
                                <input class="weui-uploader__input uploader" id="uploader">
                            </div>
                            {{--<div class="weui-uploader__input-box">--}}
                                {{--<input type="file" accept="image/png,image/jpeg,image/jpg" multiple="">--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="javascript:;" class="weui-btn weui-btn_primary apply_back">申请退回定金</a>
    @endif
@stop

@push('foot-script')
{{--    <script src="{{ yStatic('qiniu/qiniu.min.js') }}"></script>--}}
    <script src="{{ yStatic('qiniu/qiniu4js.min.js') }}"></script>
    <script>
        $(function () {

            $(".apply_back").click(function () {
                var images = '';
                $('input[name="images[]"]').each(function(){
                    images += $(this).val()+',';
                });

                if( !$('.alipay').val() || !images ) {
                    $.toast('请完整填写表单！','forbidden');
                    return false;
                }
                var data = {
                    'order_uuid': "{{$orderData['uuid']}}",
                    'alipay' : $('.alipay').val(),
                    'images' : images
                }
                $.post("{{ yUrl(['images/index']) }}",data,function (res) {
                    if(res.code == '200' ){
                        $.toast('操作成功！');
                        location.href = "{{yUrl(['order/index'])}}";
                    }
                })
            });

            //构建uploader实例
            var qiniu = new Qiniu.UploaderBuilder()
                .debug(false)
                .tokenShare(true)
                .chunk(true)
                .multiple(false)
                //            .accept(['image/*'])
                .tokenUrl('/site/uptoken')
                .listener({
                    onTaskSuccess: function (task) {
                        layer.msg('上传成功', {time: 1200});
                        $('input[name="picture"]').val('http://img-cdn.suixiangpin.com/' + task.result.key);
                        $('#upload').attr('src', 'http://img-cdn.suixiangpin.com/' + task.result.key);
                    }, onTaskFail: function (task) {
                        layer.msg('上传失败', {time: 1200});
                    }
                }).build();

            $('#uploader').click(function () {
                qiniu.chooseFile();
            });

        });
    </script>
@endpush