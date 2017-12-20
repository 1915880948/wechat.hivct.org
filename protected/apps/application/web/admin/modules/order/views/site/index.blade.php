@extends('layouts.main')
@section('title','订单列表')
@section('content')
    <?php
    use yii\grid\GridView;use yii\helpers\Html;use yii\web\View;use yii\widgets\ActiveForm;
    /** @var $view View */
    ?>
    @include('global.breadcrumb',['title'=>'订单列表','subtitle'=>'订单列表','breads'=>[[
        'label' => '订单列表 ',
        'url'   => $selfurl,
    ]]])
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
                                'columns'      => [
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'id',
                                        'label'          => '订单ID',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'out_trade_no',
                                        'label'          => '内部流水号',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'info',
                                        'label'          => '订单标题'
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'description',
                                        'label'          => '订单说明',

                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'memo',
                                        'label'          => '订单备注',

                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'total_price',
                                        'label'          => '总价',

                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'wx_transaction_id',
                                        'label'          => '微信订单号',

                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'pay_status',
                                        'label'          => '支付状态',
                                        'value'          =>function($model){
                                           return $model->pay_status==0?'待支付':($model->pay_status==1?'已支付':'支付失败');
                                        }
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'order_status',
                                        'label'          => '订单状态',
                                        'value'          =>function($model){
                                            switch ( $model->order_status){
                                                case 0 : return '未处理'  ;break;
                                                case 1 : return '处理中'  ;break;
                                                case 2 : return '已支付'  ;break;
                                                case 3 : return '已发货'  ;break;
                                                case 4 : return '已收货'  ;break;
                                                case 11: return '申请退款';break;
                                                case 12: return '退款中'  ;break;
                                                case 13: return '退款完成';break;
                                                default: return '已完成'  ;
                                            }
                                        }
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-2'],
                                        'attribute'      => 'created_at',
                                        'label'          => '订单时间',
                                    ],

                                    [
                                        /** @see yii\grid\ActionColumn */
                                        'header'         => '功能管理',
                                        'headerOptions'  => ['class' => 'center'],
                                        'contentOptions' => ['class' => 'col-sm-1 center'],
                                        'class'          => 'yii\grid\ActionColumn',
                                        'template'       => '{detail} {delete} ',
                                        'buttons'        => [
                                            'detail'   => function($url, $model) use ($selfurl) {
                                                return Html::a('详情', ['/order/site/detail', 'uuid' => $model['uuid']], []);
                                            },
                                            'delete' => function($url, $model) use ($selfurl) {
                                                return Html::a('删除', ['/order/site/delete', 'id' => $model['id']], [
                                                    'data' => [
                                                        'method'  => 'post',
                                                        'confirm' => '您确认要删除吗？',
                                                        'params'  => [
                                                            'id' => $model['id']
                                                        ]
                                                    ]
                                                ]);
                                            },

                                        ],
                                    ],
                                    /** @var yii\grid\ActionColumn */
                                ],
                                'showHeader'   => true,
                                'layout'       => '<div class="table-responsive no-padding">{items}</div><div class="box-footer clearfix"><div class=" no-marginpull-right">{pager}</div></div>',
                                'tableOptions' => ['class' => 'table table-striped table-bordered table-hover no-margin-bottom no-border-top'],
                                'options'      => ['class' => '']
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@push('foot-script')
<script>
    $(function(){

    });
</script>
@endpush