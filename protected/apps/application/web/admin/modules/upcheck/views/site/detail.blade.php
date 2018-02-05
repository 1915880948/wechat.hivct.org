@extends('layouts.main')@section('title','检测处理')
@push('head-style')
    <style type="text/css">
        .col-xs-12{margin-bottom: 20px;
        }
    </style>

@endpush

@section('content')
    @include('global.breadcrumb',['title'=>'检测处理','subtitle'=>'检测处理','breads'=>[[
        'label' => '检测处理 ',
        'url'   => yRoute($selfurl),
    ]]])
    <hr/>

    <div class="col-xs-12" style="">
        <label class="col-md-3 control-label">检测图片：</label>
        <div class="col-xs-9">
            @foreach($images as $item )
                <div class="col-xs-3">
                    @if(strpos($item['image'],'http:')!==false)
                        <a href="{{$item['image']}}" target="_blank"> <img src="{{$item['image']}}" width="200"/> </a>
                    @else
                        <a href="{{env('QINIU_DOMAIN')}}/{{$item['image']}}" target="_blank"> <img src="{{env('QINIU_DOMAIN')}}/{{$item['image']}}" width="200"/> </a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>


    <div class="col-xs-12">
        <label class="col-md-3 control-label">艾滋病检测结果</label>
        <div class="col-md-6">
            <select class="form-control input-inline input-medium adis_result">
                <option value="0">未检测</option>
                <option value="1" {{$checkData['adis_result']==1?'selected':''}}>阴性</option>
                <option value="2" {{$checkData['adis_result']==2?'selected':''}}>阳性</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12">
        <label class="col-md-3 control-label">梅毒检测结果</label>
        <div class="col-md-6">
            <select class="form-control input-inline input-medium syphilis_result">
                <option value="0">未检测</option>
                <option value="1" {{$checkData['syphilis_result']==1?'selected':''}}>阴性</option>
                <option value="2" {{$checkData['syphilis_result']==2?'selected':''}}>阳性</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12">
        <label class="col-md-3 control-label">甲肝检测结果</label>
        <div class="col-md-6">
            <select class="form-control input-inline input-medium hepatitis_b_result">
                <option value="0">未检测</option>
                <option value="1" {{$checkData['hepatitis_b_result']==1?'selected':''}}>阴性</option>
                <option value="2" {{$checkData['hepatitis_b_result']==2?'selected':''}}>阳性</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12">
        <label class="col-md-3 control-label">乙肝检测结果</label>
        <div class="col-md-6">
            <select class="form-control input-inline input-medium hepatitis_c_result">
                <option value="0">未检测</option>
                <option value="1" {{$checkData['hepatitis_c_result']==1?'selected':''}}>阴性</option>
                <option value="2" {{$checkData['hepatitis_c_result']==2?'selected':''}}>阳性</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12">
        <label class="col-md-3 control-label">检测医生</label>
        <div class="col-md-6">
            <input class="form-control " type="text" name="check_doctor" id="check_doctor" placeholder="检测医生">
        </div>
    </div>

    <div class="col-xs-12">
        <label class="col-md-3 control-label">检测描述</label>
        <div class="col-md-6">
            <textarea class="form-control " cols="9" rel="3" id="check_desc"></textarea>
        </div>
        <label class="col-md-3 control-label">
            <input type="button" class="input-group-btn btn btn-default btn-sm input-small save" value="保存" style="background: #3fd5c0;color: #ffffff;"> </label>
    </div>

@endsection
@push('head-style')
    <style type="text/css">
        #ship-content .form-group{
            text-align:center;
            padding:20px;
        }
    </style>
@endpush
@push('foot-script')
    <script>
        $(function () {
            $(".save").click(function (i) {
//                if ($(".deal_name").val()) {
                    $.post("{{yUrl(['site/check'])}}",
                        {
                            'id': "{{ $checkData['id'] }}",
                            'adis_result': $(".adis_result").val(),
                            'syphilis_result': $(".syphilis_result").val(),
                            'hepatitis_b_result': $(".hepatitis_b_result").val(),
                            'hepatitis_c_result': $(".hepatitis_c_result").val(),
                            'check_doctor': $("#check_doctor").val(),
                            'check_desc': $("#check_desc").val()
                        }, function (res) {
                            if (res.code == 200) {
                                layer.msg('操作成功！！', {'icon': 1, time: 1200}, function () {
                                    location.href = "{{yUrl(['/upcheck/site'])}}";
                                });
                            }
                        }
                    );
//                } else {
//                    $("#deal-content .form-group").addClass("has-error");
//                }
            });
        });
    </script>
@endpush
