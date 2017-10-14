@extends('layouts.main')@section('title',Yii::t('www','填表领试剂'))
{{--@section('navtitle',Yii::t('www','填表领试剂'))--}}

@section('content')
  <header class="demos-header">
    <h1 class="demos-title"></h1>
  </header>
  <form class="am-form am-form-horizontal">
    <div class="am-form-group">
      <label class="am-u-sm-3 am-form-label">免费试剂</label>
      <div class="am-u-sm-9 controls">
        <label class="am-checkbox"> <input type="checkbox" value="口腔黏膜渗出液金标法检测试剂（唾液试剂）" name="free[0]"> 口腔黏膜渗出液金标法检测试剂（唾液试剂） </label>
        <label class="am-checkbox"> <input type="checkbox" value="末梢血金标法检测试剂（指尖血）" name="free[1]"> 末梢血金标法检测试剂（指尖血） </label>
      </div>
    </div>
    <div class="am-form-group">
      <label class="am-u-sm-3 am-form-label">付费试剂</label>
      <div class="am-u-sm-9 controls">
        <label class="am-checkbox am-checkbox-inline"> <input type="checkbox" value="梅毒试剂" name="fee[0]"> 梅毒试剂 </label>
      </div>
    </div>
    <div class="am-form-group">
      <label class="am-u-sm-3 am-form-label">免费赠品</label>
      <div class="am-u-sm-9 controls">
        <label class="am-checkbox am-checkbox-inline"> <input type="checkbox" value="安全套" name="gift[0]"> 安全套 </label>
        <label class="am-checkbox am-checkbox-inline"><input type="checkbox" value="润滑剂" name="gift[1]"> 润滑剂 </label> <label class="am-checkbox">
          <input type="checkbox" value="其他随机礼品" name="gift[2]"> 其他随机礼品 </label>
      </div>
    </div>
    <div class="am-form-group">
      <label class="am-u-sm-3 am-form-label">收货人</label>
      <div class="am-u-sm-9 controls">
        <input type="text" placeholder="请输入收货人名称" name="contact" class="input-xlarge"> <span class="help-block">请使用真实姓名，以免影响收货</span>
      </div>
    </div>
    <div class="am-form-group">
      <label class="am-u-sm-3 am-form-label">联系手机</label>
      <div class="am-u-sm-9 controls">
        <input type="text" placeholder="请输入手机号" name="contact_mobile" class="input-xlarge"> <span class="help-block">不要带国家代码（如+86）</span>
      </div>
    </div>
    <div class="am-form-group">
      <label class="am-u-sm-3 am-form-label">收货城市</label>
      <div class="am-u-sm-9 controls">
        <input type="text" placeholder="placeholder" name="contact_city" class="input-xlarge"> <span class="help-block">三级联动</span>
      </div>
    </div>
    <div class="am-form-group">
      <label class="am-u-sm-3 am-form-label">详细地址</label>
      <div class="am-u-sm-9 controls">
        <input type="text" placeholder="请输入详细地址" name="contact_address" class="input-xlarge"> <span class="help-block">请输入可以收到货的详细地址</span>
      </div>
    </div>
    <div class="am-form-group">
      <label class="am-u-sm-3 am-form-label">留言备注</label>
      <div class="am-u-sm-9 controls">
        <div class="textarea">
          <textarea type="" class="" name="contact_memo"> </textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="am-u-sm-12">
        <div class="am-cf">
          <button class="am-btn am-btn-secondary am-fr next">下一步</button>
        </div>
      </div>
    </div>
  </form>

@stop

@section('foot-script')
  <script>
      $('.next').on('click', function () {
          var checks = {'contact': '联系人', 'contact_phone': "联系人手机", 'contact_city': "联系人城市", 'contact_address': "联系人详细地址"};
          var errors = [];
          for (i in checks) {
              var v = $("input[name=" + i + "]").val();
              if ($.trim(v) == "") {
                  errors.push(checks[i] + "不能为空");
              }
          }
          if (errors.length > 0) {
              $.alert(errors.join(","));
              return false;
          }

          $.jsonPost("{{yUrl(['site/test'])}}", {a: 1}, function (result) {
              console.log(result);
          }, 'JSON');
      })
  </script>
@stop
