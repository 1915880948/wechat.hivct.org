<?php
use yii\bootstrap\ActiveForm;use yii\grid\GridView;use yii\helpers\Html;use yii\web\View;

/** @var $view View */

?>@extends('layouts.main')@section('title','商品管理')

@section('breadcrumb')
  @include('components.breadcrumb',['title'=>'商品列表','subtitle'=>'这里是简单的商品列表','breads'=>[[
      'label' => '商品列表 ',
      'url'   => $selfurl,
  ]]])
@stop
@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="row">
        <div class="col-sm-8">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">简易商品管理</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 30px;">
                  <a href="{{yUrl($selfurl)}}" class="btn btn-primary btn-xs">新增</a>
                </div>
              </div>
            </div>
              <?php
              /**  */
              echo GridView::widget([
                  'dataProvider' => $reagents,
                  'columns'      => [
                      [
                          'contentOptions' => ['class' => 'col-sm-1'],
                          'attribute'      => 'name',
                          'label'          => '第几单元',
                          'format'         => 'html',
                      ],
                      [
                          'contentOptions' => ['class' => 'col-sm-1'],
                          'attribute'      => 'weeks',
                          'label'          => '共有几周',
                      ],
                      //                      [
                      //                          'contentOptions' => ['class' => 'col-sm-1'],
                      //                          'attribute'      => 'level',
                      //                          'label'          => '级别',
                      //                          'format'         => 'html',
                      //                      ],
                      [
                          'contentOptions' => ['class' => 'col-sm-1'],
                          'attribute'      => 'opening_time',
                          'label'          => '开课时间'
                      ],
                      [
                          'contentOptions' => ['class' => 'col-sm-3'],
                          'attribute'      => 'start_date',
                          'label'          => '预约时间',
                          'value'          => function($model, $key, $index, $column) {
                              if($model->start_date && $model->end_date){
                                  return $model->start_date . '至' . $model->end_date;
                              }
                          }
                      ],
                      [
                          'contentOptions' => ['class' => 'col-sm-1'],
                          'attribute'      => 'cover_image',
                          'label'          => '封面图片',
                          'format'         => 'raw',
                          'value'          => function($model, $key, $index, $column) {
                              if(!$model->cover_image){
                                  return "未上传";
                              }
                              return Html::a("预览", "javascript:;", [
                                  'data'  => ['src' => gImage($model->cover_image)],
                                  'class' => 'v-preview'
                              ]);
                          }
                      ],
                      [
                          'contentOptions' => ['class' => 'col-sm-1'],
                          'attribute'      => 'write_image',
                          'label'          => '写字课图片',
                          'format'         => 'raw',
                          'value'          => function($model, $key, $index, $column) {
                              if(!$model->write_image){
                                  return "未上传";
                              }
                              return Html::a("预览", "javascript:;", [
                                  'data'  => ['src' => gImage($model->write_image)],
                                  'class' => 'v-preview'
                              ]);
                          }
                      ],

                      [
                          /** @see yii\grid\ActionColumn */
                          'header'         => '功能管理',
                          'headerOptions'  => ['class' => 'center'],
                          'contentOptions' => ['class' => 'col-sm-2 center'],
                          'class'          => 'yii\grid\ActionColumn',
                          'template'       => '{edit} {add} <br> {picture} {extend} <br> {class}',
                          'buttons'        => [
                              'edit'    => function($url, $model) use ($selfurl) {
                                  return Html::a('编辑', [$selfurl, 'id' => $model['id']], []);
                              },
                              'add'     => function($url, $model) {
                                  return Html::a('添加内容', ['course/create', 'units' => $model['id']], []);
                              },
                              'picture' => function($url, $model) use ($selfurl) {
                                  return Html::a('介绍图片', ['course/picture', 'unit' => $model['name']], []);
                              },
                              'extend'  => function($url, $model) use ($selfurl) {
                                  return Html::a('扩展内容', ['course/extend', 'unit' => $model['name']], []);
                              },
                              'class'   => function($url, $model) use ($selfurl) {
                                  return Html::a('班级', ['course/class', 'unit' => $model['name']], []);
                              }
                          ],
                      ],
                      /** @var yii\grid\ActionColumn */
                  ],
                  'showHeader'   => true,
                  //'showFooter'   => true,
                  // 'pager'        => ['options' => ['class' => 'pagination no-margin-top']],
                  'layout'       => '<div class="box-body table-responsive no-padding">{items}</div><div class="box-footer clearfix"><div class=" no-marginpull-right">{pager}</div></div>',
                  'tableOptions' => ['class' => 'table table-striped table-bordered table-hover no-margin-bottom no-border-top'],
                  'options'      => ['class' => '']
              ]);
              ?>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="widget-box transparent">
            <div class="widget-header">
              <h4>{{yRequest()->get('id')?"编辑" : "新增"}}课程类别</h4>
            </div>
            <div class="widget-body">
              <div class="widget-main no-padding">
                <div id="external-events">
                    <?php
                    $form = ActiveForm::begin([
                        'fieldClass'  => '\common\assets\widgets\KindeditActiveField',
                        'fieldConfig' => [
                            'template'             => "{label}\n{beginWrapper}\n{input}\n{hint}\n {error}\n{endWrapper}",
                            'horizontalCssClasses' => [
                                'label'   => 'col-sm-3',
                                'offset'  => 'col-sm-offset-2',
                                'wrapper' => 'col-sm-9',
                                'error'   => '',
                                'hint'    => '',
                            ],
                        ],
                    ]);

                    ?>
                  <div class="form-group field-coursecate-name" id="field-coursecate-name">
                    <label class="control-label" for="coursecate-name">课程单元（0为免费课程）</label>
                    <div>
                      <div class="input-group spinner">
                        <input type="text" class="form-control " name="CourseCate[name]" value="{{intval($model->name)}}" id="coursecate-name">
                        <div class="input-group-btn-vertical">
                          <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                          <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                        </div>
                        <input type="text" name="CourseCate[color]" value="{{$model->color??"#000"}}" class="form-control my-colorpicker1 colorpicker-element">
                      </div>
                      <p class="help-block help-block-error"></p>
                      <p class="help-block ">请选择课程单元和它对应的颜色</p>
                    </div>
                  </div>
                  <div class="form-group field-coursecate-weeks" id="field-coursecate-weeks">
                    <label class="control-label" for="coursecate-weeks">课程周数（共几周）</label>
                    <div>
                      <div class="input-group spinner">
                        <input type="text" class="form-control " name="CourseCate[weeks]" value="{{intval($model->weeks??8)}}" id="coursecate-weeks">
                        <div class="input-group-btn-vertical">
                          <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                          <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                        </div>
                      </div>
                      <p class="help-block help-block-error"></p>
                      <p class="help-block ">请输入该课程共有几周</p>
                    </div>
                  </div>
                  <div class="form-group field-coursecate-weeks" id="field-coursecate-weeks">
                    <label class="control-label" for="coursecate-weeks">单元标题</label>
                    <div>
                      <div class="input-group spinner">
                        <input type="text" class="form-control " name="CourseCate[tags]" value="{{ $model->tags }}" id="coursecate-weeks">
                      </div>
                      <p class="help-block help-block-error"></p>
                      <p class="help-block ">请输入单元标题</p>
                    </div>
                  </div>
                  <div class="form-group field-coursecate-cover_image" id="field-coursecate-cover_image">
                    <label class="control-label" for="coursecate-cover_image">封面图片</label>
                    <div>
                      <input type="text" id="coursecate-cover_image" class="col-xs-8 attach_coursecate-cover_image" name="CourseCate[cover_image]" value="{{$model->cover_image}}">
                      <button type="button" class="upload_coursecate-cover_image btn btn-primary btn-xs middle" id="cover_image_uploader" style="margin-left:5px;">
                        上传
                      </button>
                      <a class="preview_coursecate-cover_image btn btn-primary btn-xs middle" href="#preview-coursecate" style="margin-left:5px;" data-toggle="modal">预览</a>
                      <p class="help-block help-block-error"></p>
                      <p class="help-block " id="cover_imagefsUploadProgress"></p>
                    </div>
                  </div>
                  <div class="form-group field-coursecate-write_image" id="field-coursecate-write_image">
                    <label class="control-label" for="coursecate-write_image">写字课的封面图片</label>
                    <div>
                      <input type="text" id="coursecate-write_image" class="col-xs-8 attach_coursecate-write_image" name="CourseCate[write_image]" value="{{$model->write_image}}">
                      <button type="button" class="upload_coursecate-write_image btn btn-primary btn-xs middle" id="write_image_uploader" style="margin-left:5px;">
                        上传
                      </button>
                      <a class="preview_coursecate-write_image btn btn-primary btn-xs middle" href="#preview-coursecate" style="margin-left:5px;" data-toggle="modal">预览</a>
                      <p class="help-block help-block-error"></p>
                      <p class="help-block " id="write_imagefsUploadProgress"></p>
                    </div>
                  </div>
                  <div class="form-group field-coursecate-write_image" id="field-coursecate-write_image">
                    <label class="control-label" for="coursecate-write_image">详情封面图片</label>
                    <div>
                      <input type="text" id="coursecate-detail_image" class="col-xs-8 attach_coursecate-write_image" name="CourseCate[detail_image]" value="{{$model->detail_image}}">
                      <button type="button" class="upload_coursecate-write_image btn btn-primary btn-xs middle" id="detail_image_uploader" style="margin-left:5px;">
                        上传
                      </button>
                      <a class="preview_coursecate-write_image btn btn-primary btn-xs middle" href="#preview-coursecate" style="margin-left:5px;" data-toggle="modal">预览</a>
                      <p class="help-block help-block-error"></p>
                      <p class="help-block " id="detail_imagefsUploadProgress"></p>
                    </div>
                  </div>
                  <div class="form-group field-coursecate-write_image" id="field-coursecate-write_image">
                    <label class="control-label" for="coursecate-backgroud_image">背景图片</label>
                    <div>
                      <input type="text" id="coursecate-background_image" class="col-xs-8 attach_coursecate-write_image" name="CourseCate[background_image]" value="{{$model->background_image}}">
                      <button type="button" class="upload_coursecate-write_image btn btn-primary btn-xs middle" id="background_image_uploader" style="margin-left:5px;">
                        上传
                      </button>
                      <a class="preview_coursecate-write_image btn btn-primary btn-xs middle" href="#preview-coursecate" style="margin-left:5px;" data-toggle="modal">预览</a>
                      <p class="help-block help-block-error"></p>
                      <p class="help-block " id="background_imagefsUploadProgress"></p>
                    </div>
                  </div>
                  <div class="form-group field-coursecate-write_image" id="field-coursecate-write_image">
                    <label class="control-label" for="coursecate-write_image">开课时间</label>
                    <div class="input-group spinner">
                      <input type="text" id="opening_time" class="form-control" name="CourseCate[opening_time]" value="{{$model->opening_time}}">
                      <p class="help-block help-block-error"></p>
                      <p class="help-block " id="write_imagefsUploadProgress"></p>
                    </div>
                  </div>
                  <div class="form-group field-coursecate-write_image" id="field-coursecate-write_image">
                    <label class="control-label" for="coursecate-write_image">预约开始时间</label>
                    <div class="input-group spinner">
                      <input type="text" id="start_date" class="form-control" name="CourseCate[start_date]" value="{{$model->start_date}}">
                      <p class="help-block help-block-error"></p>
                      <p class="help-block " id="write_imagefsUploadProgress"></p>
                    </div>
                  </div>
                  <div class="form-group field-coursecate-write_image" id="field-coursecate-write_image">
                    <label class="control-label" for="coursecate-write_image">预约截止时间</label>
                    <div class="input-group spinner">
                      <input type="text" id="end_date" class="form-control" name="CourseCate[end_date]" value="{{$model->end_date}}">
                      <p class="help-block help-block-error"></p>
                      <p class="help-block " id="write_imagefsUploadProgress"></p>
                    </div>
                  </div>
                  <div class="form-group field-coursecate-weeks" id="field-coursecate-weeks">
                    <label class="control-label" for="coursecate-weeks">最大购买人数</label>
                    <div>
                      <div class="input-group spinner">
                        <input type="text" class="form-control " name="CourseCate[reservation_max]" value="{{intval($model->reservation_max)}}" id="coursecate-weeks">
                        <div class="input-group-btn-vertical">
                          <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                          <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                        </div>
                      </div>
                      <p class="help-block help-block-error"></p>
                      <p class="help-block ">请输入最大预约人数</p>
                    </div>
                  </div>
                    <div class="form-group field-coursecate-weeks" id="field-coursecate-weeks">
                        <label class="control-label" for="coursecate-weeks">已经购买人数</label>
                        <div>
                            <div class="input-group spinner">
                                <input type="text" class="form-control " name="CourseCate[reservation_current]" value="{{intval($model->reservation_current)}}"  >
                                <div class="input-group-btn-vertical">
                                    <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                    <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                                </div>
                            </div>
                            <p class="help-block help-block-error"></p>
                            <p class="help-block ">请输入已经预约人数</p>
                        </div>
                    </div>

                    <?php
                    echo $form->field($model, 'price')
                              ->label('价格')
                              ->hint('')
                              ->textInput([
                                  'placeholder' => '不输或为0则代表兔费',
                              ]);
                    echo $form->field($model, 'desc')
                              ->label('简要说明')
                              ->hint('')
                              ->textarea([
                                  'style' => 'height:100px',
                              ]);

                    echo $form->field($model, 'NULL')
                              ->submitButton([
                                  'submit' => ' 保 存 ',
                                  'reset'  => '重新填写',
                              ]);
                    $form->end();
                    ?>
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
  {{--<link rel="stylesheet" href="{{yStatic('vendor/plugins/colorpicker/bootstrap-colorpicker.css')}}">--}}
  <style>
    .spinner{
      width:100%
    }
    .spinner input{
      text-align:right
    }
    .input-group-btn-vertical{
      position:relative;
      display:table-cell;
      width:1%;
      vertical-align:middle;
      white-space:nowrap
    }
    .input-group-btn-vertical > .btn{
      position:relative;
      float:none;
      display:block;
      margin-left:-1px;
      padding:8px;
      width:100%;
      max-width:100%;
      border-radius:0
    }
    .input-group-btn-vertical > .btn:first-child{
      border-top-right-radius:4px
    }
    .input-group-btn-vertical > .btn:last-child{
      margin-top:-2px;
      border-bottom-right-radius:4px
    }
    .input-group-btn-vertical i{
      position:absolute;
      top:0;
      left:4px
    }
  </style>
@endpush

@push('foot-script')
  <script src="{{yStatic('vendor/plugins/colorpicker/bootstrap-colorpicker.js')}}" defer></script>
  <script src="{{yStatic('vendor/plugins/qiniu/plupload.min.js')}}" defer></script>
  <script src="{{yStatic('vendor/plugins/plupload/i18n/zh_CN.js')}}" defer></script>
  <script src="{{yStatic('vendor/plugins/qiniu/qiniu.min.js')}}" defer></script>
  <script src="{{yStatic('vendor/plugins/qiniu/progress.js')}}" defer></script>
  <script src="{{yStatic('vendor/plugins/datepicker/bootstrap-datepicker.js')}}" defer></script>
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
              //              drop_element: 'field-coursecate-cover_image',        //拖曳上传区域元素的ID，拖曳文件或文件夹后可触发上传
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
                      $('#coursecate-' + id).val('');
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
                      $('#coursecate-' + id).val(res.key);
                      $('#' + id + 'fsUploadProgress').html('上传已完成');
                  },
                  'Error': function (up, err, errTip) {
                      console.log(err, errTip)
                  }
              }
          });
      }

      $(function () {
          $(".my-colorpicker1").colorpicker();
//          $(".my-colorpicker1").colorpicker();
          $('.spinner .btn:first-of-type').on('click', function () {
              var parent = $(this).parents('.spinner');
              $(parent).find('input:eq(0)').val(parseInt($(parent).find('input:eq(0)').val(), 10) + 1);
          });
          $('.spinner .btn:last-of-type').on('click', function () {
              var parent = $(this).parents('.spinner');
              $(parent).find('input:eq(0)').val(parseInt($(parent).find('input:eq(0)').val(), 10) - 1);
          });
          var filename = "";
          $('a[href="#preview-coursecate"]').on('click', function () {
              var cdnPrefix = '{{cdnImage('')}}';
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
          uploader('cover_image');
          uploader('write_image');
          uploader('detail_image');
          uploader('background_image');

          $('#start_date,#end_date,#opening_time').datepicker({
              format: 'yyyy-mm-dd',
              autoclose: true,
              todayHighlight: true
          });

      });
  </script>
@endpush
