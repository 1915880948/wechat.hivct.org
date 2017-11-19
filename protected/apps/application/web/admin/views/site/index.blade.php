@extends('layouts.main')

@section('title','DashBoard')

@section('breadcrumb')
  @include('global.breadcrumb',['breads'=>[[
      'label' => 'Dashboard ',
  ]]])
@stop

@section('content')

@push('foot-script')
  <script>
      $(function () {

      });
  </script>
@endpush
