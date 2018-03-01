<?php

use yii\grid\GridView;use yii\web\View;

/** @var $view View */
?>@extends('layouts.main')@section('title','用户详细信息')

@section('breadcrumb')
  @include('global.breadcrumb',['title'=>'用户详细信息','subtitle'=>'用户详细信息','breads'=>[[
      'label' => '用户详细信息 ',
      'url'   => $selfurl,
  ]]])

@stop
@section('content')
  <div class="row user_info">
    @if($userinfo->isSuperAdmin())
      <div class="col-xs-3">微信昵称：{{ $data['openid'] }}</div>
    @endif
    <div class="col-xs-3">微信昵称：{{ $data['nickname'] }}</div>
    <div class="col-xs-3">真实姓名：{{ $data['realname'] }}</div>
    <div class="col-xs-3">性别：{{ $data['gender']==1?'男':'女' }}</div>
    <div class="col-xs-3">出生年月：{{ $data['birthdate'] }}</div>
    <div class="col-xs-3">民族：{{ $data['nation'] }}</div>
    <div class="col-xs-3">省份：{{ $data['province'] }}</div>
    <div class="col-xs-3">城市：{{ $data['city'] }}</div>
    <div class="col-xs-3">国家：{{ $data['country'] }}</div>
    <div class="col-xs-3">微信头像：<img src="{{ $data['headimgurl'] }}" width="40"></div>
    <div class="col-xs-3">年龄：{{ $data['age'] }}</div>
    <div class="col-xs-3">邮箱：{{ $data['email'] }}</div>
    <div class="col-xs-3">QQ：{{ $data['qq'] }}</div>
    <div class="col-xs-3">电话：{{ $data['telephone'] }}</div>
    <div class="col-xs-3">地址：{{ $data['address'] }}</div>
    <div class="col-xs-3">是否关注：{{ $data['is_subscribe']==1?'是':'否' }}</div>
  </div>
  <h3>收货地址列表</h3>
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
                            'contentOptions' => ['class' => 'col-sm-2'],
                            'attribute'      => 'address',
                            'label'          => '详细地址',
                        ],
                        [
                            'contentOptions' => ['class' => 'col-sm-1'],
                            'attribute'      => 'is_default',
                            'label'          => '是否默认地址',
                            'value'          => function($model) {
                                return $model->is_default == 1 ? '是' : '';
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
@push('head-style')
  <style type="text/css">
    .user_info div.col-xs-3{
      margin:10px 0;
    }
  </style>
@endpush
