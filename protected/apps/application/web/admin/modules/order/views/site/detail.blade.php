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
                                        'label'          => 'ID',
                                    ],
                                    [
                                        /** @see yii\grid\ActionColumn */
                                        'header'         => '商品名称',
                                        'headerOptions'  => ['class' => 'center'],
                                        'contentOptions' => ['class' => 'col-sm-1 center'],
                                        'class'          => 'yii\grid\ActionColumn',
                                        'template'       => '{detail}',
                                        'buttons'        => [
                                            'detail'     =>function($url,$model){
                                                return Html::a( $model->goods_title , ['order/site', 'id' =>$model['goods_uuid'] ], []);
                                            },
                                        ],
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'goods_price',
                                        'label'          => '商品价格',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'order_time',
                                        'label'          => '订单时间',

                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'created_at',
                                        'label'          => '创建时间',

                                    ],
//                                    [
//                                        /** @see yii\grid\ActionColumn */
//                                        'header'         => '功能管理',
//                                        'headerOptions'  => ['class' => 'center'],
//                                        'contentOptions' => ['class' => 'col-sm-1 center'],
//                                        'class'          => 'yii\grid\ActionColumn',
//                                        'template'       => '{detail} {delete} ',
//                                        'buttons'        => [
//                                            'detail'   => function($url, $model) use ($selfurl) {
//                                                return Html::a('详情', [$selfurl, 'id' => $model['id']], []);
//                                            },
//                                            'delete' => function($url, $model) use ($selfurl) {
//                                                return Html::a('删除', ['/order/site/delete', 'id' => $model['id']], [
//                                                    'data' => [
//                                                        'method'  => 'post',
//                                                        'confirm' => '您确认要删除吗？',
//                                                        'params'  => [
//                                                            'id' => $model['id']
//                                                        ]
//                                                    ]
//                                                ]);
//                                            },
//                                        ],
//                                    ],
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