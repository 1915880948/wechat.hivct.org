@extends('layouts.main')@section('title',Yii::t('www','填表领试剂')){{--@section('navtitle',Yii::t('www','填表领试剂'))--}}

@section('content')
  @include('survey.nav')
  <ul class="stepper horizontal">
    <li class="step active">
      <div class="step-title waves-effect">E-mail</div>
      <div class="step-content">
        <div class="row">
          <div class="input-field col s12">
            <input id="email" name="email" type="email" class="validate" required> <label for="first_name">Your e-mail</label>
          </div>
        </div>
        <div class="step-actions">
          <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
        </div>
      </div>
    </li>
    <li class="step">
      <div class="step-title waves-effect">Passo 2</div>
      <div class="step-content">
        <div class="row">
          <div class="input-field col s12">
            <input id="password" name="password" type="password" class="validate" required> <label for="password">Your password</label>
          </div>
        </div>
        <div class="step-actions">
          <button class="waves-effect waves-dark btn next-step">CONTINUE</button>
          <button class="waves-effect waves-dark btn-flat previous-step">BACK</button>
        </div>
      </div>
    </li>
    <li class="step">
      <div class="step-title waves-effect">Fim!</div>
      <div class="step-content">
        Finish!
        <div class="step-actions">
          <button class="waves-effect waves-dark btn" type="submit">SUBMIT</button>
        </div>
      </div>
    </li>
  </ul>
  <div class="box-container">
    <div class="container" id="form-container">
      <div class="row">
        <form class="col s12">
          <h1 class="row sub_title">收货信息</h1>
          <div class="row">
            <div class="col s12">
              <label>免费试剂</label>
            </div>
            <div class="col s12">
              <input type="checkbox" value="唾液[万孚/爱卫/爱博康/维尔/优联]" name="free[0]" id="free_0"> <label for="free_0">唾液[万孚/爱卫/爱博康/维尔/优联]</label>
              <input type="checkbox" value="血液[雅培/万孚/艾博/英科]" name="free[1]" id="free_1"> <label for="free_1">血液[雅培/万孚/艾博/英科]</label>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <label>付费试剂</label>
            </div>
            <div class="col s12">
              <input type="checkbox" value="梅毒试剂" name="fee[0]" id="fee_0"> <label for="fee_0">梅毒试剂</label>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <label>付费试剂</label>
            </div>
            <div class="col s12">
              <input type="checkbox" value="安全套" name="gift[0]" id="gift_0"> <label for="gift_0">安全套</label>
              <input type="checkbox" value="润滑剂" name="gift[1]" id="gift_1"> <label for="gift_1">润滑剂</label>
              <input type="checkbox" value="其他随机礼品" name="gift[2]" id="gift_2"> <label for="gift_2">其他随机礼品</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate" name="contact"> <label>收货人</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="number" class="validate" name="contact_phone"> <label>收货手机</label>
            </div>
          </div>
          {{--<div class="row">--}}
          {{--<p class="col s12" style="margin-bottom: 0;color: #9e9e9e;">--}}
          {{--收货地址 </p>--}}
          {{--<div class="input-field col s12">--}}
          {{--<div class=" browser-default" id="region_select"> </div>--}}
          {{--<input type="hidden" name="region" id="region_input">--}}
          {{--<label>收货地址</label>--}}
          {{--</div>--}}
          {{--<div class="input-field col s4">--}}
          {{--<select class="city browser-default" disabled style="display: none"> </select>--}}
          {{--</div>--}}
          {{--<div class="input-field col s4">--}}
          {{--<select class="dist browser-default" disabled style="display: none;"> </select>--}}
          {{--</div>--}}
          {{--</div>--}}
          <div class="row" id="city">
            <p class="col s12" style="margin-bottom: 0;color: #9e9e9e;">
              收货地址 </p>
            <div class="input-field col s4">
              <select class="prov browser-default"> </select>
            </div>
            <div class="input-field col s4">
              <select class="city browser-default" disabled style="display: none"> </select>
            </div>
            <div class="input-field col s4">
              <select class="dist browser-default" disabled style="display: none;"> </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <label for="textarea1">收货详细地址</label> <textarea id="textarea1" class="materialize-textarea"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <textarea id="textarea2" class="materialize-textarea"></textarea> <label for="textarea2">留言备注</label>
            </div>
          </div>
          <h1 class="row sub_title">个人信息</h1>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate"> <label>真实姓名</label>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <span class="color9e">性别</span>
              <div class="input-field inline radio-inline">
                <input name="sex" type="radio" id="man" /> <label for="man">男</label> <input name="sex" type="radio" id="lady" /> <label for="lady">女</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="date" class="validate"> <label style="top: -1rem;">出生年月</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="number" class="validate"> <label>年龄</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="email" class="validate"> <label>邮箱</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate"> <label>联系电话</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="number" class="validate"> <label>QQ</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate"> <label>微信</label>
            </div>
          </div>
          <h1 class="row sub_title">补充信息</h1>
          <div class="row">
            <div class="input-field col s12">
              <select>
                <option value="wenmang">文盲</option>
                <option value="xiaoxue">小学</option>
                <option value="chuzhong">初中</option>
                <option value="gaozhongzhongzhuan">高中/中专</option>
                <option value="dazhuandaxue">大专/大学</option>
                <option value="yanjiushengjiyishang">研究生及以上</option>
              </select> <label>文化程度</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <select>
                <option value="weihun">未婚</option>
                <option value="nanxingtongju">男性同居</option>
                <option value="yihunyoupeiou">已婚有配偶</option>
                <option value="liyihuosangou">离异或丧偶</option>
                <option value="buxiang">不详</option>
              </select> <label>婚姻状况</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <select>
                <option value="quanzhigongzuobaokuoziyouzhiye">全职工作（包括自由职业）</option>
                <option value="zhongdiangong">钟点工</option>
                <option value="xuesheng">学生</option>
                <option value="meiyougongzuo">没有工作</option>
                <option value="lituixiu">离退休</option>
              </select> <label>主要职业</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <select>
                <option value="wushouru">无收入</option>
                <option value="xuesheng">学生</option>
                <option value="1000yuanyixia">1000元以下</option>
                <option value="10002999yuan">1000~2999元</option>
                <option value="30004999yuan">3000~4999元</option>
                <option value="50009999yuan">5000~9999元</option>
                <option value="10000yuanjiyishang">10000元及以上</option>
              </select> <label>月平均收入</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate" placeholder="没有请输入0或无"> <label>您第一次与男性发生性行为的年龄</label>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <span class="color9e">您的性取向</span>
              <div class="input-field inline radio-inline">
                <input name="nindexingquxiang" type="radio" class="filled-in" id="x1" /> <label for="x1">同性</label>
                <input name="nindexingquxiang" type="radio" class="filled-in" id="x2" /> <label for="x2">异性</label>
                <input name="nindexingquxiang" type="radio" class="filled-in" id="x3" /> <label for="x3">双性</label>
                <input name="nindexingquxiang" type="radio" class="filled-in" id="x4" /> <label for="x4">不确定</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <span class="color9e">您有肛交行为吗</span>
              <div class="input-field inline radio-inline">
                <input name="ninyougangjiaoxingweima" type="radio" class="filled-in" id="you" /> <label for="you">有</label>
                <input name="ninyougangjiaoxingweima" type="radio" class="filled-in" id="meiyou" /> <label for="meiyou">没有</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <select>
                <option value="wanquanshizhudonggangjiao">完全是主动肛交</option>
                <option value="zhuyaoshizhudonggangjiao">主要是主动肛交</option>
                <option value="liangzhejianyouliangzhechabuduo">两者兼有，两者差不多</option>
                <option value="zhuyaoshibeidonggangjiao">主要是被动肛交</option>
                <option value="wanquanbeidonggangjiao">完全被动肛交</option>
                <option value="wugangjiao">无肛交</option>
              </select> <label>您的性角色是</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate" placeholder="没有请输入0或无"> <label>近三个月您有多少个女性性伴</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate" placeholder="没有请输入0或无"> <label>近三个月您有多少个男性性伴</label>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <span class="color9e">最近三个月与男行肛交时是否每次都是用了安全套</span>
              <div class="input-field inline radio-inline">
                <input name="t" type="radio" class="filled-in" id="t1" /> <label for="t1">是</label> <input name="t" type="radio" class="filled-in" id="t2" />
                <label for="t2">否</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <span class="color9e">最近一次（三个月内）与男性肛交时是否使用了安全套</span>
              <div class="input-field inline radio-inline">
                <input name="y" type="radio" class="filled-in" id="y1" /> <label for="y1">是</label> <input name="y" type="radio" class="filled-in" id="y2" />
                <label for="y2">否</label>
              </div>
            </div>
          </div>
          <h1 class="row sub_title">艾滋病快速问卷信息</h1>
          <div class="row">
            <div class="col s12">
              <p class="b9 bm10">你知道当地那里可以检测HIV</p>
              <p>
                <input type="checkbox" class="filled-in" id="z1" /> <label for="z1">社区小组</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="z2" /> <label for="z2">当地疾控中心</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="z3" /> <label for="z3">医院</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="z4" /> <label for="z4">不知道</label>
              </p>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate"> <label>其他可以检测HIV的地方</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate" placeholder="有则输入多少次，没有请输入0或否"> <label>您是否接受过HIV检测</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate"> <label>您最近一次参加HIV检测时什么时候</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate"> <label>最近6个月内做过多少次检测</label>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <p class="b9 bm10">是否知道自己最近一次HIV检测的结果</p>
              <p>
                <input type="radio" class="filled-in" id="j1" /> <label for="j1">是</label>
              </p>
              <p>
                <input type="radio" class="filled-in" id="j2" /> <label for="j2">否</label>
              </p>
              <p>
                <input type="radio" class="filled-in" id="j3" /> <label for="j3">从未检测过</label>
              </p>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <p class="b9 bm10">是否知道自己最近一次HIV检测的结果</p>
              <p>
                <input type="radio" class="filled-in" id="g1" /> <label for="g1">一些政府的HIV项目提供检测</label>
              </p>
              <p>
                <input type="radio" class="filled-in" id="g2" /> <label for="g2">一些志愿者组织的HIV项目提供检测</label>
              </p>
              <p>
                <input type="radio" class="filled-in" id="g3" /> <label for="g3">自己想去疾控中心的HIV门诊检测</label>
              </p>
              <p>
                <input type="radio" class="filled-in" id="g4" /> <label for="g4">从未检测过</label>
              </p>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate"> <label>参加HIV检测的其他原因</label>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <p class="b9 bm10">你知道当地那里可以检测HIV</p>
              <p>
                <input type="checkbox" class="filled-in" id="c1" /> <label for="c1">检测需要提交实名</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="c2" /> <label for="c2">因为自己感染HIV的危险小</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="c3" /> <label for="c3">等待检测结果的时间过长</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="c4" /> <label for="c4">因为害怕如果检测结果阳性，自己的名字会上报政府</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="c5" /> <label for="c5">无法保护自己隐私</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="c6" /> <label for="c6">因为害怕知道自己已经感染而不愿意去检测</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="c7" /> <label for="c7">因为不知道去哪里检测</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="c8" /> <label for="c8">因为到检测地点接受检查交通部方便</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="c9" /> <label for="c9">因为害怕别人认为自己是HIV感染者</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="c10" /> <label for="c10">因为没有时间去检测</label>
              </p>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate"> <label>对参加HIV检测的主要顾虑其他原因</label>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <p class="b9 bm10">您对感染HIV后是否治疗的看法是</p>
              <p>
                <input type="checkbox" class="filled-in" id="k1" /> <label for="k1">积极接受治疗</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="k2" /> <label for="k2">担心药物副作用，暂不接受</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="k3" /> <label for="k3">味道治疗标准就不用治疗</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="k4" /> <label for="k4">担心很快耐药</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="k5" /> <label for="k5">担心吃药后被人发现</label>
              </p>
              <p>
                <input type="checkbox" class="filled-in" id="k6" /> <label for="k6">认为无法治愈，治了也没有一样，任其自然</label>
              </p>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input type="text" class="validate"> <label>对HIV治疗的其他看法</label>
            </div>
          </div>
          <div class="row">
            <div class="col s12">
              <a class="waves-effect waves-light btn btn-block">下一步</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@stop

@push('head-style')
  <link href="{{yStatic('vendor/stepper/materialize-stepper.min.css')}}" rel="stylesheet" />
  <style>
    ul.stepper.horizontal {
       min-height: 458px;
    }
  </style>
@endpush

@push('foot-script')
  @include('widget.jqueryregion')
  <script src="{{yStatic('vendor/stepper/materialize-stepper.min.js')}}"></script>
  <script>
      $(function () {
          $('select').material_select();
          $('.stepper').activateStepper({});


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
          });
      });
  </script>
@endpush
