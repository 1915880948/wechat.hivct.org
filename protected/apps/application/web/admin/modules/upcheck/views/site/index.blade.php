@extends('layouts.main')@section('title','检测列表')<?php
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
    @include('global.breadcrumb',['title'=>'检测列表','subtitle'=>'检测列表','breads'=>[[
        'label' => '检测列表 ',
        'url'   => $selfurl,
    ]]])
@stop
@section('content')
    <div style="">
        <?php
        /** @var InlineForm $form */
        $form = InlineForm::begin(['action' => yUrl(['site/index']), 'method' => 'get']);
        echo $form->label("检测人", Html::textInput("name", ArrayHelper::getValue($_GET, 'name', '')));
        echo $form->label("电话", Html::textInput("phone", ArrayHelper::getValue($_GET, 'phone', '')));
        echo $form->label("Email", Html::textInput("email", ArrayHelper::getValue($_GET, 'email', '')));
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
                            $columns = [
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'id',
                                    'label' => '检测ID',
                                ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'name',
                                    'label' => '检测人'
                                ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'phone',
                                    'label' => '电话'
                                ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'email',
                                    'label' => 'Email'
                                ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'check_doctor',
                                    'label' => '检测医生',
                                ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute' => 'is_check',
                                    'label' => '是否检测',
                                    'value' =>function($model){
                                        return $model->is_check==1?'是':'否';
                                    }
                                ],
                                [
                                    /** @see yii\grid\ActionColumn */
                                    'header' => '功能管理',
                                    'headerOptions' => ['class' => 'center'],
                                    'contentOptions' => ['class' => 'col-sm-1 center'],
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{detail} {delete}',
                                    'buttons' => [
                                        'detail' => function ($url, $model) {
                                            return Html::a('详情', ['/upcheck/site/detail', 'id' => $model['id'], 'uid' => $model['uid']], ['class' => 'detail']);
                                        },
                                        'delete' => function ($url, $model) use ($selfurl) {
                                            return Html::a('删除', ['/upcheck/site/delete', 'id' => $model['id']], [
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

        #ship-content .form-group {
            text-align: center;
            padding: 20px;
        }
    </style>
@endpush
@push('foot-script')
    <script>
        $(function () {

        });
    </script>
@endpush
