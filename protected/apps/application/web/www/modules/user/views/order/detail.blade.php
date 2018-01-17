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
                    <div class="weui-cell__bd"> {{ $item['goods_title'] }}-{{ $item['goods_price'] }}</div>
                </div>
            @endforeach
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">订单标题：</label></div>
                <div class="weui-cell__bd">{{ $orderData['info'] }}</div>
            </div>
        </div>
    </div>
    <div class="weui-cells weui-cells_form">
        <div class="weui-cell">
            <div class="weui-cell__bd">
                <div class="weui-uploader">
                    <div class="weui-uploader__hd">
                        <p class="weui-uploader__title">支付宝帐号：</p>
                        <div class="weui-uploader__info">
                            @if( count($images)>0 )
                                <input type="text" name="alipay" class="alipay" value="{{$orderData['alipay']}}">
                            @else
                                <input type="text" name="alipay" class="alipay" placeholder="请正确输入支付宝帐号">
                            @endif
                        </div>
                    </div>
                    <div class="weui-uploader__bd">
                        <div class="weui"> 自检结果图片：</div>
                        <ul class="weui-uploader__files" id="uploaderFiles">
                            @foreach( $images as $item)
                                <li class="weui-uploader__file weui-uploader__file_status">
                                    <div class="weui-uploader__file-content"><img src="{{ $item['image'] }}" width="80" height="80"></div>
                                </li>
                            @endforeach
                        </ul>
                        <div id="fileArr">
                            <form id="file_form" enctype="multipart/form-data">
                                @foreach( $images as $item)
                                    <input type="hidden" name="images[]" value="{{ $item['image'] }}">
                                @endforeach
                                <input type="hidden" name="token">
                            </form>
                            {{--<input class="weui-uploader__input uploader" id="uploader">--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if( gPayStatus($orderData['pay_status']) == '已支付' && (gOrderStatus($orderData['pay_status'])=='已发货' || gOrderStatus($orderData['pay_status'])=='已收货') )
        <a href="{{yUrl(['order/upresult','uuid'=>$orderData['uuid']])}}" class="weui-btn weui-btn_primary">上传自检结果</a>
    @endif
@stop

@push('foot-script')
    <script>
        $(function () {

        });
    </script>
@endpush