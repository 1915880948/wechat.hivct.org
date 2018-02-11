@extends('layouts.main')@section('title','订单列表')<?php
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
    @include('global.breadcrumb',['title'=>'订单列表','subtitle'=>'订单审核','breads'=>[[
        'label' => '订单审核 ',
        'url'   => $selfurl,
    ]]])
@stop
@section('content')

    <div style="">
        <div class="btn-group">
            {{--<a href="#" class="btn bg-yellow btn-default">全部</a>--}}
            @foreach( $applyArr as $k=>$v)
                <a href="{{yUrl(['','is_to_examine'=> $k])}}" title="{{ $v }}-{{$k}}"
                   class="btn btn-default {{ $k== yRequest()->get('is_to_examine')?'bg-yellow':'' }} ">{{ $v }}</a>
            @endforeach
        </div>
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
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'ship_status',
                                    'label' => '配送状态',
                                    'value' => function ($model) {
                                        return $model->ship_status == 1 ? "已发货" : '未发货';
                                    }
                                ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'is_to_examine',
                                    'label' => '审核状态',
                                    'value' => function ($model) {
                                        if($model->is_to_examine == 0)  return '未审核';
                                        if($model->is_to_examine) return '通过';
                                        if($model->is_to_examine) return '未通过';
                                    }
                                ],
                                [
                                    /** @see yii\grid\ActionColumn */
                                    'header' => '功能管理',
                                    'headerOptions' => ['class' => 'center'],
                                    'contentOptions' => ['class' => 'col-sm-2 center'],
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{apply} {delete}',
                                    'buttons' => [
                                        'apply' => function ($url, $model) {
                                            return Html::a('审核', ['/order/site/detail', 'uuid' => $model['uuid'], 'uid' => $model['uid']], ['class' => 'detail', 'target' => '_blank']);
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

        });
    </script>
@endpush
