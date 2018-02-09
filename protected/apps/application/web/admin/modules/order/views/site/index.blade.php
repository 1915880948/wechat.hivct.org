@extends('layouts.main')@section('title','订单列表')<?php
use common\assets\ace\InlineForm;use yii\grid\GridView;use yii\helpers\ArrayHelper;use yii\helpers\Html;use yii\web\View;
/** @var $view View */
?>
@push('head-style')
    <style type="text/css">
        .ship {
            color: #545504;
        }

        .deal {
            color: blue;
        }

        .delete {
            color: red;
        }

        #export {
            color: #3fd5c0;
        }
        .select2-dropdown {
            z-index: 20000000000; }
    </style>
@endpush
@section('breadcrumb')
    @include('global.breadcrumb',['title'=>'订单列表','subtitle'=>'订单列表','breads'=>[[
        'label' => '订单列表 ',
        'url'   => $selfurl,
    ]]])
@stop
@section('content')

    <div style="">
        <div class="btn-group">
            {{--<a href="#" class="btn bg-yellow btn-default">全部</a>--}}
            @foreach( $payArr as $k=>$v)
                <a href="{{yUrl(['','pay_status' => $k,])}}" title="{{ $v }}-{{$k}}"
                   class="btn btn-default {{ $k==$conditions['pay_status']?'bg-yellow':'' }} ">{{ $v }}</a>
            @endforeach
        </div>
    </div>
    <div style="">
        <div class="btn-group">
            {{--<a href="#" class="btn bg-yellow btn-default">全部</a>--}}
            @if( $userinfo['is_admin']== 1)
            @foreach( $logArr as $k=>$v)
                <a href="{{yUrl(['',
                'logistics_id'      => $k,
                'ship_uuid'         => \yii\helpers\ArrayHelper::getValue($_GET, 'ship_uuid', '-99'),
                'pay_status'        => \yii\helpers\ArrayHelper::getValue($_GET, 'pay_status', '-99'),
                'order_status'      => \yii\helpers\ArrayHelper::getValue($_GET, 'order_status', '-99'),
                'wx_transaction_id' => \yii\helpers\ArrayHelper::getValue($_GET, 'wx_transaction_id', ''),
                'ship_code'         => \yii\helpers\ArrayHelper::getValue($_GET, 'ship_code', '')
                ])}}" title="{{ $v }}"
                   class="btn btn-default {{ $k==\yii\helpers\ArrayHelper::getValue($_GET, 'logistics_id', '-99')?'bg-yellow':'' }} ">{{ explode('-',$v)[0] }}</a>
            @endforeach
                @endif
        </div>
        <?php
        /** @var InlineForm $form */
        $form = InlineForm::begin(['action' => yUrl(['site/index']), 'method' => 'get']);
        echo $form->label("", Html::input('hidden', "pay_status", ArrayHelper::getValue($_GET, 'pay_status', '-99')));
        echo $form->label("", Html::input('hidden', "logistics_id", ArrayHelper::getValue($_GET, 'logistics_id', '-99')));
        echo $form->label("快递公司", Html::dropDownList("ship_uuid", ArrayHelper::getValue($_GET, 'ship_uuid', ''), $expressArr));
        echo $form->label("订单状态", Html::dropDownList("order_status", ArrayHelper::getValue($_GET, 'order_status', ''), [
            '-99' => '全部',
            '0' => '未处理',
            '1' => '处理中',
            '2' => '已支付',
            '21' => '已发货',
            '22' => '已收货',
            '23' => '用户不存在',
            '29' => '发货完成',
            '11' => '申请退款',
            '12' => '退款审核',
            '13' => '退款成功',
            '14' => '退款失败',
            '18' => '退款处理中',
            '19' => '退款完成',
            '99' => '订单完成',
            '100' => '未知状态'
        ]));
        echo "<br />";
        echo $form->label("艾滋病检测结果", Html::dropDownList("adis_result", ArrayHelper::getValue($_GET, 'adis_result', ''), [
            '-99' => '全部',
            '1' => '阴性',
            '2' => '阳性'
        ]));
        echo $form->label("梅毒检测结果", Html::dropDownList("syphilis_result", ArrayHelper::getValue($_GET, 'syphilis_result', ''), [
            '-99' => '全部',
            '1' => '阴性',
            '2' => '阳性'
        ]));
        echo $form->label("乙肝检测结果", Html::dropDownList("hepatitis_b_result", ArrayHelper::getValue($_GET, 'hepatitis_b_result', ''), [
            '-99' => '全部',
            '1' => '阴性',
            '2' => '阳性'
        ]));
        echo $form->label("丙肝检测结果", Html::dropDownList("hepatitis_c_result", ArrayHelper::getValue($_GET, 'hepatitis_c_result', ''), [
            '-99' => '全部',
            '1' => '阴性',
            '2' => '阳性'
        ]));
        echo "<br />";
        echo $form->label("微信订单号", Html::textInput("wx_transaction_id", ArrayHelper::getValue($_GET, 'wx_transaction_id', '')));
        echo $form->label("快递单号", Html::textInput("ship_code", ArrayHelper::getValue($_GET, 'ship_code', '')));
        echo $form->label("收货人", Html::textInput("address_contact", ArrayHelper::getValue($_GET, 'address_contact', '')));
        echo $form->label("收货人电话", Html::textInput("address_mobile", ArrayHelper::getValue($_GET, 'address_mobile', '')));
        echo $form->submitInput();
        echo $form->buttonInput('导出', ['class' => 'input-group-btn btn btn-default btn-sm input-small export']);
        $form->end();
        ?>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-body">
                            <?php
                            $columns = [
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'id',
                                    'label' => '订单ID',
                                ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'address_contact',
                                    'label' => '收货人'
                                ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'address_mobile',
                                    'label' => '电话'
                                ],
                                // [
                                //     'contentOptions' => ['class' => 'col-sm-1'],
                                //     'attribute' => 'address_detail',
                                //     'label' => '详细地址'
                                // ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'total_price',
                                    'label' => '总价',
                                    'value' => function ($model) {
                                        return $model->total_price / 100;
                                    }
                                ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'wx_transaction_id',
                                    'label' => '微信订单号',
                                ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'pay_status',
                                    'label' => '支付状态',
                                    'value' => function ($model) {
                                        return gPayStatus($model->pay_status);
                                    }
                                ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'order_status',
                                    'label' => '订单状态',
                                    'value' => function ($model) {
                                        return gOrderStatus($model->order_status);
                                    }
                                ],
                                //                                    [
                                //                                        'contentOptions' => ['class' => 'col-sm-2'],
                                //                                        'attribute' => 'ship_name',
                                //                                        'label' => '快递公司',
                                //                                    ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'ship_code',
                                    'label' => '快递单号',
                                ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'ship_status',
                                    'label' => '配送状态',
                                    'value' => function ($model) {
                                        return $model->ship_status == 1 ? "已发货" : '未发货';
                                    }
                                ],
                                [
                                    /** @see yii\grid\ActionColumn */
                                    'header' => '功能管理',
                                    'headerOptions' => ['class' => 'center'],
                                    'contentOptions' => ['class' => 'col-sm-1 center'],
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{ship} {deal} {memo} {detail} {export} {delete}',
                                    'buttons' => [
                                        'ship' => function ($url, $model) {
                                            if ($model->pay_status == 1 && $model->order_status == 2) {
                                                return Html::a('发货', 'javascript:;', ['data-id' => $model['uuid'], 'class' => 'ship'], []);
                                            }
                                        },
                                        'deal' => function ($url, $model) use ($dealArr,$userinfo) {
                                            if (in_array($model->order_status, $dealArr) && $userinfo['is_admin']==1 ) {
                                                return Html::a('处理', ['/order/site/deal', 'uuid' => $model['uuid'], 'uid' => $model['uid']], ['class' => 'deal','target'=>'_blank']);
                                            }
                                        },
                                        'memo' => function($url,$model){
                                            return Html::a('备注', 'javascript:;', ['data-id' => $model['uuid'], 'class' => 'memo'], []);
                                        },
                                        'detail' => function ($url, $model) {
                                            return Html::a('详情', ['/order/site/detail', 'uuid' => $model['uuid'], 'uid' => $model['uid']], ['class' => 'detail','target'=>'_blank']);
                                        },
                                        'export' => function ($url, $model) {
                                            return Html::a('导出', ['/order/site/export', 'uuid' => $model['uuid']], [
                                                'id' => 'export',
                                                'data' => [
                                                    'method' => 'post',
                                                    'params' => [
                                                        'uuid' => $model['uuid']
                                                    ]
                                                ]
                                            ]);
                                        },
                                        'delete' => function ($url, $model) use ($selfurl) {
                                            return Html::a('删除', ['/order/site/delete', 'id' => $model['id']], [
                                                'class' => 'delete',
                                                'data' => [
                                                    'method' => 'post',
                                                    'confirm' => '您确认要删除吗？',
                                                    'params' => [
                                                        'id' => $model['id']
                                                    ]
                                                ]
                                            ]);
                                        },

                                    ],
                                ],
                                /** @var yii\grid\ActionColumn */
                            ];
                            echo GridView::widget([
                                'dataProvider' => $provider,
                                'columns' => $columns,
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
                <select class="form-control js-express-tags input-medium ship_name" id="ship_name">
                    @foreach( $ship as $k=>$v)
                        <option value="{{ $k }}" {{ $v=='自取'?"data-values=".$v:'' }}>{{$v}}</option>
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
    <div id="memo-content" style="display:none">
        <div class="form-group">
            <label class="col-md-2 control-label">备注</label>
            <div class="col-md-10">
                <textarea class="form-control "  id="memo"></textarea>
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

        #ship-content .form-group {
            text-align: center;
            padding: 20px;
        }
    </style>
@endpush
@push('foot-script')
    <script>
        $(function () {
            $(".js-express-tags").select2({
                tags: true
            });

            var _this;
            $(".ship").click(function (i) {
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
                        var select_index = document.getElementById("ship_name").selectedIndex;
                        var object = $(".ship_name option")[select_index];
                        if ( ($(".ship_name").val() && $(".ship_code").val()) || object.text=='自取'  ) {
                            $.post("{{yUrl(['site/ship'])}}",
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

            $(".export").click(function () {
                var url = location.href.split("?");
                if (url[1]) {
                    location.href = "{{yUrl(['site/export'])}}" + "?" + url[1];
                } else {
                    location.href = "{{yUrl(['site/export'])}}";
                }
            });

            $(".memo").click(function (i) {
                _this = $(this);
                var uuid = _this.data('id');
                layer.open({
                    type: 1,
                    title: '填写备注信息',
                    shadeClose: true,
                    skin: 'layui-layer-rim', //加上边框
                    area: ['420px', '200px'], //宽高
                    content: $('#memo-content'),
                    btn: ['确定', '取消'],
                    yes: function () {
                        if ( $("#memo").val()  ) {
                            $.post("{{yUrl(['site/memo'])}}",
                                {
                                    'uuid': uuid,
                                    'memo': $("#memo").val(),
                                }, function (res) {
                                    if (res.code == 200) {
                                        layer.msg('备注成功！！', {'icon': 1, time: 1200}, function () {
                                            layer.closeAll();
                                            location.reload();
                                        });
                                    }
                                }
                            );
                        } else {
                            $("#memo-content .form-group").addClass("has-error");
                        }
                    }
                });
            });

        });
    </script>
@endpush
