<?php
use yii\grid\GridView;use yii\helpers\Html;use yii\web\View;use yii\widgets\ActiveForm;

/** @var $view View */

?>@extends('layouts.main')@section('title','商品管理')

@section('breadcrumb')
  @include('global.breadcrumb',['title'=>'商品列表','subtitle'=>'这里是简单的商品列表','breads'=>[[
      'label' => '商品列表 ',
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
                <span class="caption-subject font-red sbold uppercase">简易商品管理</span>
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
                            'attribute'      => 'name',
                            'label'          => '商品名称',
                            'format'         => 'html',
                        ],
                        [
                            'contentOptions' => ['class' => 'col-sm-2'],
                            'attribute'      => 'subname',
                            'label'          => '简称',
                        ],
                        //                      [
                        //                          'contentOptions' => ['class' => 'col-sm-1'],
                        //                          'attribute'      => 'level',
                        //                          'label'          => '级别',
                        //                          'format'         => 'html',
                        //                      ],
                        [
                            'contentOptions' => ['class' => 'col-sm-1'],
                            'attribute'      => 'type',
                            'label'          => '类型',
                            'value'          => function($model, $key, $index, $column) {
                                return $model->getTypeName($model->type);
                            }
                        ],
                        [
                            'contentOptions' => ['class' => 'col-sm-1'],
                            'attribute'      => 'price',
                            'label'          => '价格',

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
                            'contentOptions' => ['class' => 'col-sm-1'],
                            'attribute'      => 'stock',
                            'label'          => '库存',
                            'format'         => 'raw',
                            'value'          => function($model, $key, $index, $column) {
                                return $model->stock == -1 ? "无限" : $model->stock;
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
                                    return Html::a('删除', ['/system/reagent/delete', 'id' => $model['id']], [
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
                <span class="caption-subject font-green-sharp bold uppercase">{{yRequest()->get('id')?"编辑" : "新增"}}商品</span>
              </div>
            </div>
            <div class="portlet-body util-btn-margin-bottom-5">
              <div class="widget-main no-padding">
                <div id="external-events">
                    <?php
                    $form = ActiveForm::begin();

                    ?>
                  <div class="form-group field-reagent-weeks" id="field-reagent-name">
                    <label class="control-label" for="reagent-name">商品名称</label>
                    <div class="input-group spinner">
                      <input type="text" class="form-control " name="Reagent[name]" value="{{ $model->name }}" id="reagent-name">
                      <p class="help-block help-block-error"></p>
                      <p class="help-block ">请输入商品名称</p>
                    </div>
                  </div>
                  <div class="form-group field-reagent-weeks" id="field-reagent-subname">
                    <label class="control-label" for="reagent-subname">商品简写</label>
                    <div>
                      <div class="input-group spinner">
                        <input type="text" class="form-control " name="Reagent[subname]" value="{{ $model->subname }}" id="reagent-subname">
                      </div>
                      <p class="help-block help-block-error"></p>
                      <p class="help-block ">请输入商品名称的简写</p>
                    </div>
                  </div>
                  <div class="form-group field-reagent-weeks" id="field-reagent-type">
                    <label class="control-label" for="reagent-subname">商品类型</label>
                    <div>
                      <div class="input-group ">
                        {!! ySelect('Reagent[type]',$model->type,gArrayHelper()->merge([0=>'请选择商品类型'],$model->getTypes()),['class'=>'form-control select2']) !!}
                      </div>
                      <p class="help-block help-block-error"></p>
                      <p class="help-block "></p>
                    </div>
                  </div>
                  <div class="form-group field-reagent-image" id="field-reagent-image">
                    <label class="control-label" for="reagent-image">商品图片</label>
                    <div>
                      <input type="text" id="reagent-image" class="col-xs-8 attach_reagent-image" name="Reagent[image]" value="{{$model->image}}">
                      <button type="button" class="upload_reagent-image btn btn-primary btn-xs middle" id="image_uploader" style="margin-left:5px;">
                        上传
                      </button>
                      <a class="preview_reagent-image btn btn-primary btn-xs middle" href="#preview-reagent_image" style="margin-left:5px;" data-toggle="modal">预览</a>
                      <p class="help-block help-block-error"></p>
                      <p class="help-block " id="imagefsUploadProgress"></p>
                    </div>
                  </div>
                  <div class="form-group field-reagent-image" id="field-reagent-image">
                    <label class="control-label" for="reagent-image">请选择与该商品相关的发货地</label>
                    <div>
                      <select id="multiple" class="form-control select2-multiple select2" aria-hidden="true" name="relation[]" multiple size="1">
                        @foreach($logistics as $logistic)
                          <option value="{{$logistic['id']}}" @if(in_array($logistic['id'],array_keys($logi_related))) selected="selected" @endif>{{$logistic['title']}}</option>
                        @endforeach
                      </select>
                      <p class="help-block ">不选，代表所有发货地都能发货</p>
                    </div>
                  </div>
                  <div class="form-group field-reagent-write_image" id="field-reagent-write_image">
                    <label class="control-label" for="reagent-write_image">库存</label>
                    <div class="input-group spinner">
                      <input type="text" id="" class="form-control" name="Reagent[stock]" value="{{$model->stock}}">
                      <p class="help-block help-block-error"></p>
                      <p class="help-block ">不填，或者填写-1，为不限库存</p>
                    </div>
                  </div>
                    <?php
                    echo $form->field($model, 'price')
                              ->label('价格')
                              ->hint('')
                              ->textInput([
                                  'placeholder' => '不输或为0则代表兔费',
                              ]);
                    echo $form->field($model, 'description')
                              ->label('简要说明')
                              ->hint('')
                              ->textarea([
                                  'style' => 'height:100px',
                              ]);
                    echo $form->field($model, 'status')
                              ->label('状态')
                              ->hint('')
                              ->radioList([0 => '禁用', 1 => '启用']);
                    //                     echo $form->field($model, 'comment')
                    //                               ->label('简要说明')
                    //                               ->hint('')
                    //                               ->textarea([
                    //                                   'style' => 'height:100px',
                    //                               ]);
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
  <link href="{{yStatic('assets/global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{yStatic('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@push('foot-script')
  <script src="{{gStatic('vendor/plugins/qiniu/plupload.min.js')}}" defer></script>
  <script src="{{gStatic('vendor/plugins/plupload/i18n/zh_CN.js')}}" defer></script>
  <script src="{{gStatic('vendor/plugins/qiniu/qiniu.min.js')}}" defer></script>
  <script src="{{gStatic('vendor/plugins/qiniu/progress.js')}}" defer></script>
  <script src="{{gStatic('vendor/plugins/datepicker/bootstrap-datepicker.js')}}" defer></script>
  <script src="{{yStatic('assets/global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
  <script type="text/javascript" defer>
      function uploader(id) {
          return Qiniu.uploader({
              runtimes: 'html5,flash,html4',    //上传模式,依次退化
              browse_button: id + '_uploader',       //上传选择的点选按钮，**必需**
              uptoken_url: '{{yUrl(['site/token','type'=>'image'])}}',            //Ajax请求upToken的Url，**强烈建议设置**（服务端提供）
              // uptoken : '', //若未指定uptoken_url,则必须指定 uptoken ,uptoken由其他程序生成
              // unique_names: true, // 默认 false，key为文件名。若开启该选项，SDK为自动生成上传成功后的key（文件名）。
              // save_key: true,   // 默认 false。若在服务端生成uptoken的上传策略中指定了 `sava_key`，则开启，SDK会忽略对key的处理
              domain: 'http://onnpwlk5l.bkt.clouddn.com/',   //bucket 域名，下载资源时用到，**必需**
              get_new_uptoken: true,  //设置上传文件的时候是否每次都重新获取新的token
              //              container: 'container',           //上传区域DOM ID，默认是browser_button的父元素，
              max_file_size: '100mb',           //最大文件体积限制
              flash_swf_url: '{{yStatic('vendor/plugins/plupload/Moxie.swf')}}',  //引入flash,相对路径
              max_retries: 3,                   //上传失败最大重试次数
              dragdrop: false,                   //开启可拖曳上传
              //              drop_element: 'field-reagent-image',        //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
              chunk_size: '4mb',                //分块上传时，每片的体积
              auto_start: true,                 //选择文件后自动上传，若关闭需要自己绑定事件触发上传
              multi_selection: false,
//              log_level: 5,
              filters: {
                  mime_types: [ //只允许上传文件格式
                      {title: "image files", extensions: "jpg,png,jpeg"}
                  ]
              },
              init: {
                  'FilesAdded': function (up, files) {
                      $('#reagent-' + id).val('');
                  },
                  'BeforeUpload': function (up, file) {
                  },
                  'UploadProgress': function (up, file) {
                      $('#' + id + 'fsUploadProgress').html('<div class="progress" data-percent="' + file.percent + '%"><div class="progress-bar" style="width:' + file.percent + '%;"></div></div>');
                  },
                  'UploadComplete': function () {
                  },
                  'FileUploaded': function (up, file, info) {
                      var res = JSON.parse(info);
                      $('#reagent-' + id).val(res.key);
                      $('#' + id + 'fsUploadProgress').html('上传已完成');
                  },
                  'Error': function (up, err, errTip) {
                      console.log(err, errTip)
                  }
              }
          });
      }

      $(function () {
          $.fn.select2.defaults.set("theme", "bootstrap");
          $(".select2me").select2({placeholder: "Select", width: "auto", allowClear: !0});
          $('.select2').select2({});
          var filename = "";
          $('a[href="#preview-reagent"]').on('click', function () {
              var cdnPrefix = '';
              var imageVal = $(this).siblings('input').val();
              if (imageVal === "") {
                  layer.alert("还没有上传图片");
                  return false;
              }
              layer.open({
                  type: 1,
                  skin: 'layui-layer-rim', //加上边框
                  area: ['480px', '360px'], //宽高
                  content: "<img src='" + cdnPrefix + imageVal + "' style='max-width:100%' />"
              });
          });
          uploader('image_uploader');
      });
  </script>
@endpush
