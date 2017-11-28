@extends('layouts.main')@section('title','')

@section('content')
  <div class="bd">
    <div class="page__bd">
      <div class="weui-cells">
        <div class="weui-cell weui-cell_access" href="javascript:;">
          <div class="weui-cell__bd" style="color:#333">
            <h3>您所选择的试剂和发货地</h3>
          </div>
          <div class=""><a href="javascript:;" class="open-popup" data-target="#full"><i class="iconfont icon-addition" style="font-size:20px"></i></a></div>
        </div>
      </div>
      {{--<div class="weui-cells__title">新股盯盘股票池</div>--}}
      @foreach($products as  $type => $product)
        <div class="weui-cells">
          <div class="weui-cell weui-cell_swiped">
            <div class="weui-cell__bd" style="transform: translate3d(0px, 0px, 0px);">
              <div class="weui-media-box weui-media-box_text">
                <h4 class="weui-media-box__title">{{$codesInfo[$code]['name']}} （{{$usernewot['code']}}）</h4>
                <p class="weui-media-box__desc">上市日期：{{$usernewot['open_trans_date']}}，上市价格：{{$usernewot['open_trans_price']}}
                  <br/>顶背离幅度阈值：{{$usernewot['break_threshold']}}%</p>
                <ul class="weui-media-box__info">
                  <li class="weui-media-box__info__meta">盯盘价格：{{$usernewot['last_hit']}}</li>
                  <li class="weui-media-box__info__meta box__info__meta_extra">盯盘时间：{{$usernewot['last_hit_dt']>0?date("Y-m-d H:i:s",$usernewot['last_hit_dt']):""}}</li>
                  <li class="weui-media-box__info__meta weui-media-box__info__meta_extra">盯盘比例：{{$usernewot['last_hit_thres']}}</li>
                </ul>
              </div>
            </div>
            <div class="weui-cell__ft">
              {{--<a class="weui-swiped-btn weui-swiped-btn_warn delete-swipeout" href="javascript:">删除</a>--}}
              {!! yLink('编辑','javascript:;',['class'=>'weui-swiped-btn weui-swiped-btn_default delete-swipeout update','data'=>['code'=>$code,'break_threshold'=>$usernewot['break_threshold'],'link'=>yUrl(['/ot/newstock/update'])]]) !!}
              {!! yLink('删除','javascript:;',['class'=>'weui-swiped-btn weui-swiped-btn_warn delete-swipeout','data'=>['params'=>['code'=>$code],'method'=>'post','confirm'=>'你确认要删除吗','link'=>yUrl(['/ot/newstock/delete'])]]) !!}
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

@stop

@push('foot-script')
  <script>
      $(function () {

      });
  </script>
@endpush
