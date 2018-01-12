@extends('layouts.main')

@section('title','调研详情')
@push('head-style')
    <style type="text/css">
        .weui-label {
            width: auto;
        }

        .weui-cell__bd {
            text-align: right;
        }

        h4 {
            margin: 10px 0;
            text-align: center;
        }
    </style>
@endpush
@section('content')
    <div class="weui-cells">
        <div class="weui-media-box__bd">
            <h4 class="weui-media-box__title">基本信息</h4>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">姓名或称呼：</label></div>
                <div class="weui-cell__bd">{{ $data['name'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">民族：</label></div>
                <div class="weui-cell__bd">{{ $data['nation'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">性别：</label></div>
                <div class="weui-cell__bd">{{ $data['gender'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">出生年月：</label></div>
                <div class="weui-cell__bd">{{ $data['birthday'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">文化程度：</label></div>
                <div class="weui-cell__bd">{{ $data['education'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">婚姻状况：</label></div>
                <div class="weui-cell__bd">{{ $data['marriage'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">职业：</label></div>
                <div class="weui-cell__bd">{{ $data['job'] }}</div>
                @if( $data['job'] == '其他')
                    <span>其他职业：       </span> {{ $data['job_other'] }}
                @endif
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">月平均收入：</label></div>
                <div class="weui-cell__bd">{{ $data['income'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">户籍所在地：</label></div>
                <div class="weui-cell__bd">{{ $data['household'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">现居住地：</label></div>
                <div class="weui-cell__bd">{{ $data['livecity'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">居住时长：</label></div>
                <div class="weui-cell__bd">{{ $data['livetime'] }}</div>
            </div>
        </div>
    </div>
    <div class="weui-cells">

        <div class="weui-media-box__bd">
            <h4 class="weui-media-box__title">性行为情况</h4>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">是否有过性行为：</label></div>
                <div class="weui-cell__bd">{{ $data['has_sex']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">第一次性行为年龄：</label></div>
                <div class="weui-cell__bd">{{ $data['sex_age'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">寻找性伴侣的方式：</label></div>
                <div class="weui-cell__bd">{{ $data['partner'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">寻找性伴侣的途径：</label></div>
                <div class="weui-cell__bd">{{ $data['partner_sns']?'互联网':'' }}&nbsp;
                    {{ $data['partner_bar']?'酒吧':'' }}&nbsp;
                    {{ $data['partner_ktv']?'KTV':'' }}&nbsp;
                    {{ $data['partner_park']?'公园':'' }}&nbsp;
                    {{ $data['partner_other'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">常用性行为方式：</label></div>
                <div class="weui-cell__bd">{{ $data['sex_type'] }}</div>
            </div>
            @if( $data['sex_type'] == '其他')
                <div class="weui-cell">
                    <div class="weui-cell__hd"><label class="weui-label">其他方式：</label></div>
                    <div class="weui-cell__bd">{{ $data['sex_type_other'] }}</div>
                </div>
            @endif
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">性取向：</label></div>
                <div class="weui-cell__bd">{{ $data['sex_direction'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">你近3个月内有过性行为吗：</label></div>
                <div class="weui-cell__bd">{{ $data['hetero_partner_num'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">近3个月内您有多少个异性伙伴：</label></div>
                <div class="weui-cell__bd">{{ $data['hetero_partner_num'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">是否全程使用安全套：</label></div>
                <div class="weui-cell__bd">{{ $data['condom_full_use']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">在最近3个月没有全程使用安全套的比例：</label></div>
                <div class="weui-cell__bd">{{ $data['condom_percent'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近一次与异性发生性行为是否使用安全套：</label></div>
                <div class="weui-cell__bd">{{ $data['condom_near']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近一次是否未全程使用安全套：</label></div>
                <div class="weui-cell__bd">{{ $data['condom_full_use_not'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近一次与异性发生性行为是否使用安全套：</label></div>
                <div class="weui-cell__bd">{{ $data['anal_sex']==1?'是':'否' }}</div>
            </div>
        </div>
    </div>
    <div class="weui-cells">

        <div class="weui-media-box__bd">
            <h4 class="weui-media-box__title">毒品使用情况</h4>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">是否使用过毒品：</label></div>
                <div class="weui-cell__bd">{{ $data['is_use_drug']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">毒品类型：</label></div>
                <div class="weui-cell__bd">{{ $data['drug_type']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">毒品使用频率：</label></div>
                <div class="weui-cell__bd">{{ $data['drug_rate'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">近一个月使用过毒品：</label></div>
                <div class="weui-cell__bd">{{ $data['drug_near_month_num'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">近一个月使用毒品的频率：</label></div>
                <div class="weui-cell__bd">{{ $data['drug_near_month_num'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">是否注射过毒品：</label></div>
                <div class="weui-cell__bd">{{ $data['is_use_inject']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近一个月是否注射过毒品：</label></div>
                <div class="weui-cell__bd">{{ $data['is_use_inject_near_month']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近一个月注射毒品的频率：</label></div>
                <div class="weui-cell__bd">{{ $data['inject_near_month_num'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">曾经与别人是否共用过针具：</label></div>
                <div class="weui-cell__bd">{{ $data['is_use_pinhead']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近一个月，注射毒品时是否与别人共用过针具：</label></div>
                <div class="weui-cell__bd">{{ $data['is_use_pinhead_near_month']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近一个月注射毒品时，与别人共用针具的频率如何：</label></div>
                <div class="weui-cell__bd">{{ $data['pinhead_near_month_num'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近三个月,是否有过吸食毒品后发生性行为：</label></div>
                <div class="weui-cell__bd">{{ $data['is_sex_after_drug_3month']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">在最近三个月与多少人是在吸食毒品后发生的性行为：</label></div>
                <div class="weui-cell__bd">{{ $data['sex_after_drug_3month_num'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近一个月，是否有过吸食毒品后发生性行为：</label></div>
                <div class="weui-cell__bd">{{ $data['is_sex_after_drug_1month']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近一个月，与多少人是在吸食毒品后发生的性行为：</label></div>
                <div class="weui-cell__bd">{{ $data['sex_after_drug_1month_num'] }}</div>
            </div>
        </div>
    </div>
    <div class="weui-cells">

        <div class="weui-media-box__bd">
            <h4 class="weui-media-box__title">结核和其他调查</h4>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">咳嗽、咳痰持续2周以上：</label></div>
                <div class="weui-cell__bd">{{ $data['cough_2week']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">反复咳出的痰中带血：</label></div>
                <div class="weui-cell__bd">{{ $data['cough_withblood']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">夜间经常出汗：</label></div>
                <div class="weui-cell__bd">{{ $data['sweat_on_night']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">无法解思的体重明显下降：</label></div>
                <div class="weui-cell__bd">{{ $data['weight_downgrade']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">经常容易疲劳或呼吸短促：</label></div>
                <div class="weui-cell__bd">{{ $data['always_tired']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">反复发热持续2周以上：</label></div>
                <div class="weui-cell__bd">{{ $data['fever_2week']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">淋巴结肿大：</label></div>
                <div class="weui-cell__bd">{{ $data['lymphadenectasis']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">结核病人接触史：</label></div>
                <div class="weui-cell__bd">{{ $data['tuberculosis_contact_history']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">无结核相关症状：</label></div>
                <div class="weui-cell__bd">{{ $data['no_tuberculosis']==1?'是':'否' }}</div>
            </div>

            <div class="weui-cell"><h5>是否做过相关检查</h5></div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近是否做过结核检查（痰检或X胸片）：</label></div>
                <div class="weui-cell__bd">{{ $data['is_phthisic_checked']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">结核检测结果：</label></div>
                <div class="weui-cell__bd">{{ $data['phthisic_result'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">是否做过梅毒检查：</label></div>
                <div class="weui-cell__bd">{{ $data['is_syphilis']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">梅毒检测结果：</label></div>
                <div class="weui-cell__bd">{{ $data['syphilis_result'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近是否做过乙肝检测：</label></div>
                <div class="weui-cell__bd">{{ $data['is_hepatitis_b']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">乙肝检测结果：</label></div>
                <div class="weui-cell__bd">{{ $data['hepatitis_b_result'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近是否做过丙肝检测：</label></div>
                <div class="weui-cell__bd">{{ $data['is_hepatitis_c']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">丙肝检测结果：</label></div>
                <div class="weui-cell__bd">{{ $data['hepatitis_c_result'] }}</div>
            </div>
        </div>
    </div>
    <div class="weui-cells">

        <div class="weui-media-box__bd">
            <h4 class="weui-media-box__title">HIV快速检测</h4>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">你知道本地哪里可以检测HIV：</label></div>
                <div class="weui-cell__bd"></div>
            </div>
            <div class="weui-cells weui-cells_checkbox">
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" onfocus="onblur();" name="detect_checkbox"
                               {{ $data['detect_hospital']==1?'checked':'' }} disabled>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd"> 医院</div>
                </label>
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" onfocus="onblur();" name="detect_checkbox"
                               {{ $data['detect_jk_center']==1?'checked':'' }} disabled>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd"> 疾控中心</div>
                </label>
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" onfocus="onblur();" name="detect_checkbox"
                               {{ $data['detect_community']==1?'checked':'' }} disabled>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd"> 社区小组</div>
                </label>
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" onfocus="onblur();" name="detect_checkbox"
                               {{ $data['detect_drugstore']==1?'checked':'' }} disabled>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd"> 药店</div>
                </label>
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" onfocus="onblur();" name="detect_checkbox"
                               {{ $data['detect_clinic']==1?'checked':'' }} disabled>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd"> 个体诊所</div>
                </label>
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd"> 其他:</div>
                    <div class="weui-cell__bd"> {{ $data['detect_other'] }} </div>
                </label>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">是否接受过HIV检测：</label></div>
                <div class="weui-cell__bd">{{ $data['is_accept_detect_hiv']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">接受过几次HIV检测：</label></div>
                <div class="weui-cell__bd">{{ $data['detect_num'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近一年内接受过几次HIV检测：</label></div>
                <div class="weui-cell__bd">{{ $data['detect_num_near_1year'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近6个月内接受过几次HIV检测：</label></div>
                <div class="weui-cell__bd">{{ $data['detect_num_near_6month'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近一次参加HIV检测日期：</label></div>
                <div class="weui-cell__bd">{{ $data['last_hiv_checkdate'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">是否知道自己最近一次的HIV检测结果：</label></div>
                <div class="weui-cell__bd">{{ $data['is_know_detect_result']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近一次主动检测HIV还是被动员检测：</label></div>
                <div class="weui-cell__bd">{{ $data['hiv_check_mode'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近一次参加检测的原因：</label></div>
                <div class="weui-cell__bd">{{ $data['hiv_check_reason'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近一次通过何种方式参加HIV检测：</label></div>
                <div class="weui-cell__bd">{{ $data['last_hiv_check_mode'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">最近一次通过其他方式参加HIV检测：</label></div>
                <div class="weui-cell__bd">{{ $data['last_hiv_check_mode_other'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">对于参加HIV检测是否有顾虑：</label></div>
                <div class="weui-cell__bd">{{ $data['is_detect_care']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">HIV检测的主要顾虑是什么：</label></div>
                <div class="weui-cell__bd">{{ $data['hiv_check_care'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">HIV检测的其他顾虑是什么：</label></div>
                <div class="weui-cell__bd">{{ $data['hiv_check_care_other'] }}</div>
            </div>

            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">你期望获得HIV检测的渠道：</label></div>
                <div class="weui-cell__bd"></div>
            </div>
            <div class="weui-cells weui-cells_checkbox">
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check"  onfocus="onblur();" name="detect_channel_checkbox"
                               {{ $data['detect_channel_hospital']==1?'checked':'' }} disabled>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd"> 医院</div>
                </label>
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" onfocus="onblur();" name="detect_channel_checkbox"
                               {{ $data['detect_channel_jk_center']==1?'checked':'' }} disabled>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd"> 疾控中心</div>
                </label>
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" onfocus="onblur();" name="detect_channel_checkbox"
                               {{ $data['detect_channel_community']==1?'checked':'' }} disabled>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd"> 社区小组</div>
                </label>
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" onfocus="onblur();" name="detect_channel_checkbox"
                               {{ $data['detect_channel_drugstore']==1?'checked':'' }} disabled>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd"> 药店</div>
                </label>
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" onfocus="onblur();" name="detect_channel_checkbox"
                               {{ $data['detect_channel_clinic']==1?'checked':'' }} disabled>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd"> 个体诊所</div>
                </label>
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd"> 其他:</div>
                    <div class="weui-cell__bd"> {{ $data['detect_channel_other'] }} </div>
                </label>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">是否愿意获自费购买HIV检测试剂：</label></div>
                <div class="weui-cell__bd">{{ $data['detect_by_self']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">再次申请获得一次项目邮寄免费检测试剂：</label></div>
                <div class="weui-cell__bd">{{ $data['hiv_check_time'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">本次是否申请梅毒检测试剂：</label></div>
                <div class="weui-cell__bd">{{ $data['apply_for_free']==1?'是':'否' }}</div>
            </div>
        </div>
    </div>
    <div class="weui-cells">

        <div class="weui-media-box__bd">
            <h4 class="weui-media-box__title">配偶/性伴及其他检测</h4>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">配偶/性伴是否检测过HIV：</label></div>
                <div class="weui-cell__bd">{{ $data['apply_for_free'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">配偶/性伴的检测结果：</label></div>
                <div class="weui-cell__bd">{{ $data['partner_check_result'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">是否愿意动员配偶/性伴进行HIV检测：</label></div>
                <div class="weui-cell__bd">{{ $data['partner_mobilize']==1?'是':'否' }}</div>
            </div>
        </div>
    </div>
    <div class="weui-cells">

        <div class="weui-media-box__bd">
            <h4 class="weui-media-box__title">转介及后续服务</h4>
            <div class="weui-cell"><h5>如果本次检测阳性,是否愿意接受我们提供以下服务</h5></div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">提供进一步快检服务：</label></div>
                <div class="weui-cell__bd">{{ $data['fast_detect_service']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">提供确证和CD4检测机构信息：</label></div>
                <div class="weui-cell__bd">{{ $data['org_for_cd4']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">提供抗病毒治疗或相关医疗机构信息：</label></div>
                <div class="weui-cell__bd">{{ $data['org_therapy']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">提供性病诊断治疗机构信息：</label></div>
                <div class="weui-cell__bd">{{ $data['org_syphilis']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">提供机会性感染治疗及其他相关治疗机构信息：</label></div>
                <div class="weui-cell__bd">{{ $data['org_syphilis_other']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">提供心理咨询和帮助机构信息：</label></div>
                <div class="weui-cell__bd">{{ $data['org_psychological']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">提供母婴阻断机构信息：</label></div>
                <div class="weui-cell__bd">{{ $data['org_pmtct']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">提供结核诊断治疗机构信息：</label></div>
                <div class="weui-cell__bd">{{ $data['org_phthisis']==1?'是':'否' }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">其他服务：</label></div>
                <div class="weui-cell__bd">{{ $data['org_other'] }}</div>
            </div>
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">你对感染HIV后是否需要接受治疗的看法是：</label></div>
                <div class="weui-cell__bd"></div>
            </div>
            <div class="weui-cells weui-cells_checkbox">
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" onfocus="onblur();" name="checkbox1"
                               {{ $data['active_treatment']==1?'checked':'' }} disabled>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd"> 积极接受治疗</div>
                </label>
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" onfocus="onblur();" name="checkbox1"
                               {{ $data['unaccept_medical']==1?'checked':'' }} disabled>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd"> 担心药物副作用，暂不接受</div>
                </label>
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" onfocus="onblur();" name="checkbox1"
                               {{ $data['treatment_until_standard']==1?'checked':'' }} disabled>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd"> 未到治疗标准就不用治疗</div>
                </label>
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" onfocus="onblur();" name="checkbox1"
                               {{ $data['resistant_care']==1?'checked':'' }} disabled>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd"> 担心很快耐药</div>
                </label>
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" onfocus="onblur();" name="checkbox1"
                               {{ $data['explore_care']==1?'checked':'' }} disabled>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd"> 担心吃药后被人发现</div>
                </label>
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd">
                        <input type="checkbox" class="weui-check" onfocus="onblur();" name="checkbox1"
                               {{ $data['not_treatment']==1?'checked':'' }} disabled>
                        <i class="weui-icon-checked"></i>
                    </div>
                    <div class="weui-cell__bd"> 认为无法治愈，不治疗，任其自然</div>
                </label>
                <label class="weui-cell weui-check__label">
                    <div class="weui-cell__hd"> 其他看法:</div>
                    <div class="weui-cell__bd"> {{ $data['treatment_other'] }} </div>
                </label>
            </div>
        </div>
    </div>
@stop

@push('foot-script')
    <script>
        $(function () {

        });
    </script>
@endpush
