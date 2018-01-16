@extends('layouts.main')@section('title','订单列表')
@push('head-style')
    <style type="text/css">
        #pjax-container{
            background: #F4F4F4;
            /*background: #fbfbfb;*/
        }
        .weui-form-preview {
            margin: 10px;
            background: #ffffff;
        }
    </style>
@endpush
@section('content')
@if($orderList)
    <div class="weui-panel weui-panel_access">
        <div class="weui-panel__bd">
            <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
                <div class="weui-media-box__bd">
                    <h4 class="weui-media-box__title">我的订单列表</h4>
                </div>
            </a>
        </div>
    </div>
    @foreach($orderList as $item)
        <div class="weui-form-preview">
            <div class="weui-form-preview__hd">
                <label class="weui-form-preview__label">付款金额</label>
                <em class="weui-form-preview__value">{{ (float)$item['total_price']/100 }}</em>
            </div>
            <div class="weui-form-preview__bd">
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">支付状态</label>
                    <span class="weui-form-preview__value">{{ gPayStatus($item['pay_status']) }}</span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">订单状态</label>
                    <span class="weui-form-preview__value">{{ gOrderStatus($item['order_status']) }}</span>
                </div>
                <div class="weui-form-preview__item">
                    <label class="weui-form-preview__label">订单时间</label>
                    <span class="weui-form-preview__value">{{ $item['created_at'] }}</span>
                </div>
            </div>
            <div class="weui-form-preview__ft">
                @if( gOrderStatus($item['pay_status']) == '已发货' )
                <button class="weui-form-preview__btn weui-form-preview__btn_primary confirm_receipt" id="{{$item['uuid']}}" >确认收货</button>
                @endif
                <a class="weui-form-preview__btn weui-form-preview__btn_default" href="{{yUrl(['order/detail','uuid'=>$item['uuid']])}}">查看详情</a>
            </div>
        </div>
    @endforeach
@else
    <div class="weui-loadmore weui-loadmore_line">
        <span class="weui-loadmore__tips">您暂时还没有订单～</span>
    </div>
@endif

@stop

@push('foot-script')
    <script>
        $(function () {
            $(".confirm_receipt").click(function () {
                var _this = $(this);
                $.confirm("确认收货？", function() {
                    $.post("{{yUrl(['order/index'])}}",{'uuid':_this.attr('id')},function (res) {
                        if(res.code == '200'){
                            $.toast('收货成功！');
                            location.reload();
                        }
                    });
                });
            })

        });
    </script>
@endpush