@extends('layouts.main')@section('title','订单列表')<?php
use common\assets\ace\InlineForm;use yii\grid\GridView;use yii\helpers\ArrayHelper;use yii\helpers\Html;use yii\web\View;
/** @var $view View */
?>
@push('head-style')
  <style type="text/css">
    .ship{
      color:#545504;
    }
    .deal{
      color:blue;
    }
    .delete{
      color:red;
    }
    #export{
      color:#3fd5c0;
    }
    .select2-dropdown{
      z-index:20000000000;
    }
    .edit_logistic{
      color:#585814;
    }
  </style>
@endpush
@section('breadcrumb')
  @include('global.breadcrumb',['title'=>'订单列表','subtitle'=>'订单列表','breads'=>[[
      'label' => '订单列表 ',
      'url'   => $selfurl,
  ]]])
@stop
@section('content')

  <div style="">
    <div class="btn-group">
      {{--<a href="#" class="btn bg-yellow btn-default">全部</a>--}}
      @foreach( $payArr as $k=>$v)
        <a href="{{yUrl(['',
                'logistic_id'      => yRequest()->get('logistic_id',-99),
                'ship_uuid'         => yRequest()->get('ship_uuid',-99),
                'pay_status'        => $k,
                'order_status'      => yRequest()->get('order_status',-99),
                'wx_transaction_id' => yRequest()->get('wx_transaction_id'),
                'ship_code'         => yRequest()->get('ship_code')
                ])}}" title="{{ $v }}-{{$k}}" class="btn btn-default {{ $k==$conditions['pay_status']?'bg-yellow':'' }} ">{{ $v }}</a>
      @endforeach
    </div>
  </div>
  <div style="">
    <div class="btn-group">
      {{--<a href="#" class="btn bg-yellow btn-default">全部</a>--}}
      @if( $userinfo['is_admin']== 1)
        @foreach( $logArr as $k=>$v)
          <a href="{{yUrl(['',
                'logistic_id'      => $k,
                'ship_uuid'         => \yii\helpers\ArrayHelper::getValue($_GET, 'ship_uuid', '-99'),
                'pay_status'        => \yii\helpers\ArrayHelper::getValue($_GET, 'pay_status', $conditions['pay_status']),
                'order_status'      => \yii\helpers\ArrayHelper::getValue($_GET, 'order_status', '-99'),
                'wx_transaction_id' => \yii\helpers\ArrayHelper::getValue($_GET, 'wx_transaction_id', ''),
                'ship_code'         => \yii\helpers\ArrayHelper::getValue($_GET, 'ship_code', '')
                ])}}" title="{{ $v }}" class="btn btn-default {{ $k==\yii\helpers\ArrayHelper::getValue($_GET, 'logistic_id', '-99')?'bg-yellow':'' }} ">{{ explode('-',$v)[0] }}</a>
        @endforeach
      @endif
    </div>
      <?php
      /** @var InlineForm $form */
      $form = InlineForm::begin(['action' => yUrl(['site/index']), 'method' => 'get']);
      echo $form->label("", Html::input('hidden', "pay_status", $pay_status != -99 ? $pay_status : ArrayHelper::getValue($_GET, 'pay_status', '-99')));
      echo $form->label("", Html::input('hidden', "logistic_id", $logistic_id != -99 ? $logistic_id : ArrayHelper::getValue($_GET, 'logistic_id', '-99')));
      echo $form->label("快递公司", Html::dropDownList("ship_uuid", ArrayHelper::getValue($_GET, 'ship_uuid', ''), $expressArr));
      echo $form->label("订单状态", Html::dropDownList("order_status", ArrayHelper::getValue($_GET, 'order_status', ''), [
          '-99' => '全部',
          '0'   => '未处理',
          '1'   => '处理中',
          '2'   => '已支付',
          '21'  => '已发货',
          '22'  => '已收货',
          '23'  => '用户不存在',
          '29'  => '发货完成',
          '11'  => '申请退款',
          '12'  => '退款审核',
          '13'  => '退款成功',
          '14'  => '退款失败',
          '18'  => '退款处理中',
          '19'  => '退款完成',
          '99'  => '订单完成',
          '100' => '未知状态'
      ]));
      echo "<br />";
      echo $form->label("艾滋病检测结果", Html::dropDownList("adis_result", ArrayHelper::getValue($_GET, 'adis_result', ''), $checkArr));
      echo $form->label("梅毒检测结果", Html::dropDownList("syphilis_result", ArrayHelper::getValue($_GET, 'syphilis_result', ''), $checkArr));
      echo $form->label("乙肝检测结果", Html::dropDownList("hepatitis_b_result", ArrayHelper::getValue($_GET, 'hepatitis_b_result', ''), $checkArr));
      echo $form->label("丙肝检测结果", Html::dropDownList("hepatitis_c_result", ArrayHelper::getValue($_GET, 'hepatitis_c_result', ''), $checkArr));
      echo "<br />";
      echo $form->label("微信订单号", Html::textInput("wx_transaction_id", ArrayHelper::getValue($_GET, 'wx_transaction_id', '')));
      echo $form->label("快递单号", Html::textInput("ship_code", ArrayHelper::getValue($_GET, 'ship_code', '')));
      echo $form->label("收货人", Html::textInput("address_contact", ArrayHelper::getValue($_GET, 'address_contact', '')));
      echo $form->label("收货人电话", Html::textInput("address_mobile", ArrayHelper::getValue($_GET, 'address_mobile', '')));
      echo $form->submitInput();
      echo $form->buttonInput('导出', ['class' => 'input-group-btn btn btn-default btn-sm input-small export']);
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
                    // [
                    //     'contentOptions' => ['class' => 'col-sm-1'],
                    //     'attribute'      => 'id',
                    //     'label'          => '订单ID',
                    //     'value'          => function($model) {
                    //         return $model->id * 9 + strtotime('2018-01-01');
                    //     }
                    // ],
                    [
                        'contentOptions' => ['style' => 'width:8%'],
                        'attribute'      => 'address_contact',
                        'label'          => '收货人'
                    ],
                    [
                        'contentOptions' => ['style' => 'width:5%'],
                        'attribute'      => 'address_mobile',
                        'label'          => '电话'
                    ],
                    // [
                    //     'contentOptions' => ['class' => 'col-sm-1'],
                    //     'attribute' => 'address_detail',
                    //     'label' => '详细地址'
                    // ],
                    [
                        'contentOptions' => ['style' => 'width:5%'],
                        'attribute'      => 'total_price',
                        'label'          => '总价',
                        'value'          => function($model) {
                            return $model->total_price / 100;
                        }
                    ],
                    // [
                    //     'contentOptions' => ['class' => 'col-sm-1'],
                    //     'attribute'      => 'wx_transaction_id',
                    //     'label'          => '微信订单号',
                    // ],
                    [
                        'contentOptions' => ['style' => 'width:5%'],
                        'attribute'      => 'pay_status',
                        'label'          => '支付状态',
                        'value'          => function($model) {
                            return gPayStatus($model->pay_status);
                        }
                    ],
                    [
                        'contentOptions' => ['style' => 'width:5%'],
                        'attribute'      => 'order_status',
                        'label'          => '订单状态',
                        'value'          => function($model) {

                            return gOrderStatus($model->order_status);// . "($model->order_status)";
                        }
                    ],
                    //                                    [
                    //                                        'contentOptions' => ['class' => 'col-sm-2'],
                    //                                        'attribute' => 'ship_name',
                    //                                        'label' => '快递公司',
                    //                                    ],
                    [
                        'contentOptions' => ['style' => 'width:5%'],
                        'attribute'      => 'ship_code',
                        'format'         => 'raw',
                        'label'          => '快递单号',
                        'value'          => function($model) use ($logistics) {
                            $logistic_name = '';
                            foreach($logistics as $item){
                                if($item['id'] == $model->logistic_id)
                                    $logistic_name = $item['title'];
                            }

                            return "<span class='popovers' data-container='body' data-trigger='hover' data-placement='top'
                                                     data-content='{$logistic_name} | {$model->address_contact} |  $model->address_detail'
                                                     data-original-title='{$model->ship_name}($model->ship_code)'>{$model->ship_code}</span>";
                        }
                    ],
                    [
                        'contentOptions' => ['style' => 'width:5%'],
                        'attribute'      => 'ship_status',
                        'label'          => '配送状态',
                        'value'          => function($model) {
                            return $model->ship_status == 1 ? "已发货" : '未发货';
                        }
                    ],
                    [
                        'contentOptions' => ['style' => 'width:20%'],
                        'attribute'      => 'adis_result',
                        'label'          => '艾滋检测状况',
                        'value'          => function($model) {
                            $ops = adminGetAidsStatus(isset($model->adis_result) ? $model->adis_result : 0);
                            if(2 == $model->adis_result){
                                $ops .= sprintf("；是否确证：%s / ", adminConfirmStatus($model->adis_is_confirm));
                                if($model->adis_is_confirm){
                                    $ops .= sprintf("日期:%s ；", substr($model->adis_confirm_time, 0, 10));

                                    $ops .= sprintf("是否治疗：%s / ", adminConfirmStatus($model->adis_is_cure));
                                    if($model->adis_is_cure){
                                        $ops .= sprintf("日期:%s", substr($model->adis_cure_time, 0, 10));
                                    }
                                }
                            }
                            return $ops;
                        }
                    ],

                    [
                        /** @see yii\grid\ActionColumn */
                        'header'         => '功能管理',
                        'headerOptions'  => ['class' => 'center'],
                        'contentOptions' => ['class' => 'col-sm-2 center', 'style' => 'width:15%'],
                        'class'          => 'yii\grid\ActionColumn',
                        'template'       => '{edit_logistic} {ship} {deal} {memo} {detail} {export} {delete}',
                        'buttons'        => [
                            'edit_logistic' => function($url, $model) use ($userinfo) {
                                if($model->ship_status != 1 && $userinfo['is_admin'] == 1){
                                    return Html::a('修改发货地', 'javascript:;', [
                                        'data-id'     => $model['uuid'],
                                        'logistic_id' => $model['logistic_id'],
                                        'class'       => 'edit_logistic'
                                    ], []);
                                }
                            },
                            'ship'          => function($url, $model) {
                                if($model->pay_status == 1 && $model->order_status == 2){
                                    return Html::a('发货', 'javascript:;', ['data-id' => $model['uuid'], 'class' => 'ship'], []);
                                }
                            },
                            'deal'          => function($url, $model) use ($dealArr, $userinfo) {
                                //                                            if (in_array($model->order_status, $dealArr) ) {
                                return Html::a('处理', ['/order/site/deal', 'uuid' => $model['uuid'], 'uid' => $model['uid']], [
                                    'class'  => 'deal',
                                    'target' => '_blank'
                                ]);
                                //                                            }
                            },
                            'memo'          => function($url, $model) {
                                return Html::a('备注', 'javascript:;', ['data-id' => $model['uuid'], 'class' => 'memo'], []);
                            },
                            'detail'        => function($url, $model) {
                                return Html::a('详情', ['/order/site/detail', 'uuid' => $model['uuid'], 'uid' => $model['uid']], [
                                    'class'  => 'detail',
                                    'target' => '_blank'
                                ]);
                            },
                            'export'        => function($url, $model) {
                                return Html::a('导出', ['/order/site/single', 'uuid' => $model['uuid']], [
                                    'id'   => 'export',
                                    'data' => [
                                        'method' => 'post',
                                        'params' => [
                                            'uuid' => $model['uuid']
                                        ]
                                    ]
                                ]);
                            },
                            'delete'        => function($url, $model) use ($selfurl) {
                                return Html::a('删除', ['/order/site/delete', 'id' => $model['uuid']], [
                                    'class' => 'delete',
                                    'data'  => [
                                        'method'  => 'post',
                                        'confirm' => '您确认要删除吗？',
                                        'params'  => [
                                            'id' => $model['uuid']
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
                    'columns'      => $columns,
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
  <div id="edit_logistic-content" style="display:none">
    <div class="form-group">
      <label class="col-md-3 control-label">修改发货地</label>
      <div class="col-md-9">
        <select class="form-control logistic_name" id="logistic_name">
          @foreach( $logistics as $item)
            <option value="{{ $item['id'] }}">{{$item['title']}}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>
  <div id="ship-content" style="display:none">
    <div class="form-group">
      <label class="col-md-3 control-label">快递公司</label>
      <div class="col-md-9">
        <select class="form-control js-express-tags input-medium ship_name" id="ship_name">
          @foreach( $ship as $k=>$v)
            <option value="{{ $k }}" {{ $v=='自取'?"data-values=".$v:'' }}>{{$v}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-3 control-label">快递单号</label>
      <div class="col-md-9">
        <input type="text" class="form-control input-inline input-medium ship_code" placeholder="快递单号">
      </div>
    </div>
  </div>
  <div id="memo-content" style="display:none">
    <div class="form-group">
      <label class="col-md-2 control-label">备注</label>
      <div class="col-md-10">
        <textarea class="form-control " id="memo"></textarea>
      </div>
    </div>
  </div>
@endsection
@push('head-style')
  <style type="text/css">
    .btn.btn-sm{
      background:#3fd5c0;
      color:#fff;
    }
    #ship-content .form-group{
      text-align:center;
      padding:20px;
    }
  </style>
@endpush
@push('foot-script')
  <script>
      $(function () {
          $(".js-express-tags").select2({
              tags: true
          });

          var _this;
          $(".edit_logistic").click(function (i) {
              _this = $(this);
              var uuid = _this.data('id');
              var logistic_id = _this.attr('logistic_id');
              $("#logistic_name").val(logistic_id);
              layer.open({
                  type: 1,
                  title: '修改发货地',
                  shadeClose: true,
                  skin: 'layui-layer-rim', //加上边框
                  area: ['420px', '240px'], //宽高
                  content: $('#edit_logistic-content'),
                  btn: ['保存', '取消'],
                  yes: function () {
                      $.post("{{yUrl(['site/exitlogistic'])}}",
                          {
                              'uuid': uuid,
                              'back_url': "{{$selfurl}}",
                              'logistic_id': $(".logistic_name").val()
                          }, function (res) {
                              if (res.code == 200) {
                                  _this.attr('logistic_id', $(".logistic_name").val());
                                  layer.msg('保存成功！！', {'icon': 1, time: 1200}, function () {
                                      layer.closeAll();
                                  });
                              }
                          }
                      );
                  }
              });
          });

          $(".ship").click(function (i) {
              _this = $(this);
              var uuid = _this.data('id');
              layer.open({
                  type: 1,
                  title: '填写发货单',
                  shadeClose: true,
                  skin: 'layui-layer-rim', //加上边框
                  area: ['420px', '240px'], //宽高
                  content: $('#ship-content'),
                  btn: ['发货', '取消'],
                  yes: function () {
                      var select_index = document.getElementById("ship_name").selectedIndex;
                      var object = $(".ship_name option")[select_index];
                      if (($(".ship_name").val() && $(".ship_code").val()) || object.text == '自取') {
                          $.post("{{yUrl(['site/ship'])}}",
                              {
                                  'uuid': uuid,
                                  'back_url': "{{$selfurl}}",
                                  'ship_id': $(".ship_name").val(),
                                  'ship_code': $(".ship_code").val()
                              }, function (res) {
                                  if (res.code == 200) {
                                      layer.msg('发货成功！！', {'icon': 1, time: 1200}, function () {
                                          layer.closeAll();
                                          location.reload();
                                      });
                                  }
                              }
                          );
                      } else {
                          $("#ship-content .form-group").addClass("has-error");
                      }
                  }
              });
          });

          $(".export").click(function () {
              var url = location.href.split("?");
              if (url[1]) {
                  location.href = "{{yUrl(['site/export'])}}" + "?" + url[1];
              } else {
                  location.href = "{{yUrl(['site/export'])}}";
              }
          });

          $(".memo").click(function (i) {
              _this = $(this);
              var uuid = _this.data('id');
              layer.open({
                  type: 1,
                  title: '填写备注信息',
                  shadeClose: true,
                  skin: 'layui-layer-rim', //加上边框
                  area: ['420px', '200px'], //宽高
                  content: $('#memo-content'),
                  btn: ['确定', '取消'],
                  yes: function () {
                      if ($("#memo").val()) {
                          $.post("{{yUrl(['site/memo'])}}",
                              {
                                  'uuid': uuid,
                                  'memo': $("#memo").val(),
                              }, function (res) {
                                  if (res.code == 200) {
                                      layer.msg('备注成功！！', {'icon': 1, time: 1200}, function () {
                                          layer.closeAll();
                                          location.reload();
                                      });
                                  }
                              }
                          );
                      } else {
                          $("#memo-content .form-group").addClass("has-error");
                      }
                  }
              });
          });

      });
  </script>
@endpush
