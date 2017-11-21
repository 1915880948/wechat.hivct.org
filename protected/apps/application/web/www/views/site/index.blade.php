@extends('layouts/main')

@section('title','首页')


@section('content')
  {{print_r(yUser()->getIdentity())}}
  {{--@include('global.footer')--}}
  @include('global.navbar')
@stop
