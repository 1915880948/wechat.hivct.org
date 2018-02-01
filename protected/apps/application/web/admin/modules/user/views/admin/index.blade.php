<?php
use yii\grid\GridView;use yii\helpers\Html;use yii\web\View;use yii\widgets\ActiveForm;

/** @var $view View */

?>@extends('layouts.main')@section('title','管理员管理')

@section('breadcrumb')
    @include('global.breadcrumb',['title'=>'管理员管理','subtitle'=>'管理员管理','breads'=>[[
        'label' => '管理员管理 ',
        'url'   => $selfurl,
    ]]])
@stop
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-sm-9">
                    <div class="portlet light portlet-fit portlet-form bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-red sbold uppercase">管理员管理</span>
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
                                'columns' => [
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute' => 'aid',
                                        'label' => 'ID',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute' => 'account',
                                        'label' => '账号',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-1'],
                                        'attribute' => 'nickname',
                                        'label' => '昵称',
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-2'],
                                        'attribute' => 'login_time',
                                        'label' => '登录时间',
                                        'value' =>function($model){
                                            return date('Y-m-d H:i:s',$model->login_time);
                                        }
                                    ],
                                    // [
                                    //     'contentOptions' => ['class' => 'col-sm-1'],
                                    //     'attribute' => 'login_ip',
                                    //     'label' => '登录IP',
                                    // ],
                                    // [
                                    //     'contentOptions' => ['class' => 'col-sm-1'],
                                    //     'attribute' => 'is_super',
                                    //     'label' => '状态',
                                    //     'format' => 'raw',
                                    //     'value' => function ($model, $key, $index, $column) {
                                    //         return $model->is_super ? '在线' : '下线';
                                    //     }
                                    // ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-2'],
                                        'attribute' => 'is_admin',
                                        'label' => '是否为admin',
                                        'format' => 'raw',
                                        'value' => function ($model, $key, $index, $column) {
                                            return $model->is_admin == 1 ? '是' : '否';
                                        }
                                    ],
                                    [
                                        'contentOptions' => ['class' => 'col-sm-3'],
                                        'attribute' => 'logistic_id',
                                        'label' => '发货地',
                                        'format' => 'raw',
                                        'value' => function ($model, $key, $index, $column) use ($logistic) {
                                            if ($model->is_admin == 1) {
                                                return '超级管理员';
                                            }
                                            foreach ($logistic as $item) {
                                                if ($item['id'] == $model->logistic_id) {
                                                    return $item['title'];
                                                }
                                            }
                                        }
                                    ],
                                    [
                                        /** @see yii\grid\ActionColumn */
                                        'header' => '功能管理',
                                        'headerOptions' => ['class' => 'center'],
                                        'contentOptions' => ['class' => 'col-sm-2 center'],
                                        'class' => 'yii\grid\ActionColumn',
                                        'template' => '{edit} {delete} ',
                                        'buttons' => [
                                            'edit' => function ($url, $model) use ($selfurl) {
                                                return Html::a('编辑', [$selfurl, 'id' => $model['id']], []);
                                            },
                                            'delete' => function ($url, $model) use ($userinfo) {
                                                if ($model['account'] != 'admin') {
                                                    return Html::a('删除', ['/user/admin/delete', 'id' => $model['id']], [
                                                        'data' => [
                                                            'method' => 'post',
                                                            'confirm' => '您确认要删除吗？',
                                                            'params' => [
                                                                'id' => $model['id']
                                                            ]
                                                        ]
                                                    ]);
                                                }
                                            }
                                        ],
                                    ],
                                    /** @var yii\grid\ActionColumn */
                                ],
                                'showHeader' => true,
                                //'showFooter'   => true,
                                // 'pager'        => ['options' => ['class' => 'pagination no-margin-top']],
                                'layout' => '<div class="table-responsive no-padding">{items}</div><div class="box-footer clearfix"><div class=" no-marginpull-right">{pager}</div></div>',
                                'tableOptions' => ['class' => 'table table-striped table-bordered table-hover no-margin-bottom no-border-top'],
                                'options' => ['class' => '']
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-settings font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">{{yRequest()->get('id')?"编辑" : "新增"}}
                                    管理员</span>
                            </div>
                        </div>
                        <div class="portlet-body util-btn-margin-bottom-5">
                            <div class="widget-main no-padding">
                                <div id="external-events">
                                    <?php
                                    $form = ActiveForm::begin();
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label">账号</label>
                                        <div class="input-group spinner">
                                            <input type="hidden" class="form-control " name="id"
                                                   value="{{ $model->aid }}">
                                            <input type="text" class="form-control " name="account"
                                                   value="{{ $model->account }}" required>
                                            <p class="help-block help-block-error"></p>
                                            <p class="help-block ">请输入账号</p>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label class="control-label">密码 {{isset($_GET['id'])?'--不修改密码，设置为空':''}}</label>
                                        <div>
                                            <div class="input-group spinner">
                                                <input type="text" class="form-control " name="password" value="">
                                            </div>
                                            <p class="help-block help-block-error"></p>
                                            <p class="help-block ">请输入密码</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">昵称</label>
                                        <div>
                                            <div class="input-group spinner">
                                                <input type="text" class="form-control " name="nickname"
                                                       value="{{ $model->nickname }}">
                                            </div>
                                            <p class="help-block help-block-error"></p>
                                            <p class="help-block ">请输入昵称</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">是否为admin</label>
                                        <div>
                                            <div class="input-group spinner">
                                                <select name="is_admin" id="is_admin">
                                                    <option value="0" {{ $model->is_admin==0?'selected':'' }}>否</option>
                                                    <option value="1" {{ $model->is_admin==1?'selected':'' }}>是</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="logistic_id">
                                        <label class="control-label">所属发货地管理</label>
                                        <div>
                                            <div class="input-group spinner">
                                                <select name="logistic_id">
                                                    @foreach ($logistic as $item)
                                                        <option value="{{$item['id']}}" {{ $model->logistic_id==$item['id']?'selected':'' }}>{{$item['title']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
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
    <script>
        $(function () {
            isShowLogistic();
            $('#is_admin').change(function () {
                isShowLogistic();
            });
        });

        function isShowLogistic() {
            if ($("#is_admin").val() == 1) {
                document.getElementById('logistic_id').style.display = 'none';
            } else {
                document.getElementById('logistic_id').style.display = 'block';
            }
        }
    </script>
@endpush
