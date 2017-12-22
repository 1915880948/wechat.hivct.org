@extends('layouts.main')
@section('title','订单详情')

@section('content')
    <?php
    use yii\grid\GridView;use yii\helpers\Html;use yii\web\View;use yii\widgets\ActiveForm;
    /** @var $view View */
    ?>
    @include('global.breadcrumb',['title'=>'订单详情','subtitle'=>'订单详情','breads'=>[[
        'label' => '订单详情 ',
        'url'   => yRoute($selfurl),
    ]]])

    <div>
        <div class="col-xs-2">支付状态：{{ payStatus($order_data['pay_status']) }}</div>
        <div class="col-xs-2">订单状态：{{ orderStatus($order_data['order_status']) }}</div>
        <div class="col-xs-2">发货状态：{{ ($order_data['ship_status']==1?'已发货':'未发货') }}</div>
        <div class="col-xs-2">
            @if( $order_data['pay_status']== 1 && $order_data['order_status'] == 2 && $order_data['ship_status'] != 1 )
                <button type="button" class="btn green ship" data-id="{{$order_data['uuid']}}">发货</button>
            @endif

        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-body">
                            <?php
                            /**  */
                            echo GridView::widget([
                                'dataProvider' => $provider,
                                'columns' => [
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute' => 'id',
                                        'label' => 'ID',
                                    ],
                                    [
                                        /** @see yii\grid\ActionColumn */
                                        'header' => '商品名称',
                                        'headerOptions' => ['class' => 'center'],
                                        'contentOptions' => ['class' => 'col-sm-1 center'],
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{detail}',
                                        'buttons' => [
                                            'detail' => function ($url, $model) {
                                                return Html::a($model->goods_title, ['order/site', 'id' => $model['goods_uuid']], []);
                                            },
                                        ],
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute' => 'goods_price',
                                        'label' => '商品价格',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute' => 'order_time',
                                        'label' => '订单时间',

                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute' => 'created_at',
                                        'label' => '创建时间',

                                    ],
                                ],
                                'showHeader' => true,
                                'layout' => '<div class="table-responsive no-padding">{items}</div><div class="box-footer clearfix"><div class=" no-marginpull-right">{pager}</div></div>',
                                'tableOptions' => ['class' => 'table table-striped table-bordered table-hover no-margin-bottom no-border-top'],
                                'options' => ['class' => '']
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="ship-content" style="display:none">
        <div class="form-group">
            <label class="col-md-3 control-label">快递公司</label>
            <div class="col-md-9">
                <select class="form-control input-inline input-medium ship_name">
                    @foreach( $ship as $k=>$v)
                        <option value="{{ $k }}">{{$v}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label">快递单号</label>
            <div class="col-md-9">
                <input type="text" class="form-control input-inline input-medium ship_code" placeholder="快递单号">
            </div>
        </div>
    </div>

@endsection
@push('head-style')
    <style type="text/css">
        #ship-content .form-group {
            text-align: center;
            padding: 20px;
        }
    </style>
@endpush
@push('foot-script')
    <script>
        $(function () {
            var _this;
            $(".ship").click(function () {
                _this = $(this);
                var uuid = _this.data('id');
                layer.open({
                    type: 1,
                    title: '填写发货单',
                    shadeClose: true,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['420px', '240px'], //宽高
                    content: $('#ship-content'),
                    btn: ['发货', '取消'],
                    yes: function () {
                        if ($(".ship_name").val() && $(".ship_code").val()) {
                            $.post("{{yUrl('ship')}}",
                                {
                                    'uuid': uuid,
                                    'back_url': "{{$selfurl}}",
                                    'ship_id': $(".ship_name").val(),
                                    'ship_code': $(".ship_code").val()
                                }, function (res) {
                                    if (res.code == 200) {
                                        layer.msg('发货成功！！', {'icon': 1, time: 1200}, function () {
                                            layer.closeAll();
                                            location.reload();
                                        });
                                    }
                                }
                            );
                        } else {
                            $("#ship-content .form-group").addClass("has-error");
                        }
                    }
                });
            });

        });

    </script>
@endpush