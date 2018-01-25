<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var $view View */
?>
@extends('layouts.main')@section('title','调查问卷修改')
@section('breadcrumb')
    @include('global.breadcrumb',['title'=> $data['name'],'subtitle'=>'调查问卷修改','breads'=>[[
        'label' => '调查问卷修改 ',
        'url'   => yRoute($selfurl),
    ]]])
@stop
@section('content')
    <div>
        <div class="col-xs-2">收货人： {{$data['name']}} </div>
        <div class="col-xs-3">订单标题： {{ $order_data['info'] }} </div>
        <div class="col-xs-2">支付状态： {{ gPayStatus($order_data['pay_status']) }} </div>
        <div class="col-xs-2">订单状态： {{ gOrderStatus($order_data['order_status']) }}</div>
        <div class="col-xs-2">订单标题： {{ $order_data['total_price'] }} </div>
        <div class="col-xs-1">
            @if($order_data['source_type']== 'survey')
                <a href="{{yRoute('/order/site/detail')}}?uuid={{$order_data['uuid']}}&uid={{$order_data['uid']}}">订单详情</a>
                @if( $order_data['pay_status']== 1 && $order_data['order_status'] == 2 && $order_data['ship_status'] != 1 )
                    <button type="button" class="btn green ship" data-id="{{$order_data['uuid']}}">发 货</button>
                @endif
            @endif
        </div>
    </div>

    <div class="col-xs-12">
        <hr/>
        <form id="survey" name="survey" action="{{yUrl('edit')}}}" method="post">
            <div class="col-xs-4">
                <div class="col-xs-12"><h4>基本信息</h4></div>
                <div class="col-xs-12"><span>姓名：       </span><input type="text" name="name"
                                                                     value="{{ $data['name'] }}"/>
                </div>
                <div class="col-xs-12"><span>民族：       </span>
                    <select id="nation" name="nation">
                        @foreach( $options['nation'] as $k=>$v )
                            @if($v==$data['nation'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>填表日期：    </span><input type="text" name="create_time" disabled
                                                                    value="{{ $data['create_time'] }}"></div>
                <div class="col-xs-12"><span>性别：       </span>
                    <select id="gender" name="gender">
                        @foreach( $options['gender'] as $k=>$v )
                            @if($v==$data['gender'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>出生年月：    </span>
                    <input type="text" id="birthday" value="{{ $data['birthday'] }}">
                </div>
                <div class="col-xs-12"><span>文化程度：    </span>
                    <select id="education" name="education">
                        @foreach( $options['education'] as $k=>$v )
                            @if($v==$data['education'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>婚姻状况：    </span>
                    <select id="marriage" name="marriage">
                        @foreach( $options['marriage'] as $k=>$v )
                            @if($v==$data['marriage'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>职业：       </span>
                    <select id="job" name="job">
                        @foreach( $options['job'] as $k=>$v )
                            @if($v==$data['job'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-xs-12" style="display: inline-block"><span>其他职业：       </span>
                    <input type="text" id="job_other" name="job_other" value="{{ $data['job_other'] }}">
                </div>

                <div class="col-xs-12"><span>收入：       </span>
                    <select id="income" name="income">
                        @foreach( $options['income'] as $k=>$v )
                            @if($v==$data['income'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>户籍地：    </span>
                    <select id="household" name="household">
                        @foreach( $options['household'] as $k=>$v )
                            @if($v==$data['household'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>现居地：    </span>
                    <select id="province" name="province">

                    </select>
                    <select id="city" name="city">

                    </select>
                    <input type="hidden" id="livecity" name="livecity" value="{{$data['livecity']}}">
                    <input type="hidden" id="livecity_code" name="livecity_code" value="{{$data['livecity_code']}}">

                </div>
                <div class="col-xs-12"><span>居住时长：    </span>
                    <select id="livetime" name="livetime">
                        @foreach( $options['livetime'] as $k=>$v )
                            @if($v==$data['livetime'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-xs-12"><h4>性行为情况</h4></div>

                <div class="col-xs-12"><span>是否有过性行为：    </span>
                    <select id="has_sex" name="has_sex">
                        <option value="0" {{ $data['has_sex']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['has_sex']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>第一次性行为年龄：    </span>
                    <input type="number" id="sex_age" name="sex_age" value="{{ $data['sex_age'] }}">
                </div>
                <div class="col-xs-12"><span>寻找性伴侣的方式：    </span>
                    <select id="partner" name="partner">
                        <option value="主动" {{ $data['partner']==0?'selected':'' }}>主动</option>
                        <option value="被动" {{ $data['partner']==1?'selected':'' }}>被动</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>寻找性伴侣的途径：    </span>
                    <input type="hidden" name="partner_sns" value="0">
                    <input type="hidden" name="partner_bar" value="0">
                    <input type="hidden" name="partner_ktv" value="0">
                    <input type="hidden" name="partner_park" value="0">
                    <input type="checkbox" id="partner_sns" name="partner_sns" value="{{$data['partner_sns']}}"
                           {{ $data['partner_sns']?'checked':'' }} onclick="this.value=this.checked?1:0">互联网
                    <input type="checkbox" id="partner_bar" name="partner_bar" value="{{$data['partner_bar']}}"
                           {{ $data['partner_bar']?'checked':'' }} onclick="this.value=this.checked?1:0">酒吧
                    <input type="checkbox" id="partner_ktv" name="partner_ktv" value="{{$data['partner_ktv']}}"
                           {{ $data['partner_ktv']?'checked':'' }} onclick="this.value=this.checked?1:0">KTV
                    <input type="checkbox" id="partner_park" name="partner_park" value="{{$data['partner_park']}}"
                           {{ $data['partner_park']?'checked':'' }} onclick="this.value=this.checked?1:0">公园
                </div>
                <div class="col-xs-12"><span>寻找性伴侣的其他途径：    </span>
                    <input type="text" id="partner_other" name="partner_other" value="{{ $data['partner_other'] }}">
                </div>
                <div class="col-xs-12"><span>常用性行为方式：    </span>
                    <select id="sex_type" name="sex_type">
                        @foreach( $options['sex_type'] as $k=>$v )
                            @if($v==$data['sex_type'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12" style="display: inline-block"><span>其他方式：       </span>
                    <input id="sex_type_other" name="sex_type_other" value="{{$data['sex_type_other']}}">
                </div>

                <div class="col-xs-12"><span>性取向：    </span>
                    <select id="sex_direction" name="sex_direction">
                        @foreach( $options['sex_direction'] as $k=>$v )
                            @if($v==$data['sex_direction'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>你近三个月内是否有过性行为吗：    </span>
                    <select id="has_sex_3month" name="has_sex_3month">
                        <option value="0" {{ $data['has_sex_3month']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['has_sex_3month']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>近三个月内您有多少个异性伙伴：    </span>
                    <input type="number" id="hetero_partner_num" name="hetero_partner_num"
                           value="{{ $data['hetero_partner_num'] }}">
                </div>
                <div class="col-xs-12"><span>是否全程使用安全套：    </span>
                    <select id="condom_full_use" name="condom_full_use">
                        <option value="0" {{ $data['condom_full_use']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['condom_full_use']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>在最近三个月没有全程使用安全套的比例：    </span>
                    <select id="condom_percent" name="condom_percent">
                        @foreach( $options['condom_percent'] as $k=>$v )
                            @if($v==$data['condom_percent'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>最近一次与异性发生性行为是否使用安全套：    </span>
                    <select id="condom_near" name="condom_near">
                        <option value="0" {{ $data['condom_near']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['condom_near']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>最近一次是否未全程使用安全套：    </span>
                    <select id="condom_full_use_not" name="condom_full_use_not">
                        <option value="0" {{ $data['condom_full_use_not']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['condom_full_use_not']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>是否有肛交行为：    </span>
                    <select id="anal_sex" name="anal_sex">
                        <option value="0" {{ $data['anal_sex']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['anal_sex']==1?'selected':'' }}>是</option>
                    </select>
                </div>

                <div class="col-xs-12"><span>选择您的性角色：    </span>
                    <select id="anal_sex_role" name="anal_sex_role">
                        @foreach( $options['anal_sex_role'] as $k=>$v )
                            @if($v==$data['anal_sex_role'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                    {{ $data['anal_sex_role'] }}</div>
                <div class="col-xs-12"><span>近3个月内您有多少个同性伙伴：    </span>
                    <input type="number" id="anal_sex_partner_num" name="anal_sex_partner_num"
                           value="{{ $data['anal_sex_partner_num'] }}">
                </div>
                <div class="col-xs-12"><span>同性间是否全程使用安全套：    </span>
                    <select id="anal_sex_full_use" name="anal_sex_full_use">
                        <option value="0" {{ $data['anal_sex_full_use']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['anal_sex_full_use']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>没有全程使用安全套比例：    </span>
                    <select id="anal_sex_percent" name="anal_sex_percent">
                        @foreach( $options['anal_sex_percent'] as $k=>$v )
                            @if($v==$data['anal_sex_percent'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>最近一次与同性发生性行为是否使用安全套：    </span>
                    <select id="anal_sex_near" name="anal_sex_near">
                        @foreach( $options['anal_sex_near'] as $k=>$v )
                            @if($v==$data['anal_sex_near'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>与同性发生性行为出现过未全程使用安全套(在肛交发生一段时间才使用安全套，如射精前阶段)：    </span>
                    <select id="anal_sex_full_use_not" name="anal_sex_full_use_not">
                        <option value="0" {{ $data['anal_sex_full_use_not']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['anal_sex_full_use_not']==1?'selected':'' }}>是</option>
                    </select>
                </div>

                <div class="col-xs-12"><h4>毒品使用情况</h4></div>
                <div class="col-xs-12"><span>是否使用过毒品：    </span>
                    <select id="is_use_drug" name="is_use_drug">
                        <option value="0" {{ $data['is_use_drug']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['is_use_drug']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>毒品类型：    </span>
                    <select id="drug_type" name="drug_type">
                        @foreach( $options['drug_type'] as $k=>$v )
                            @if($v==$data['drug_type'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>毒品使用频率：    </span>
                    <select id="drug_rate" name="drug_rate">
                        @foreach( $options['drug_rate'] as $k=>$v )
                            @if($v==$data['drug_rate'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>近一个月是否使用过毒品：    </span>
                    <select id="is_use_drug_near_month" name="is_use_drug_near_month">
                        <option value="0" {{ $data['is_use_drug_near_month']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['is_use_drug_near_month']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>近一个月使用毒品的频率：    </span>
                    <input id="drug_near_month_num" name="drug_near_month_num"
                           value="{{ $data['drug_near_month_num'] }}">
                </div>
                <div class="col-xs-12"><span>是否注射过毒品：    </span>
                    <select id="is_use_inject" name="is_use_inject">
                        <option value="0" {{ $data['is_use_inject']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['is_use_inject']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>最近一个月是否注射过毒品：    </span>
                    <select id="is_use_inject_near_month" name="is_use_inject_near_month">
                        <option value="0" {{ $data['is_use_inject_near_month']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['is_use_inject_near_month']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>最近一个月注射毒品的频率：    </span>
                    <input id="inject_near_month_num" name="inject_near_month_num"
                           value="{{ $data['inject_near_month_num'] }}">
                </div>
                <div class="col-xs-12"><span>曾经与别人是否共用过针具：    </span>
                    <select id="is_use_pinhead" name="is_use_pinhead">
                        <option value="0" {{ $data['is_use_pinhead']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['is_use_pinhead']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12">
                    <span>最近一个月，注射毒品时是否与别人共用过针具：    </span>
                    <select id="is_use_pinhead_near_month" name="is_use_pinhead_near_month">
                        <option value="0" {{ $data['is_use_pinhead_near_month']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['is_use_pinhead_near_month']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>最近一个月注射毒品时，与别人共用针具的频率如何：    </span>
                    <select id="pinhead_near_month_num" name="pinhead_near_month_num">
                        @foreach( $options['pinhead_near_month_num'] as $k=>$v )
                            @if($v==$data['pinhead_near_month_num'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12">
                    <span>最近三个月,是否有过吸食毒品后发生性行为：    </span>
                    <select id="is_sex_after_drug_3month" name="is_sex_after_drug_3month">
                        <option value="0" {{ $data['is_sex_after_drug_3month']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['is_sex_after_drug_3month']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>在最近三个月与多少人是在吸食毒品后发生的性行为：    </span>
                    <input id="sex_after_drug_3month_num" name="sex_after_drug_3month_num"
                           value="{{ $data['sex_after_drug_3month_num'] }}">
                </div>
                <div class="col-xs-12">
                    <span>最近一个月,是否有过吸食毒品后发生性行为：    </span>
                    <select id="is_sex_after_drug_1month" name="is_sex_after_drug_1month">
                        <option value="0" {{ $data['is_sex_after_drug_1month']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['is_sex_after_drug_1month']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12">
                    <span>最近一个月,与多少人是在吸食毒品后发生的性行为：    </span>
                    <input id="sex_after_drug_1month_num" name="sex_after_drug_1month_num"
                           value="{{ $data['sex_after_drug_1month_num'] }}">
                </div>

            </div>
            <div class="col-xs-4">
                <div class="col-xs-12"><h4>结核和其他调查</h4></div>

                <div class="col-xs-12"><span>咳嗽、咳痰持续2周以上：    </span>
                    <select id="cough_2week" name="cough_2week">
                        <option value="0" {{ $data['cough_2week']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['cough_2week']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>反复咳出的痰中带血：    </span>
                    <select id="cough_withblood" name="cough_withblood">
                        <option value="0" {{ $data['cough_withblood']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['cough_withblood']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>夜间经常出汗：    </span>
                    <select id="sweat_on_night" name="sweat_on_night">
                        <option value="0" {{ $data['sweat_on_night']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['sweat_on_night']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>无法解思的体重明显下降：    </span>
                    <select id="weight_downgrade" name="weight_downgrade">
                        <option value="0" {{ $data['weight_downgrade']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['weight_downgrade']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>经常容易疲劳或呼吸短促：    </span>
                    <select id="always_tired" name="always_tired">
                        <option value="0" {{ $data['always_tired']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['always_tired']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>反复发热持续2周以上：    </span>
                    <select id="fever_2week" name="fever_2week">
                        <option value="0" {{ $data['fever_2week']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['fever_2week']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>淋巴结肿大：    </span>
                    <select id="lymphadenectasis" name="lymphadenectasis">
                        <option value="0" {{ $data['lymphadenectasis']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['lymphadenectasis']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>结核病人接触史：    </span>
                    <select id="tuberculosis_contact_history" name="tuberculosis_contact_history">
                        <option value="0" {{ $data['tuberculosis_contact_history']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['tuberculosis_contact_history']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>无结核相关症状：    </span>
                    <select id="no_tuberculosis" name="no_tuberculosis">
                        <option value="0" {{ $data['no_tuberculosis']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['no_tuberculosis']==1?'selected':'' }}>是</option>
                    </select>
                </div>

                <div class="col-xs-12"><h5>是否做过相关检查</h5></div>
                <div class="col-xs-12"><span>最近是否做过结核检查（痰检或X胸片）：    </span>
                    <select id="is_phthisic_checked" name="is_phthisic_checked">
                        <option value="0" {{ $data['is_phthisic_checked']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['is_phthisic_checked']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>结核检测结果：    </span>
                    <input type="text" id="phthisic_result" name="phthisic_result"
                           value="{{ $data['phthisic_result'] }}">
                </div>
                <div class="col-xs-12"><span>是否做过梅毒检查 ：    </span>
                    <select id="is_syphilis" name="is_syphilis">
                        <option value="0" {{ $data['is_syphilis']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['is_syphilis']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>梅毒检测结果 ：    </span>
                    <input id="syphilis_result" name="syphilis_result" value="{{ $data['syphilis_result'] }}">
                </div>
                <div class="col-xs-12"><span>最近是否做过乙肝检测 ：    </span>
                    <select id="is_hepatitis_b" name="is_hepatitis_b">
                        <option value="0" {{ $data['is_hepatitis_b']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['is_hepatitis_b']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>乙肝检测结果 ：    </span>
                    <input type="text" id="hepatitis_b_result" name="hepatitis_b_result"
                           value="{{ $data['hepatitis_b_result'] }}">
                </div>
                <div class="col-xs-12"><span>最近是否做过丙肝检测 ：    </span>
                    <select id="is_hepatitis_c" name="is_hepatitis_c">
                        <option value="0" {{ $data['is_hepatitis_c']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['is_hepatitis_c']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>丙肝检测结果 ：    </span>
                    <input type="text" id="hepatitis_c_result" name="hepatitis_c_result"
                           value="{{ $data['hepatitis_c_result'] }}">
                </div>

                <div class="col-xs-12"><h4>HIV快速检测</h4></div>
                <div class="col-xs-12"><h5>你知道本地哪里可以检测HIV：</h5></div>
                <div class="col-xs-12">
                    <input type="hidden" name="detect_hospital" value="0">
                    <input type="checkbox" id="detect_hospital" name="detect_hospital"
                           value="{{$data['detect_hospital']}}"
                           {{ $data['detect_hospital']?'checked':'' }} onclick="this.value=this.checked?1:0">医院
                </div>
                <div class="col-xs-12">
                    <input type="hidden" name="detect_jk_center" value="0">
                    <input type="checkbox" id="detect_jk_center" name="detect_jk_center"
                           value="{{$data['detect_jk_center']}}"
                           {{ $data['detect_jk_center']?'checked':'' }} onclick="this.value=this.checked?1:0">疾控中心
                </div>
                <div class="col-xs-12">
                    <input type="hidden" name="detect_community" value="0">
                    <input type="checkbox" id="detect_community" name="detect_community"
                           value="{{$data['detect_community']}}"
                           {{ $data['detect_community']?'checked':'' }} onclick="this.value=this.checked?1:0">社区小组
                </div>
                <div class="col-xs-12">
                    <input type="hidden" name="detect_drugstore" value="0">
                    <input type="checkbox" id="detect_drugstore" name="detect_drugstore"
                           value="{{$data['detect_drugstore']}}"
                           {{ $data['detect_drugstore']?'checked':'' }} onclick="this.value=this.checked?1:0">药店
                </div>
                <div class="col-xs-12">
                    <input type="hidden" name="detect_clinic" value="0">
                    <input type="checkbox" id="detect_clinic" name="detect_clinic" value="{{$data['detect_clinic']}}"
                           {{ $data['detect_clinic']?'checked':'' }} onclick="this.value=this.checked?1:0">个体诊所
                </div>
                <div class="col-xs-12"><span>其他：    </span>
                    <input type="text" id="detect_other" name="detect_other" value="{{ $data['detect_other'] }}">
                </div>

                <div class="col-xs-12"><h5>是否接受过HIV检测：</h5></div>
                <div class="col-xs-12"><span>是否接受过HIV检测：    </span>
                    <select id="is_accept_detect_hiv" name="is_accept_detect_hiv">
                        <option value="0" {{ $data['is_accept_detect_hiv']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['is_accept_detect_hiv']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>接受过几次HIV检测：    </span>
                    <input type="number" id="detect_num" name="detect_num" value="{{ $data['detect_num'] }}">
                </div>
                <div class="col-xs-12"><span>最近一年内接受过几次HIV检测：    </span>
                    <input type="number" id="detect_num_near_1year" name="detect_num_near_1year"
                           value="{{ $data['detect_num_near_1year'] }}">
                </div>
                <div class="col-xs-12"><span>最近6个月内接受过几次HIV检测：    </span>
                    <input type="number" id="detect_num_near_6month" name="detect_num_near_6month"
                           value="{{ $data['detect_num_near_6month'] }}">
                </div>
                <div class="col-xs-12"><span>最近一次参加HIV检测日期：    </span>
                    <input type="text" id="last_hiv_checkdate" value="{{ $data['last_hiv_checkdate'] }}">
                </div>
                <div class="col-xs-12"><span>是否知道自己最近一次的HIV检测结果：    </span>
                    <select id="is_know_detect_result" name="is_know_detect_result">
                        <option value="0" {{ $data['is_know_detect_result']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['is_know_detect_result']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>最近一次主动检测HIV还是被动员检测：    </span>
                    <select id="hiv_check_mode" name="hiv_check_mode">
                        @foreach( $options['hiv_check_mode'] as $k=>$v )
                            @if($v==$data['hiv_check_mode'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>最近一次参加检测的原因：    </span>
                    <select id="hiv_check_reason" name="hiv_check_reason">
                        @foreach( $options['hiv_check_reason'] as $k=>$v )
                            @if($v==$data['hiv_check_reason'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>最近一次参加检测的其他原因：    </span>
                    <input type="text" id="hiv_check_reason_other" name="hiv_check_reason_other"
                           value="{{ $data['hiv_check_reason_other'] }}">
                </div>
                <div class="col-xs-12"><span>最近一次通过何种方式参加HIV检测：    </span>
                    <select id="last_hiv_check_mode" name="last_hiv_check_mode">
                        @foreach( $options['last_hiv_check_mode'] as $k=>$v )
                            @if($v==$data['last_hiv_check_mode'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>最近一次通过其他方式参加HIV检测：    </span>
                    <input type="text" id="last_hiv_check_mode_other" name="last_hiv_check_mode_other"
                           value="{{ $data['last_hiv_check_mode_other'] }}">
                </div>
                <div class="col-xs-12"><span>对于参加HIV检测是否有顾虑：    </span>
                    <select id="is_detect_care" name="is_detect_care">
                        <option value="0" {{ $data['is_detect_care']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['is_detect_care']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>HIV检测的主要顾虑是什么：    </span>
                    <select id="hiv_check_care" name="hiv_check_care">
                        @foreach( $options['hiv_check_care'] as $k=>$v )
                            @if($v==$data['hiv_check_care'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>HIV检测的其他顾虑是什么：    </span>
                    <input type="text" id="hiv_check_care_other" name="hiv_check_care_other"
                           value="{{ $data['hiv_check_care_other'] }}">
                </div>

                <div class="col-xs-12"><h5>你期望获得HIV检测的渠道：</h5></div>
                <div class="col-xs-12">
                    <input type="hidden" name="detect_channel_hospital" value="0">
                    <input type="checkbox" id="detect_channel_hospital" name="detect_channel_hospital"
                           value="{{$data['detect_channel_hospital']}}"
                           {{ $data['detect_channel_hospital']?'checked':'' }} onclick="this.value=this.checked?1:0">医院
                </div>
                <div class="col-xs-12">
                    <input type="hidden" name="detect_channel_jk_center" value="0">
                    <input type="checkbox" id="detect_channel_jk_center" name="detect_channel_jk_center"
                           value="{{$data['detect_channel_jk_center']}}"
                           {{ $data['detect_channel_jk_center']?'checked':'' }} onclick="this.value=this.checked?1:0">疾控中心
                </div>
                <div class="col-xs-12">
                    <input type="hidden" name="detect_channel_community" value="0">
                    <input type="checkbox" id="detect_channel_community" name="detect_channel_community"
                           value="{{$data['detect_channel_community']}}"
                           {{ $data['detect_channel_community']?'checked':'' }} onclick="this.value=this.checked?1:0">社区小组
                </div>
                <div class="col-xs-12">
                    <input type="hidden" name="detect_channel_drugstore" value="0">
                    <input type="checkbox" id="detect_channel_drugstore" name="detect_channel_drugstore"
                           value="{{$data['detect_channel_drugstore']}}"
                           {{ $data['detect_channel_drugstore']?'checked':'' }} onclick="this.value=this.checked?1:0">药店
                </div>
                <div class="col-xs-12">
                    <input type="hidden" name="detect_channel_clinic" value="0">
                    <input type="checkbox" id="detect_channel_clinic" name="detect_channel_clinic"
                           value="{{$data['detect_channel_clinic']}}"
                           {{ $data['detect_channel_clinic']?'checked':'' }} onclick="this.value=this.checked?1:0">个体诊所
                </div>
                <div class="col-xs-12"><span>其他：    </span>
                    <input type="text" id="detect_channel_other" name="detect_channel_other"
                           value="{{ $data['detect_channel_other'] }}">
                </div>
                <div class="col-xs-12"><span>是否愿意获自费购买HIV检测试剂：    </span>
                    <select id="detect_by_self" name="detect_by_self">
                        <option value="0" {{ $data['detect_by_self']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['detect_by_self']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>再次申请获得一次项目邮寄免费检测试剂：    </span>
                    <select id="hiv_check_time" name="hiv_check_time">
                        @foreach( $options['hiv_check_time'] as $k=>$v )
                            @if($v==$data['hiv_check_time'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>本次是否申请梅毒检测试剂：    </span>
                    <select id="apply_for_free" name="apply_for_free">
                        <option value="0" {{ $data['apply_for_free']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['apply_for_free']==1?'selected':'' }}>是</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="col-xs-12"><h4>配偶/性伴及其他检测</h4></div>

                <div class="col-xs-12"><span>配偶/性伴是否检测过HIV：    </span>
                    <select id="partner_is_check_hiv" name="partner_is_check_hiv">
                        @foreach( $options['partner_is_check_hiv'] as $k=>$v )
                            @if($v==$data['partner_is_check_hiv'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>配偶/性伴的检测结果：    </span>
                    <select id="partner_check_result" name="partner_check_result">
                        @foreach( $options['partner_check_result'] as $k=>$v )
                            @if($v==$data['partner_check_result'])
                                <option value="{{$v}}" selected>{{ $v }}</option>
                            @else
                                <option value="{{$v}}">{{ $v }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12"><span>是否愿意动员配偶/性伴进行HIV检测：    </span>
                    <select id="partner_mobilize" name="partner_mobilize">
                        <option value="0" {{ $data['partner_mobilize']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['partner_mobilize']==1?'selected':'' }}>是</option>
                    </select>
                </div>

                <div class="col-xs-12"><h4>转介及后续服务</h4></div>

                <div class="col-xs-12"><h5>如果本次检测阳性，是否愿意接受我们提供以下服务：</h5></div>
                <div class="col-xs-12"><span>提供进一步快检服务：    </span>
                    <select id="fast_detect_service" name="fast_detect_service">
                        <option value="0" {{ $data['fast_detect_service']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['fast_detect_service']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>提供确证和CD4检测机构信息：    </span>
                    <select id="org_for_cd4" name="org_for_cd4">
                        <option value="0" {{ $data['org_for_cd4']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['org_for_cd4']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>提供抗病毒治疗或相关医疗机构信息：    </span>
                    <select id="org_therapy" name="org_therapy">
                        <option value="0" {{ $data['org_therapy']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['org_therapy']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>提供性病诊断治疗机构信息：    </span>
                    <select id="org_syphilis" name="org_syphilis">
                        <option value="0" {{ $data['org_syphilis']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['org_syphilis']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>提供机会性感染治疗及其他相关治疗机构信息：    </span>
                    <select id="org_syphilis_other" name="org_syphilis_other">
                        <option value="0" {{ $data['org_syphilis_other']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['org_syphilis_other']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>提供心理咨询和帮助机构信息：    </span>
                    <select id="org_psychological" name="org_psychological">
                        <option value="0" {{ $data['org_psychological']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['org_psychological']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>提供母婴阻断机构信息：    </span>
                    <select id="org_pmtct" name="org_pmtct">
                        <option value="0" {{ $data['org_pmtct']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['org_pmtct']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>提供结核诊断治疗机构信息：    </span>
                    <select id="org_phthisis" name="org_phthisis">
                        <option value="0" {{ $data['org_phthisis']==0?'selected':'' }}>否</option>
                        <option value="1" {{ $data['org_phthisis']==1?'selected':'' }}>是</option>
                    </select>
                </div>
                <div class="col-xs-12"><span>其他服务：    </span>
                    <input type="text" id="org_other" name="org_other" value="{{ $data['org_other'] }}">
                </div>

                <div class="col-xs-12"><h5>你对感染HIV后是否需要接受治疗的看法是：</h5></div>
                <div class="col-xs-12">
                    <input type="hidden" name="active_treatment" value="0">
                    <input type="checkbox" id="active_treatment" name="active_treatment"
                           value="{{$data['active_treatment']}}"
                           {{ $data['active_treatment']?'checked':'' }} onclick="this.value=this.checked?1:0">积极接受治疗
                </div>
                <div class="col-xs-12">
                    <input type="hidden" name="unaccept_medical" value="0">
                    <input type="checkbox" id="unaccept_medical" name="unaccept_medical"
                           value="{{$data['unaccept_medical']}}"
                           {{ $data['unaccept_medical']?'checked':'' }} onclick="this.value=this.checked?1:0">担心药物副作用，暂不接受
                </div>
                <div class="col-xs-12">
                    <input type="hidden" name="treatment_until_standard" value="0">
                    <input type="checkbox" id="treatment_until_standard" name="treatment_until_standard"
                           value="{{$data['treatment_until_standard']}}"
                           {{ $data['treatment_until_standard']?'checked':'' }} onclick="this.value=this.checked?1:0">未到治疗标准就不用治疗
                </div>
                <div class="col-xs-12">
                    <input type="hidden" name="resistant_care" value="0">
                    <input type="checkbox" id="resistant_care" name="resistant_care" value="{{$data['resistant_care']}}"
                           {{ $data['resistant_care']?'checked':'' }} onclick="this.value=this.checked?1:0">担心很快耐药
                </div>
                <div class="col-xs-12">
                    <input type="hidden" name="explore_care" value="0">
                    <input type="checkbox" id="explore_care" name="explore_care" value="{{$data['explore_care']}}"
                           {{ $data['explore_care']?'checked':'' }} onclick="this.value=this.checked?1:0">担心吃药后被人发现
                </div>
                <div class="col-xs-12">
                    <input type="hidden" name="not_treatment" value="0">
                    <input type="checkbox" id="not_treatment" name="not_treatment" value="{{$data['not_treatment']}}"
                           {{ $data['not_treatment']?'checked':'' }} onclick="this.value=this.checked?1:0">认为无法治愈，不治疗，任其自然
                </div>
                <div class="col-xs-12"><span>其他看法：    </span>
                    <input type="text" id="treatment_other" name="treatment_other"
                           value="{{ $data['treatment_other'] }}">
                </div>
                <div class="col-xs-12">
                    <input type="hidden" id="uuid" name="uuid" value="{{ $data['uuid'] }}">
                    <input type="button" class="input-group-btn btn btn-default btn-sm input-small submit" value="保存"
                           style="background:#3fd5c0">
                </div>
            </div>
        </form>
    </div>

@stop

@push('head-style')
    <style type="text/css">
        .col-xs-12 .col-xs-12 {
            margin-bottom: 10px;
        }

        .col-xs-12 h4 {
            text-align: center;
            font-weight: bolder;
        }

        .col-xs-12 h5 {
            font-weight: bolder;
        }

        .col-xs-12 span {
            color: #4b76be;
        }

        .col-xs-6 {
            margin-bottom: 10px;
        }

        #ship-content .form-group {
            text-align: center;
            padding: 20px;
        }
    </style>
@endpush

@push('foot-script')
    <script src="{{yStatic('js/city-picker.js')}}"></script>
    <script>
        var raw = $.rawCitiesData;
        $(function () {
            job();
            $("#job").change(function () {
                job();
            });
            sex_type();
            $("#sex_type").change(function () {
                sex_type();
            });
            hiv_check_reason();
            $("#hiv_check_reason").change(function () {
                hiv_check_reason();
            });
            last_hiv_check_mode();
            $("#last_hiv_check_mode").change(function () {
                last_hiv_check_mode();
            });
            hiv_check_care();
            $("#hiv_check_care").change(function () {
                hiv_check_care();
            });

            $('#birthday,#last_hiv_checkdate').daterangepicker({
                    singleDatePicker: true,
                    "locale": {
                        format: 'YYYY-MM-DD',
                    }
                },
                function (start, end, label) {
                    beginTimeTake = start;
                    if (!this.startDate) {
                        this.element.val('');
                    } else {
                        this.element.val(this.startDate.format(this.locale.format));
                    }
                });

            livecity("{{$data['livecity']}}");
            $("#province").change(function () {
                city($("#province").val(),'');
            });
            $("#city").change(function () {
                livecity_code();
            });

            $('.submit').click(function () {
                var formData = $("#survey").serializeArray();
                $.post("{{yUrl('edit')}}", formData, function (res) {
                    if (res.code == 200) {
                        layer.msg('保存成功!', {time: 1200, icon: 1});
                    } else {
                        layer.msg('保存失败!', {time: 1200, icon: 2});
                    }
                })
            });

        });

        function job() {
            if ($("#job").val() == '其他') {
                document.getElementById("job_other").style.display = 'inline-block';
            } else {
                document.getElementById("job_other").style.display = 'none';
            }
        }

        function sex_type() {
            if ($("#sex_type").val() == '其他') {
                document.getElementById("sex_type_other").style.display = 'inline-block';
            } else {
                document.getElementById("sex_type_other").style.display = 'none';
            }
        }

        function hiv_check_reason() {
            if ($("#hiv_check_reason").val() == '其他') {
                document.getElementById("hiv_check_reason_other").style.display = 'inline-block';
            } else {
                document.getElementById("hiv_check_reason_other").style.display = 'none';
            }
        }

        function last_hiv_check_mode() {
            if ($("#last_hiv_check_mode").val() == '其他') {
                document.getElementById("last_hiv_check_mode_other").style.display = 'inline-block';
            } else {
                document.getElementById("last_hiv_check_mode_other").style.display = 'none';
            }
        }

        function hiv_check_care() {
            if ($("#hiv_check_care").val() == '其他') {
                document.getElementById("hiv_check_care_other").style.display = 'inline-block';
            } else {
                document.getElementById("hiv_check_care_other").style.display = 'none';
            }
        }

        function livecity(pro_city) {
            var livecity_arr = pro_city.split(' ');
            var province_html = '';
            for (var i = 0; i < raw.length; i++) {  //   '+(livecity_arr[0]==raw[i].name)?'selected':''+'
                province_html += '<option value="' + raw[i].name + '"' + (livecity_arr[0] == raw[i].name ? 'selected' : '') + '>' + raw[i].name + '</option>';
            }
            $("#province").append(province_html);
            city($("#province").val());
        }

        function city(pro_city) {
            var livecity_arr = pro_city.split(' ');
            var city_html = '';
            for (var i = 0; i < raw.length; i++) {
                if ( pro_city == raw[i].name ){
                    var sub = raw[i].sub;
                    for (var j = 0; j < sub.length; j++) {
                        if( livecity_arr[1] == sub[j].name ){
                            city_html += '<option value="' + sub[j].name + '"' + (livecity_arr[1] == sub[j].name ? 'selected' : '')  + '>' + sub[j].name + '</option>';
                            $("#livecity_code").val(sub[j].code);
                        }else{
                            city_html += '<option value="' + sub[j].name + '"' + (livecity_arr[1] == sub[j].name ? 'selected' : '')  + '>' + sub[j].name + '</option>';
                        }
                    }
                }
            }
            $("#city").empty();
            $("#city").append(city_html);
            livecity_code();
        }

        function livecity_code() {
            for (var k = 0; k < raw.length; k++) {
                if ( $("#province").val() == raw[k].name ){
                    var subs = raw[k].sub;
                    for (var s = 0; s < subs.length; s++) {
                        if( $("#city").val() == subs[s].name ){
                            $("#livecity_code").val(subs[s].code);
                        }
                    }
                }
            }
            $("#livecity").val($("#province").val()+' '+$("#city").val());
        }

    </script>
@endpush
