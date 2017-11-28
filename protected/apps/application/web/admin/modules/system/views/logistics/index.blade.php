<?php
use yii\grid\GridView;use yii\helpers\Html;use yii\web\View;use yii\widgets\ActiveForm;

/** @var $view View */

?>@extends('layouts.main')@section('title','发货地管理')

@section('breadcrumb')
  @include('global.breadcrumb',['title'=>'发货地管理','subtitle'=>'发货地管理','breads'=>[[
      'label' => '发货地列表 ',
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
                <span class="caption-subject font-red sbold uppercase">发货地</span>
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
                            'contentOptions' => ['class' => 'col-sm-4'],
                            'attribute'      => 'title',
                            'label'          => '发货地名称',
                            'format'         => 'html',
                        ],
                        [
                            'contentOptions' => ['class' => 'col-sm-2'],
                            'attribute'      => 'sign_name',
                            'label'          => '简写',
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
                                    // [$selfurl, 'id' => $model['id']]
                                    //                                     return Html::a('删除','javascript:;', ['data'=>['method'=>'post','confirm'=>'您确认要删除吗？']]);
                                    return Html::a('删除', ['/system/logistics/delete', 'id' => $model['id']], [
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
                <span class="caption-subject font-green-sharp bold uppercase">{{yRequest()->get('id')?"编辑" : "新增"}}发货地管理</span>
              </div>
            </div>
            <div class="portlet-body util-btn-margin-bottom-5">
              <div class="widget-main no-padding">
                <div id="external-events">
                    <?php
                    $form = ActiveForm::begin();
                    ?>
                  <div class="form-group field-logistics-weeks" id="field-logistics-title">
                    <label class="control-label" for="logistics-name">发货地</label>
                    <div class="input-group spinner">
                      <input type="text" class="form-control " name="Logistics[title]" value="{{ $model->title }}" id="logistics-title">
                      <p class="help-block help-block-error"></p>
                      <p class="help-block ">请输入发货地名称</p>
                    </div>
                  </div>
                  <div class="form-group field-logistics-weeks" id="field-logistics-sign_name">
                    <label class="control-label" for="logistics-subname">发货地简写</label>
                    <div>
                      <div class="input-group spinner">
                        <input type="text" class="form-control " name="Logistics[sign_name]" value="{{ $model->sign_name }}" id="logistics-sign_name">
                      </div>
                      <p class="help-block help-block-error"></p>
                      <p class="help-block ">发货地的简写，简易标识一下</p>
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
