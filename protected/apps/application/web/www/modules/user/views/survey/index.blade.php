@extends('layouts.main')

@section('title','调研列表')

@section('content')
    @if($provider)
        <div class="weui-panel weui-panel_access">
            <div class="weui-panel__bd">
                <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
                    <div class="weui-media-box__bd">
                        <h4 class="weui-media-box__title">我的调研列表</h4>
                    </div>
                </a>
            </div>
        </div>
        @foreach($provider as $item)
        <div class="weui-cells">
            <a class="weui-cell weui-cell_access" href="{{yUrl(['survey/detail','uuid'=>$item['uuid']])}}">
                <div class="weui-cell__bd">
                    <div class="weui-flex">
                        <div class="weui-flex__item">姓名：{{ $item['name'] }}</div>
                        <div class="weui-flex__item">完成状态：{{ (($item['event_type_step_total']-1) == $item['event_type_step_current'])?"已完成":"未完成" }}</div>
                    </div>
                </div>
                <div class="weui-cell__ft">{{ $item['create_time'] }}</div>
            </a>
        </div>
        @endforeach
    @else
        <div class="weui-loadmore weui-loadmore_line">
            <span class="weui-loadmore__tips">您暂时还没有参与调研～</span>
        </div>
    @endif
@stop

@push('foot-script')
    <script>
        $(function(){

        });
    </script>
@endpush
