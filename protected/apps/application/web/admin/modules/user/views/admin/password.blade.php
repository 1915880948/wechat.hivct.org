@extends('layouts.main')

@section('title','修改密码')

@section('breadcrumb')
    @include('global.breadcrumb',['breads'=>[[
        'label' => '修改密码 ',
    ]]])
@stop

@section('content')
    <div class="col-sm-6">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-settings font-green-sharp"></i>
                <span class="caption-subject font-green-sharp bold uppercase">账户管理</span>
            </div>
        </div>
        <div class="portlet-body util-btn-margin-bottom-5">
            <div class="widget-main no-padding">
                <div id="external-events">
                    <?php
                        use \yii\widgets\ActiveForm;
                    $form = ActiveForm::begin(['method'=>'post']);
                    ?>
                    <div class="form-group">
                        <label class="control-label" >账户:</label>
                        <div class="input-group spinner">
                            <input type="text" class="form-control" name="account" disabled value="{{ $userinfo->account }}" >
                            <p class="help-block ">账户名称不能修改</p>
                        </div>
                    </div>
                    <div class="form-group " >
                        <label class="control-label" >请输入旧密码:</label>
                        <div>
                            <div class="input-group spinner">
                                <input type="password" class="form-control " name="password_old" value="" >
                            </div>
                            <p class="help-block ">不改密码，空白即可</p>
                        </div>
                    </div>
                    <div class="form-group " >
                        <label class="control-label" >请输入新密码:</label>
                        <div>
                            <div class="input-group spinner">
                                <input type="password" class="form-control " name="password" value="" >
                            </div>
                            <p class="help-block ">不改密码，空白即可</p>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="control-label">昵称</label>
                        <div>
                            <div class="input-group spinner">
                                <input type="text" class="form-control " name="nickname" value="{{ $userinfo->nickname }}" >
                            </div>
                            <p class="help-block ">本系统昵称</p>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="control-label">所属发货地</label>
                        <div>
                            <div class="input-group spinner">
                                <select name="logistic_id" {{$userinfo->account==='admin'?'':'disabled'}}>
                                    @foreach($logistic as $item )
                                        <option value="{{$item['id']}}" {{$userinfo->logistic_id==$item['id']?'selected':''}}>{{$item['title']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="help-block ">所属发货地</p>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label class="control-label">登录时间</label>
                        <div>
                            <div class="input-group spinner">
                                <input type="text" name="login_time" disabled value="{{date('Y-m-d H:i:s',$userinfo->login_time)}}">
                            </div>
                            <p class="help-block ">所属发货地</p>
                        </div>
                    </div>
                    <input type="submit" class="submit" value="提交">
                        <?php
                        $form = ActiveForm::end();
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('foot-script')
    <script>
        $(function () {

        });
    </script>
@endpush
