<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use common\assets\ace\InlineForm;
use yii\helpers\ArrayHelper;
/** @var $view View */
?>
@extends('layouts.main')
@section('title','用户列表')

@section('breadcrumb')
    @include('global.breadcrumb',['title'=>'用户列表','subtitle'=>'用户列表','breads'=>[[
        'label' => '用户列表 ',
        'url'   => $selfurl,
    ]]])

@stop
@section('content')
    <div style="float: right;">
        <?php
        /** @var InlineForm $form */
        $form = InlineForm::begin(['action' => yUrl(['lists/index'])]);
        echo $form->label("真实姓名", Html::textInput("realname", ArrayHelper::getValue($_GET, 'realname', '')));
        echo $form->submitInput();
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
                            /**  */
                            echo GridView::widget([
                                'dataProvider' => $provider,
                                'columns'      => [
//                                    [
//                                        'contentOptions' => ['class' => 'col-sm-1'],
//                                        'attribute'      => 'uid',
//                                        'label'          => 'ID',
//                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'nickname',
                                        'label'          => '微信昵称',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'realname',
                                        'label'          => '真实姓名',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'gender',
                                        'label'          => '性别',
                                        'value'          => function($model, $key, $index, $column) {
                                            return $model->gender==2? '女':'男';
                                        }
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'nation',
                                        'label'          => '民族',

                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'province',
                                        'label'          => '省份',

                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'city',
                                        'label'          => '城市',

                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'age',
                                        'label'          => '年龄',

                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'telephone',
                                        'label'          => '手机',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'email',
                                        'label'          => '邮箱',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-2'],
                                        'attribute'      => 'updated_at',
                                        'label'          => '更新时间',
                                    ],

                                    [
                                        /** @see yii\grid\ActionColumn */
                                        'header'         => '功能管理',
                                        'headerOptions'  => ['class' => 'center'],
                                        'contentOptions' => ['class' => 'col-sm-1 center'],
                                        'class'          => 'yii\grid\ActionColumn',
                                        'template'       => '{address} {delete} ',
                                        'buttons'        => [
                                            'address'   => function($url, $model) use ($selfurl) {
                                                return Html::a('地址', ['/user/lists/address', 'uid' => $model['uid']], []);
                                            },
                                            'delete' => function($url, $model) use ($selfurl) {
                                                return Html::a('删除', ['/user/lists/delete', 'id' => $model['uid']], [
                                                    'data' => [
                                                        'method'  => 'post',
                                                        'confirm' => '您确认要删除吗？',
                                                        'params'  => [
                                                            'id' => $model['uid']
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
@push('head-style')
<style type="text/css">
    .btn.btn-sm{
        background: #3fd5c0;
        color: #fff;
    }
</style>
@endpush