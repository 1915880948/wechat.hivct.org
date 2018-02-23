@extends('layouts.main')@section('title','订单审核')<?php
use common\assets\ace\InlineForm;use yii\grid\GridView;use yii\helpers\ArrayHelper;use yii\helpers\Html;use yii\web\View;
/** @var $view View */
?>
@push('head-style')
    <style type="text/css">
        .delete {
            color: red;
        }
    </style>
@endpush
@section('breadcrumb')
    @include('global.breadcrumb',['title'=>'订单审核','subtitle'=>'订单审核','breads'=>[[
        'label' => '订单审核 ',
        'url'   => $selfurl,
    ]]])
@stop
@section('content')
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
                        @endforelse
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
                                    <textarea class="form-control examine_reason" id="examine_reason" cols="9" rel="3" placeholder="未通过原因">{{$orderData['examine_reason']}}</textarea>
                                </div>
                                <label class="col-md-3 control-label">
                                    <input type="button" class="input-group-btn btn btn-default btn-sm input-small examine_save" value="保存" style="background: #3fd5c0;color: #ffffff;">
                                </label>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('head-style')
    <style type="text/css">
        .btn.btn-sm {
            background: #3fd5c0;
            color: #fff;
        }
    </style>
@endpush
@push('foot-script')
    <script>
        $(function () {
            $("#save_up_images").click(function () {
                var images = '';
                $('.input_images img').each(function () {
                    images += $(this).attr('src') + ',';
                });
                if( images ){
                    $.post("{{yUrl(['site/payimages'])}}",{
                        'user_id':"{{$orderData['uid']}}",
                        'uuid':"{{$orderData['uuid']}}",
                        'images':images
                    },function (res) {
                        if(res.code == 200){
                            layer.msg('保存成功！！', {'icon': 1, time: 1200}, function () {
                                location.reload();
                            });
                        }
                    });
                }
            });
            examine_reason();
            $('#apply_result').change(function(){
                examine_reason();
            });
            $('.examine_save').click(function(){
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
        });
        function examine_reason() {
            if( $("#apply_result").val() == 2 ){
                document.getElementById("examine_reason").style.display="block";
            }else{
                document.getElementById("examine_reason").style.display="none";
            }
        }
    </script>
@endpush
