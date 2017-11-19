@extends('layouts.main')

@section('breadcrumb')
  @include('global.breadcrumb',['title'=>'菜单管理','subtitle'=>'管理左侧侧边栏的菜单','breads'=>[[
      'label' => '菜单列表 ',
      'url'   => $selfurl,
  ]]])
@stop


@section('content')
  <div class="row">
    <div class="col-xs-11">
      <div class="portlet light bordered">
        <div class="row">
          <div class="col-sm-8">
            <div id="nestable" class="dd">
              <ol class="dd-list">
                @foreach($menus as $menu)
                  <li class="dd-item " data-id="{{$menu['id']}}">
                    <div class="dd-handle @if(!$menu['status'])bg-default bg-font-default @endif"><i class="icon icon-play-circle"></i> {{$menu['name']}}
                      <div class="pull-right action-buttons">
                        <a class="text-blue" href="{{yUrl(['/system/menu','id'=>$menu['id']])}}"><i class="fa fa-fw fa-pencil bigger-130"></i></a>
                        <a class="text-red" href="{{yUrl(['/system/menu','id'=>$menu['id'],'status'=>0])}}"><i class="fa fa-fw fa-trash bigger-130"></i></a>
                      </div>
                    </div>
                    @if(isset($menu['sub']) && $menu['sub'])
                      <ol class="dd-list">
                        @foreach($menu['sub'] as $sub)
                          <li class="dd-item @if(!$sub['status']||!$menu['status'])bg-default bg-font-default  @endif" data-id="{{$sub['id']}}">
                            <div class="dd-handle "><i class="icon "></i> {{$sub['name']}}
                              <div class="pull-right action-buttons">
                                <a class="text-blue" href="{{yUrl(['/system/menu','id'=>$sub['id']])}}"><i class="fa fa-fw fa-pencil bigger-130"></i></a>
                                <a class="text-red" href="{{yUrl(['/system/menu','id'=>$sub['id'],'status'=>0])}}"><i class="fa fa-fw fa-trash bigger-130"></i></a>
                              </div>
                            </div>
                          </li>
                        @endforeach
                      </ol>
                    @endif
                    <button type="button" data-action="expand" style="display:none">Expand</button>
                  </li>
                @endforeach
              </ol>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="widget-box transparent">
              <div class="widget-header">
                <h4>{{yRequest()->get('id')?"编辑" : "新增"}}菜单</h4>
              </div>
              <div class="widget-body">
                <div class="widget-main no-padding">
                  <div id="external-events">
                    @define(
                      $form = yActiveForm([
                        'fieldConfig' => [ 'template' => "{label}\n{input}\n{hint}\n {error}\n", ],
                      ])
                    )
                      <?php
                      ;use application\models\base\SystemMenu;use yii\helpers\ArrayHelper;
                      echo $form->field($model, 'pid')
                                ->label('上级分类')
                                ->hint('不选则代表是主导航')
                                ->dropDownList(ArrayHelper::merge(['0' => '请选择上级分类'], ArrayHelper::map(SystemMenu::getFirstMenu(['id', "name"]), 'id', 'name')));
                      ?>
                    {!! $form->field($model, 'name')->label('菜单名称')->hint('')->textInput(['placeholder' => '请输入菜单名称']) !!}
                      <?php
                      echo $form->field($model, 'action')
                                ->label('菜单链接')
                                ->hint('')
                                ->textInput([
                                    'placeholder' => '请输入链接对应的链接',
                                ]);

                      echo $form->field($model, 'ordinal')
                                ->label('排序')
                                ->hint('数字越小排在越前')
                                ->textInput([
                                    'placeholder' => '请输入一个数字',
                                ]);

                      echo $form->field($model, 'status')
                                ->label('发布状态')
                                ->radioList([
                                    -1 => '已删除',
                                    0  => '待发布',
                                    1  => '已发布',
                                ]);
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
  </div>
@stop

@push('head-style')
  <link rel="stylesheet" href="{{gStatic('vendor/plugins/nestable/nestable.css')}}"/>
@endpush

@push('foot-script')
  <script src="{{gStatic('vendor/plugins/nestable/nestable.js')}}"></script>
  <script>
      $(function () {
          var menuUrl = '{{yUrl(['/system/menu'])}}', sortUrl = '{{yUrl(['/system/menu/sort'])}}';
          $("#nestable").nestable({maxDepth: 2});
          $("#nestable").on("change", function () {
              $.post(sortUrl, {sort: JSON.stringify($(".dd").nestable("serialize"))}, function (data) {
                  layer.msg(data.info, function () {
                      location.href = menuUrl;
                  });
              }, "JSON");
          });
          $(".dd-handle a").on("mousedown", function (e) {
              e.stopPropagation();
          });
      })
  </script>
@endpush
