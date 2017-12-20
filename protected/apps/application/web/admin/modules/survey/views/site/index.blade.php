<?php
use yii\grid\GridView;use yii\helpers\Html;use yii\web\View;use yii\widgets\ActiveForm;
/** @var $view View */
?>
@extends('layouts.main')@section('title','调查问卷列表')
@section('breadcrumb')
  @include('global.breadcrumb',['title'=>'调查问卷列表','subtitle'=>'所有调查问卷都在这里','breads'=>[[
      'label' => '调查问卷 ',
      'url'   => yRoute($selfurl),
  ]]])
@stop
@section('content')
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
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'name',
                                        'label'          => '姓名',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'nation',
                                        'label'          => '民族',

                                    ],                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'gender',
                                        'label'          => '性别',
                                    ],

                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'education',
                                        'label'          => '文化程度',

                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'marriage',
                                        'label'          => '婚姻状况',

                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'job',
                                        'label'          => '职业',

                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'income',
                                        'label'          => '收入',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'livecity',
                                        'label'          => '居住城市',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'livetime',
                                        'label'          => '居住时间',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'created_at',
                                        'label'          => '填写时间',
                                    ],

                                    [
                                        /** @see yii\grid\ActionColumn */
                                        'header'         => '功能管理',
                                        'headerOptions'  => ['class' => 'center'],
                                        'contentOptions' => ['class' => 'col-sm-1 center'],
                                        'class'          => 'yii\grid\ActionColumn',
                                        'template'       => '{detail} ',
                                        'buttons'        => [
                                            'detail'   => function($url, $model) use ($selfurl) {
                                                return Html::a('详情', ['site/detail', 'id' => $model['id']], []);
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

@stop

@push('head-style')
@endpush

@push('foot-script')
  <script>
      $(function () {

      });
  </script>
@endpush
