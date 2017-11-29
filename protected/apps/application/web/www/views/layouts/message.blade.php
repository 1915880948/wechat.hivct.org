@extends('layouts.main')@section('title','出错信息')

@section('content')

@stop

@push('foot-script')
  <script>
      $(function () {
          $.alert('{{$message}}', '{{$title}}', function () {
//              setTimeout(function () {
              location.href = '{{yUrl($url)}}';
            {{--},{{$time*1000}});--}}
          })
      });
  </script>
@endpush
