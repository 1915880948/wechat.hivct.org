@extends('layouts.main')@section('title','调查问卷列表')
@section('breadcrumb')
  @include('global.breadcrumb',['title'=>'调查问题列表','subtitle'=>'所有调查问卷都在这里','breads'=>[[
      'label' => '调查问卷 ',
      'url'   => $selfurl,
  ]]])
@stop
@section('content')

<table id="datatable_ajax"></table>

@stop

@push('head-style')
  <link href="{{yStatic('assets/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{yStatic('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css"/>
@endpush

@push('foot-script')
  <script src="{{yStatic('assets/global/scripts/datatable.min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
  <script src="{{yStatic('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
  <script>
      $(function () {
          var TableDatatablesAjax = function () {
              var e = function () {
                  var a = new Datatable;
                  a.init({
                      src: $("#datatable_ajax"),
                      onSuccess: function (a, e) {
                      },
                      onError: function (a) {
                      },
                      onDataLoad: function (a) {
                      },
                      loadingMessage: "Loading...",
                      dataTable: {
                          bStateSave: !0,
                          lengthMenu: [[10, 20, 50, 100, 150, -1], [10, 20, 50, 100, 150, "All"]],
                          pageLength: 10,
                          ajax: {url: "{{yUrl(['/survey/site/list'])}}"},
                          order: [[1, "asc"]]
                      }
                  }), a.getTableWrapper().on("click", ".table-group-action-submit", function (e) {
                      e.preventDefault();
                      var t = $(".table-group-action-input", a.getTableWrapper());
                      "" != t.val() && a.getSelectedRowsCount() > 0 ? (a.setAjaxParam("customActionType", "group_action"), a.setAjaxParam("customActionName", t.val()), a.setAjaxParam("id", a.getSelectedRows()), a.getDataTable().ajax.reload(), a.clearAjaxParams()) : "" == t.val() ? App.alert({
                          type: "danger",
                          icon: "warning",
                          message: "Please select an action",
                          container: a.getTableWrapper(),
                          place: "prepend"
                      }) : 0 === a.getSelectedRowsCount() && App.alert({
                          type: "danger",
                          icon: "warning",
                          message: "No record selected",
                          container: a.getTableWrapper(),
                          place: "prepend"
                      })
                  }), a.setAjaxParam("customActionType", "group_action"), a.getDataTable().ajax.reload(), a.clearAjaxParams()
              };
              return {
                  init: function () {
                      e()
                  }
              }
          }();
          jQuery(document).ready(function () {
              TableDatatablesAjax.init()
          });
      });
  </script>
@endpush
