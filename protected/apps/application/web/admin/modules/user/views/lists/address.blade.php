
<?php
use yii\grid\GridView;use yii\helpers\Html;use yii\web\View;use yii\widgets\ActiveForm;
/** @var $view View */
?>
@extends('layouts.main')
@section('title','地址列表')

@section('breadcrumb')
    @include('global.breadcrumb',['title'=>'地址列表','subtitle'=>'地址列表','breads'=>[[
        'label' => '地址列表 ',
        'url'   => $selfurl,
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
                                        'attribute'      => 'realname',
                                        'label'          => '收货人姓名',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'mobile',
                                        'label'          => '收货人手机',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'city',
                                        'label'          => '城市',

                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'address',
                                        'label'          => '详细地址',

                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute'      => 'is_default',
                                        'label'          => '是否默认地址',
                                        'value'          =>function($model){
                                            return $model->is_default==1?'是':'';
                                        }

                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-2'],
                                        'attribute'      => 'created_at',
                                        'label'          => '创建时间',
                                    ],
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
