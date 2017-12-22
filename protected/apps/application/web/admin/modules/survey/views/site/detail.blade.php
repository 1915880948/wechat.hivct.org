<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var $view View */
?>
@extends('layouts.main')@section('title','调查问卷详情')
@section('breadcrumb')
    @include('global.breadcrumb',['title'=> $data['name'],'subtitle'=>'调查问卷详情','breads'=>[[
        'label' => '调查问卷详情 ',
        'url'   => yRoute($selfurl),
    ]]])
@stop
@section('content')
    <div>
        <div class="col-xs-2">收货人： {{$data['name']}} </div>
        <div class="col-xs-2">支付状态： {{ payStatus($order_data['pay_status']) }} </div>
        <div class="col-xs-2">订单状态： {{ orderStatus($order_data['order_status']) }}</div>
        <div class="col-xs-2">
            @if($order_data['source_type']== 'survey')
                <a href="{{yRoute('/order/site/detail')}}?uuid={{$order_data['uuid']}}">订单详情</a><br>
                @if( $order_data['pay_status']== 1 && $order_data['order_status'] == 2 && $order_data['ship_status'] != 1 )
                    <button type="button" class="btn green ship" data-id="{{$order_data['uuid']}}">发货</button>
                @endif
            @endif
                {{--<a href="{{yRoute('/order/site/detail')}}?uuid={{$order_data['source_uuid']}}">发货</a><br>--}}
        </div>
    </div>

    <div class="col-xs-12">
        <hr/>
        <div class="col-xs-4">

            <div class="col-xs-12"><h4>基本信息</h4></div>
            <div class="col-xs-12"><span>姓名：       </span> {{ $data['name'] }}</div>
            <div class="col-xs-12"><span>民族：       </span> {{ $data['nation'] }}</div>
            <div class="col-xs-12"><span>填表日期：    </span> {{ $data['create_time'] }}</div>
            <div class="col-xs-12"><span>性别：       </span> {{ $data['gender'] }}</div>
            <div class="col-xs-12"><span>出生年月：    </span> {{ $data['birthday'] }}</div>
            <div class="col-xs-12"><span>文化程度：    </span> {{ $data['education'] }}</div>
            <div class="col-xs-12"><span>婚姻状况：    </span> {{ $data['marriage'] }}</div>
            <div class="col-xs-12"><span>职业：       </span> {{ $data['job'] }}</div>
            @if( $data['job'] == '其他')
                <div class="col-xs-12"><span>其他职业：       </span> {{ $data['job_other'] }}</div>
            @endif
            <div class="col-xs-12"><span>收入：       </span> {{ $data['income'] }}</div>
            <div class="col-xs-12"><span>户籍地：    </span> {{ $data['household'] }}</div>
            <div class="col-xs-12"><span>现居地：    </span> {{ $data['livecity'] }}</div>
            <div class="col-xs-12"><span>居住时长：    </span> {{ $data['livetime'] }}</div>

            <div class="col-xs-12"><h4>性行为情况</h4></div>

            <div class="col-xs-12"><span>是否有过性行为：    </span> {{ $data['has_sex']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>第一次性行为年龄：    </span> {{ $data['sex_age'] }}</div>
            <div class="col-xs-12"><span>寻找性伴侣的方式：    </span> {{ $data['partner'] }}</div>
            <div class="col-xs-12"><span>寻找性伴侣的途径：    </span> {{ $data['partner_sns']?'互联网':'' }}&nbsp;
                {{ $data['partner_bar']?'酒吧':'' }}&nbsp;
                {{ $data['partner_ktv']?'KTV':'' }}&nbsp;
                {{ $data['partner_park']?'公园':'' }}&nbsp;
                {{ $data['partner_other'] }} </div>
            <div class="col-xs-12"><span>常用性行为方式：    </span> {{ $data['sex_type'] }}</div>

            @if( $data['sex_type'] == '其他')
                <div class="col-xs-12"><span>其他职业：       </span> {{ $data['sex_type_other'] }}</div>
            @endif
            <div class="col-xs-12"><span>性取向：    </span> {{ $data['sex_direction'] }}</div>
            <div class="col-xs-12"><span>你近3个月内有过性行为吗：    </span> {{ $data['hetero_partner_num'] }}</div>
            <div class="col-xs-12"><span>近3个月内您有多少个异性伙伴：    </span> {{ $data['hetero_partner_num'] }}</div>
            <div class="col-xs-12"><span>是否全程使用安全套：    </span> {{ $data['condom_full_use']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>在最近3个月没有全程使用安全套的比例：    </span> {{ $data['condom_percent'] }}</div>
            <div class="col-xs-12"><span>最近一次与异性发生性行为是否使用安全套：    </span> {{ $data['condom_near']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>最近一次是否未全程使用安全套：    </span> {{ $data['condom_full_use_not'] }}</div>
            <div class="col-xs-12"><span>是否有肛交行为：    </span> {{ $data['anal_sex']==1?'是':'否' }}</div>

            <div class="col-xs-12"><h4>毒品使用情况</h4></div>
            <div class="col-xs-12"><span>是否使用过毒品：    </span> {{ $data['is_use_drug']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>毒品类型：    </span> {{ $data['drug_type'] }}</div>
            <div class="col-xs-12"><span>毒品使用频率：    </span> {{ $data['drug_rate'] }}</div>
            <div class="col-xs-12"><span>近一个月使用过毒品：    </span> {{ $data['is_use_drug_near_month'] }}</div>
            <div class="col-xs-12"><span>近一个月使用毒品的频率：    </span> {{ $data['drug_near_month_num'] }}</div>
            <div class="col-xs-12"><span>注射过毒品：    </span> {{ $data['is_use_inject']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>最近一个月是否注射过毒品：    </span> {{ $data['is_use_inject_near_month']==1?'是':'否' }}
            </div>
            <div class="col-xs-12"><span>最近一个月注射毒品的频率：    </span> {{ $data['inject_near_month_num']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>曾经与别人是否共用过针具：    </span> {{ $data['is_use_pinhead']==1?'是':'否' }}</div>
            <div class="col-xs-12">
                <span>最近一个月，注射毒品时是否与别人共用过针具：    </span> {{ $data['is_use_pinhead_near_month']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>最近一个月注射毒品时，与别人共用针具的频率如何：    </span> {{ $data['pinhead_near_month_num'] }}</div>
            <div class="col-xs-12">
                <span>最近3个月,是否有过吸食毒品后发生性行为：    </span> {{ $data['is_sex_after_drug_3month']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>在最近3个月与多少人是在吸食毒品后发生的性行为：    </span> {{ $data['sex_after_drug_3month_num'] }}
            </div>
            <div class="col-xs-12">
                <span>最近1个月,是否有过吸食毒品后发生性行为：    </span> {{ $data['is_sex_after_drug_1month']==1?'是':'否' }}</div>
            <div class="col-xs-12">
                <span>最近1个月,最近1个月与多少人是在吸食毒品后发生的性行为：    </span> {{ $data['is_sex_after_drug_1month'] }}
            </div>
            <div class="col-xs-12">
                <span>最近1个月,是否有过吸食毒品后发生性行为：    </span> {{ $data['is_sex_after_drug_1month']==1?'是':'否' }}</div>

        </div>
        <div class="col-xs-4">
            <div class="col-xs-12"><h4>结核和其他调查</h4></div>

            <div class="col-xs-12"><span>咳嗽、咳痰持续2周以上：    </span> {{ $data['cough_2week']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>反复咳出的痰中带血：    </span> {{ $data['cough_withblood']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>夜间经常出汗：    </span> {{ $data['sweat_on_night']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>无法解思的体重明显下降：    </span> {{ $data['weight_downgrade']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>经常容易疲劳或呼吸短促：    </span> {{ $data['always_tired']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>反复发热持续2周以上：    </span> {{ $data['fever_2week']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>淋巴结肿大：    </span> {{ $data['lymphadenectasis']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>结核病人接触史：    </span> {{ $data['tuberculosis_contact_history']==1?'是':'否' }}
            </div>
            <div class="col-xs-12"><span>无结核相关症状：    </span> {{ $data['no_tuberculosis']==1?'是':'否' }}</div>

            <div class="col-xs-12"><h5>是否做过相关检查</h5></div>
            <div class="col-xs-12"><span>最近是否做过结核检查（痰检或X胸片）：    </span> {{ $data['is_phthisic_checked']==1?'是':'否' }}
            </div>
            <div class="col-xs-12"><span>结核检测结果：    </span> {{ $data['phthisic_result'] }}</div>
            <div class="col-xs-12"><span>是否做过梅毒检查 ：    </span> {{ $data['is_syphilis']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>梅毒检测结果 ：    </span> {{ $data['syphilis_result'] }}</div>
            <div class="col-xs-12"><span>最近是否做过乙肝检测 ：    </span> {{ $data['is_hepatitis_b']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>乙肝检测结果 ：    </span> {{ $data['hepatitis_b_result'] }}</div>
            <div class="col-xs-12"><span>最近是否做过丙肝检测 ：    </span> {{ $data['is_hepatitis_c']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>丙肝检测结果 ：    </span> {{ $data['hepatitis_c_result'] }}</div>

            <div class="col-xs-12"><h4>HIV快速检测</h4></div>
            <div class="col-xs-12"><h5>你知道本地哪里可以检测HIV：</h5></div>
            <div class="col-xs-12"><span>医院 ：    </span> {{ $data['detect_hospital']==1?'&#10003;':'' }}</div>
            <div class="col-xs-12"><span>疾控中心 ： </span> {{ $data['detect_jk_center']==1?'&#10003;':'' }}</div>
            <div class="col-xs-12"><span>社区小组 ：    </span> {{ $data['detect_community']==1?'&#10003;':'' }}</div>
            <div class="col-xs-12"><span>药店 ：    </span> {{ $data['detect_drugstore']==1?'&#10003;':'' }}</div>
            <div class="col-xs-12"><span>个体诊所：    </span> {{ $data['detect_clinic']==1?'&#10003;':'' }}</div>
            <div class="col-xs-12"><span>其他：    </span> {{ $data['detect_other'] }}</div>

            <div class="col-xs-12"><h5>是否接受过HIV检测：</h5></div>
            <div class="col-xs-12"><span>是否接受过HIV检测：    </span> {{ $data['is_accept_detect_hiv']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>接受过几次HIV检测：    </span> {{ $data['detect_num'] }}</div>
            <div class="col-xs-12"><span>最近一年内接受过几次HIV检测：    </span> {{ $data['detect_num_near_1year'] }}</div>
            <div class="col-xs-12"><span>最近6个月内接受过几次HIV检测：    </span> {{ $data['detect_num_near_6month'] }}</div>
            <div class="col-xs-12"><span>最近一次参加HIV检测日期：    </span> {{ $data['last_hiv_checkdate'] }}</div>
            <div class="col-xs-12"><span>是否知道自己最近一次的HIV检测结果：    </span> {{ $data['is_know_detect_result']==1?'是':'否' }}
            </div>
            <div class="col-xs-12"><span>最近一次主动检测HIV还是被动员检测：    </span> {{ $data['hiv_check_mode'] }}</div>
            <div class="col-xs-12"><span>最近一次参加检测的原因：    </span> {{ $data['hiv_check_reason'] }}</div>
            <div class="col-xs-12"><span>最近一次参加检测的其他原因：    </span> {{ $data['hiv_check_reason_other'] }}</div>
            <div class="col-xs-12"><span>最近一次通过何种方式参加HIV检测：    </span> {{ $data['last_hiv_check_mode'] }}</div>
            <div class="col-xs-12"><span>最近一次通过其他方式参加HIV检测：    </span> {{ $data['last_hiv_check_mode_other'] }}</div>
            <div class="col-xs-12"><span>对于参加HIV检测是否有顾虑：    </span> {{ $data['is_detect_care']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>HIV检测的主要顾虑是什么：    </span> {{ $data['hiv_check_care'] }}</div>
            <div class="col-xs-12"><span>HIV检测的其他顾虑是什么：    </span> {{ $data['hiv_check_care_other'] }}</div>

            <div class="col-xs-12"><h5>你期望获得HIV检测的渠道：</h5></div>
            <div class="col-xs-12"><span>医院：    </span> {{ $data['detect_channel_hospital']==1?'&#10003;':'' }}</div>
            <div class="col-xs-12"><span>疾控中心：    </span> {{ $data['detect_channel_jk_center']==1?'&#10003;':'' }}</div>
            <div class="col-xs-12"><span>社区小组：    </span> {{ $data['detect_channel_community']==1?'&#10003;':'' }}</div>
            <div class="col-xs-12"><span>药店：    </span> {{ $data['detect_channel_drugstore']==1?'&#10003;':'' }}</div>
            <div class="col-xs-12"><span>个体诊所：    </span> {{ $data['detect_channel_clinic']==1?'&#10003;':'' }}</div>
            <div class="col-xs-12"><span>其他：    </span> {{ $data['detect_channel_other'] }}</div>
            <div class="col-xs-12"><span>是否愿意获自费购买HIV检测试剂：    </span> {{ $data['detect_by_self']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>再次申请获得一次项目邮寄免费检测试剂：    </span> {{ $data['hiv_check_time'] }}</div>
            <div class="col-xs-12"><span>本次是否申请梅毒检测试剂：    </span> {{ $data['apply_for_free']==1?'是':'否' }}</div>
        </div>
        <div class="col-xs-4">
            <div class="col-xs-12"><h4>配偶/性伴及其他检测</h4></div>

            <div class="col-xs-12"><span>配偶/性伴是否检测过HIV：    </span> {{ $data['apply_for_free'] }}</div>
            <div class="col-xs-12"><span>配偶/性伴的检测结果：    </span> {{ $data['partner_check_result'] }}</div>
            <div class="col-xs-12"><span>是否愿意动员配偶/性伴进行HIV检测：    </span> {{ $data['partner_mobilize']==1?'是':'否' }}</div>

            <div class="col-xs-12"><h4>转介及后续服务</h4></div>

            <div class="col-xs-12"><h5>如果本次检测阳性，是否愿意接受我们提供以下服务：</h5></div>
            <div class="col-xs-12"><span>提供进一步快检服务：    </span> {{ $data['fast_detect_service']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>提供确证和CD4检测机构信息：    </span> {{ $data['org_for_cd4']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>提供抗病毒治疗或相关医疗机构信息：    </span> {{ $data['org_therapy']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>提供性病诊断治疗机构信息：    </span> {{ $data['org_syphilis']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>提供机会性感染治疗及其他相关治疗机构信息：    </span> {{ $data['org_syphilis_other']==1?'是':'否' }}
            </div>
            <div class="col-xs-12"><span>提供心理咨询和帮助机构信息：    </span> {{ $data['org_psychological']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>提供母婴阻断机构信息：    </span> {{ $data['org_pmtct']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>提供结核诊断治疗机构信息：    </span> {{ $data['org_phthisis']==1?'是':'否' }}</div>
            <div class="col-xs-12"><span>其他服务：    </span> {{ $data['org_other'] }}</div>

            <div class="col-xs-12"><h5>你对感染HIV后是否需要接受治疗的看法是：</h5></div>
            <div class="col-xs-12"><span>积极接受治疗：    </span> {{ $data['active_treatment']==1?'&#10003;':'' }}</div>
            <div class="col-xs-12"><span>担心药物副作用，暂不接受：    </span> {{ $data['unaccept_medical']==1?'&#10003;':'' }}</div>
            <div class="col-xs-12">
                <span>未到治疗标准就不用治疗：    </span> {{ $data['treatment_until_standard']==1?'&#10003;':'' }}</div>
            <div class="col-xs-12"><span>担心很快耐药：    </span> {{ $data['resistant_care']==1?'&#10003;':'' }}</div>
            <div class="col-xs-12"><span>担心吃药后被人发现：    </span> {{ $data['explore_care']==1?'&#10003;':'' }}</div>
            <div class="col-xs-12"><span>认为无法治愈，不治疗，任其自然：    </span> {{ $data['not_treatment']==1?'&#10003;':'' }}</div>
            <div class="col-xs-12"><span>其他看法：    </span> {{ $data['treatment_other'] }}</div>
        </div>
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
    </style>
@endpush

@push('foot-script')
    <script>
        $(function () {

        });
    </script>
@endpush
