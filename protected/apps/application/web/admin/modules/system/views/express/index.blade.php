<?php
use yii\grid\GridView;use yii\helpers\Html;use yii\web\View;use yii\widgets\ActiveForm;

/** @var $view View */

?>@extends('layouts.main')@section('title','快递公司管理')

@section('breadcrumb')
    @include('global.breadcrumb',['title'=>'快递公司管理','subtitle'=>'快递公司管理','breads'=>[[
        'label' => '快递公司列表 ',
        'url'   => $selfurl,
    ]]])
@stop
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-8">
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red sbold uppercase">快递公司</span>
                            </div>
                            <div class="actions">
                                <div class="input-group input-group-sm" style="width: 30px;">
                                    <a href="{{yUrl([$selfurl])}}" class="btn grey-mint">新增</a>
                                </div>
                            </div>
                        </div>
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
                                        'contentOptions' => ['class' => 'col-sm-2'],
                                        'attribute'      => 'name',
                                        'label'          => '快递公司',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-2'],
                                        'attribute'      => 'phone',
                                        'label'          => '联系电话',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-2'],
                                        'attribute'      => 'address',
                                        'label'          => '公司地址',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'status',
                                        'label'          => '状态',
                                        'format'         => 'raw',
                                        'value'          => function($model, $key, $index, $column) {
                                            return $model->status ? '启用' : '未启用';
                                        }
                                    ],
                                    [
                                        /** @see yii\grid\ActionColumn */
                                        'header'         => '功能管理',
                                        'headerOptions'  => ['class' => 'center'],
                                        'contentOptions' => ['class' => 'col-sm-2 center'],
                                        'class'          => 'yii\grid\ActionColumn',
                                        'template'       => '{edit} {delete} ',
                                        'buttons'        => [
                                            'edit'   => function($url, $model) use ($selfurl) {
                                                return Html::a('编辑', [$selfurl, 'id' => $model['id']], []);
                                            },
                                            'delete' => function($url, $model) use ($selfurl) {
                                                return Html::a('删除', ['/system/express/delete', 'id' => $model['id']], [
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
                                //'showFooter'   => true,
                                // 'pager'        => ['options' => ['class' => 'pagination no-margin-top']],
                                'layout'       => '<div class="table-responsive no-padding">{items}</div><div class="box-footer clearfix"><div class=" no-marginpull-right">{pager}</div></div>',
                                'tableOptions' => ['class' => 'table table-striped table-bordered table-hover no-margin-bottom no-border-top'],
                                'options'      => ['class' => '']
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{yRequest()->get('id')?"编辑" : "新增"}}快递公司管理</span>
                            </div>
                        </div>
                        <div class="portlet-body util-btn-margin-bottom-5">
                            <div class="widget-main no-padding">
                                <div id="external-events">
                                    <?php
                                    $form = ActiveForm::begin();
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label" >快递公司</label>
                                        <div class="input-group spinner">
                                            <input type="text" class="form-control " name="Express[name]" value="{{ $model->name }}" >
                                            <p class="help-block help-block-error"></p>
                                            <p class="help-block ">请输入快递公司名称</p>
                                        </div>
                                    </div>
                                        <div class="form-group " >
                                            <label class="control-label" >快递公司电话</label>
                                            <div>
                                                <div class="input-group spinner">
                                                    <input type="text" class="form-control " name="Express[phone]" value="{{ $model->phone }}" >
                                                </div>
                                                <p class="help-block help-block-error"></p>
                                                <p class="help-block ">快递公司电话</p>
                                            </div>
                                        </div>
                                        <div class="form-group" >
                                            <label class="control-label">快递公司地址</label>
                                            <div>
                                                <div class="input-group spinner">
                                                    <input type="text" class="form-control " name="Express[address]" value="{{ $model->address }}" >
                                                </div>
                                                <p class="help-block help-block-error"></p>
                                                <p class="help-block ">快递公司地址</p>
                                            </div>
                                        </div>
                                    <?php
                                    echo $form->field($model, 'status')
                                        ->label('状态')
                                        ->hint('')
                                        ->radioList([0 => '禁用', 1 => '启用']);
                                    ?>
                                    <input type="submit" value="提交">
                                    <?php $form->end();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@push('head-style')

@endpush

@push('foot-script')

@endpush
