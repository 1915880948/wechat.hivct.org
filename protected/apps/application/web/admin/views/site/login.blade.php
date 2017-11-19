@extends('layouts.main-blank')@section('title','后台登录')

@section('bodyClass')
  class="login"
@endsection

@section('content')
  <div class="logotext" style="margin:0px auto;padding:100px 10px 10px 10px; text-align:center">
    <h1>Hivct.ORG</h1>
  </div>
  <div class="content">
    <form class="login-form" action="{{yUrl(['/site/login'])}}" method="post">
      {!! yCsrfInput() !!}
      <h3 class="form-title">登录后台</h3>
      <div class="alert alert-danger display-hide">
        <button class="close" data-close="alert"></button>
        <span> 请输入您的用户名和密码 </span>
      </div>
      <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">用户名</label>
        <div class="input-icon">
          <i class="fa fa-user"></i> <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">密码</label>
        <div class="input-icon">
          <i class="fa fa-lock"></i> <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
        </div>
      </div>
      <div class="form-actions">
        <label class="checkbox"> <input type="checkbox" name="remember" value="1"/> 保持登录状态 </label>
        <button type="submit" class="btn green pull-right"> 登录</button>
      </div>
    </form>
  </div>
@stop

@push('foot-script')
  <script>
      $(function () {

      });
  </script>
@endpush
