@extends('layouts.main')@section('title','订单详情')

@section('content')
    <?php
    use yii\grid\GridView;use yii\helpers\Html;use yii\web\View;
    /** @var $view View */
    ?>
    @include('global.breadcrumb',['title'=>'订单详情','subtitle'=>'订单详情','breads'=>[
    [
        'label' => '订单列表 ',
        'url'   => ['/order/site/index'],
    ],[
            'label' => '订单详情 ',
            'url'   => yRoute($selfurl),
        ]]])

    <div class="row order">
        <div class="col-xs-6">内部流水号：{{ ($order_data['out_trade_no']) }}</div>
        <div class="col-xs-6">微信订单号：{{ ($order_data['wx_transaction_id']) }}</div>
      <div class="col-xs-6">真实姓名：{{ $survey['name'] or '' }} (微信呢称：<a href="{{yUrl(['/user/lists/detail','uid'=>$userdata['uid']])}}" target="_blank">{{$userdata['realname']}}</a>)</div>
      <div class="col-xs-3"></div>
      <div class="col-xs-3"><a class="btn" href="{{yUrl(['/survey/site/detail','uuid'=>$order_data['source_uuid']])}}" target="_blank">查看调研</a></div>
      <br/>
      {{--<div class="col-xs-3">订单标题：{{ $order_data['info'] }}</div>--}}
      <div class="col-xs-2">订单时间：{{ ($order_data['created_at']) }}</div>
      <div class="col-xs-2">支付状态：{{ gPayStatus($order_data['pay_status']) }}</div>
      <div class="col-xs-2">支付时间：{{ ($order_data['pay_time']) }}</div>
      <div class="col-xs-2">订单状态：{{ gOrderStatus($order_data['order_status']) }}</div>
      <div class="col-xs-2">发货状态：<span class="green">{{ ($order_data['ship_status']==1?'已发货':'未发货') }}</span></div>
      <div class="col-xs-1">
        @if( $order_data['pay_status']== 1 && $order_data['order_status'] == 2 && $order_data['ship_status'] != 1 )
          <button type="button" class="btn green ship" data-id="{{$order_data['uuid']}}">发货</button>
        @endif
        @if($order_data['ship_status']==1)
          <button type="button" class="btn green ship" data-id="{{$order_data['uuid']}}">修改发货信息</button>
        @endif
      </div>
    </div>
    <div class="row order">
      <div class="col-xs-12">发货地：@if($logisticsInfo!=null) {{$logisticsInfo['title']}} @endif</div>
      <div class="col-xs-12">
        @if($address)
          <strong>地区：</strong>{{$address['city']}} <br />
        @endif
          <strong>收件人：</strong>{{$order_data['address_contact']}} <br />
          <strong>手机：</strong>{{$order_data['address_mobile'] or ''}}<br />
          <strong>地址：</strong>{{$order_data['address_detail']}}</div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="row">
          <div class="col-sm-6">
              <h4>订单清单</h4>
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
                              'contentOptions' => ['class' => 'col-sm-8 center'],
                              'class'          => 'yii\grid\ActionColumn',
                              'template'       => '{detail}',
                              'buttons'        => [
                                  'detail' => function($url, $model) {
                                      return Html::a($model->goods_title, ['/system/reagent', 'id' => $model['goods_uuid']], []);
                                  },
                              ],
                          ],
                          [
                              'contentOptions' => ['class' => 'col-sm-3'],
                              'attribute'      => 'goods_price',
                              'label'          => '商品价格',
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
            <div class="col-sm-6">
                <h4>备注清单</h4>
                <div class="portlet light portlet-fit portlet-form bordered">
                    <div class="portlet-body">
                        <?php
                        /**  */
                        echo GridView::widget([
                            'dataProvider' => $memoProvider,
                            'columns'      => [
                                [
                                    'contentOptions' => ['class' => 'col-sm-1'],
                                    'attribute'      => 'id',
                                    'label'          => 'ID',
                                ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-2'],
                                    'attribute'      => 'admin_account',
                                    'label'          => '备注人',
                                ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-6'],
                                    'attribute'      => 'memo_history',
                                    'label'          => '备注信息',
                                ],
                                [
                                    'contentOptions' => ['class' => 'col-sm-3'],
                                    'attribute'      => 'datetime',
                                    'label'          => '备注时间',
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

    <div id="ship-content" style="display:none">
      <div class="form-group">
        <label class="col-md-3 control-label">快递公司</label>
        <div class="col-md-9">
            <select class="form-control js-express-tags input-medium ship_name" id="ship_name">
                @foreach( $ship as $k=>$v)
                    <option value="{{ $k }}" {{ $k==$order_data['ship_uuid']?"selected":''}} {{ $v=='自取'?"data-values=".$v:'' }}>{{$v}}</option>
                @endforeach
            </select>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-3 control-label">快递单号</label>
        <div class="col-md-9">
          <input type="text" class="form-control input-inline input-medium ship_code" value="{{$order_data['ship_code']}}" placeholder="快递单号">
        </div>
      </div>
    </div>

@endsection
@push('head-style')
  <style type="text/css">
      .order div{
          margin: 5px 0;
      }
    #ship-content .form-group{
      text-align:center;
      padding:20px;
    }
    .select2-dropdown {
        z-index: 20000000000; }
  </style>
@endpush
@push('foot-script')
  <script>
      $(function () {
          $(".js-express-tags").select2({
              tags: true
          });

          var _this;
          $(".ship").click(function () {
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
                      if ( ($(".ship_name").val() && $(".ship_code").val()) || object.text=='自取'  ) {
                          $.post("{{yUrl('ship')}}",
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

      });
  </script>
@endpush
