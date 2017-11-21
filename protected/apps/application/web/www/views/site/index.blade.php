@extends('layouts/main')

@section('title','首页')


@section('content')
  {{yUser()->getIdentity()}}
  {{--@include('global.footer')--}}
  @include('global.navbar')
@stop
