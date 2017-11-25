<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title',Yii::t('www','你好志愿者网'))</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp"/>
  {!! yCsrfTag() !!}
  <script>
      var PATH_INFO = '{{yRequest()->getPathInfo()}}', SITE_URL = '{{rtrim(yUrl(['/'], true), '/')}}', CURRENT_URL = '{{yUrlRoute([''], true)}}';
      var CSRF_TOKEN = '{{yRequest()->getCsrfToken()}}', STATIC_URL = '{{Yii::getAlias('@web/static')}}', GLOBAL_STATIC_URL = '{{Yii::getAlias('@webstatic')}}';
      ;(function (win, lib) {
          var doc = win.document;
          var docEl = doc.documentElement;
          var metaEl = doc.querySelector('meta[name="viewport"]');
          var flexibleEl = doc.querySelector('meta[name="flexible"]');
          var dpr = 0;
          var scale = 0;
          var tid;
          var flexible = lib.flexible || (lib.flexible = {});

          if (metaEl) {
              console.warn('将根据已有的meta标签来设置缩放比例');
              var match = metaEl.getAttribute('content').match(/initial\-scale=([\d\.]+)/);
              if (match) {
                  scale = parseFloat(match[1]);
                  dpr = parseInt(1 / scale);
              }
          } else if (flexibleEl) {
              var content = flexibleEl.getAttribute('content');
              if (content) {
                  var initialDpr = content.match(/initial\-dpr=([\d\.]+)/);
                  var maximumDpr = content.match(/maximum\-dpr=([\d\.]+)/);
                  if (initialDpr) {
                      dpr = parseFloat(initialDpr[1]);
                      scale = parseFloat((1 / dpr).toFixed(2));
                  }
                  if (maximumDpr) {
                      dpr = parseFloat(maximumDpr[1]);
                      scale = parseFloat((1 / dpr).toFixed(2));
                  }
              }
          }

          if (!dpr && !scale) {
              var isAndroid = win.navigator.appVersion.match(/android/gi);
              var isIPhone = win.navigator.appVersion.match(/iphone/gi);
              var devicePixelRatio = win.devicePixelRatio;
              if (isIPhone) {
                  // iOS下，对于2和3的屏，用2倍的方案，其余的用1倍方案
                  if (devicePixelRatio >= 3 && (!dpr || dpr >= 3)) {
                      dpr = 3;
                  } else if (devicePixelRatio >= 2 && (!dpr || dpr >= 2)) {
                      dpr = 2;
                  } else {
                      dpr = 1;
                  }
              } else {
                  // 其他设备下，仍旧使用1倍的方案
                  dpr = 1;
              }
              scale = 1 / dpr;
          }

          docEl.setAttribute('data-dpr', dpr);
          if (!metaEl) {
              metaEl = doc.createElement('meta');
              metaEl.setAttribute('name', 'viewport');
              metaEl.setAttribute('content', 'initial-scale=' + scale + ', maximum-scale=' + scale + ', minimum-scale=' + scale + ', user-scalable=no');
              if (docEl.firstElementChild) {
                  docEl.firstElementChild.appendChild(metaEl);
              } else {
                  var wrap = doc.createElement('div');
                  wrap.appendChild(metaEl);
                  doc.write(wrap.innerHTML);
              }
          }

          function refreshRem() {
              var width = docEl.getBoundingClientRect().width;
              //if (width / dpr > 540) {
              //    width = 540 * dpr;
              //}
              var rem = width / 10;
              docEl.style.fontSize = rem + 'px';
              flexible.rem = win.rem = rem;
          }

          win.addEventListener('resize', function () {
              clearTimeout(tid);
              tid = setTimeout(refreshRem, 300);
          }, false);
          win.addEventListener('pageshow', function (e) {
              if (e.persisted) {
                  clearTimeout(tid);
                  tid = setTimeout(refreshRem, 300);
              }
          }, false);

          if (doc.readyState === 'complete') {
              doc.body.style.fontSize = 12 * dpr + 'px';
          } else {
              doc.addEventListener('DOMContentLoaded', function (e) {
                  doc.body.style.fontSize = 12 * dpr + 'px';
              }, false);
          }


          refreshRem();

          flexible.dpr = win.dpr = dpr;
          flexible.refreshRem = refreshRem;
          flexible.rem2px = function (d) {
              var val = parseFloat(d) * this.rem;
              if (typeof d === 'string' && d.match(/rem$/)) {
                  val += 'px';
              }
              return val;
          };
          flexible.px2rem = function (d) {
              var val = parseFloat(d) / this.rem;
              if (typeof d === 'string' && d.match(/px$/)) {
                  val += 'rem';
              }
              return val;
          }

      })(window, window['lib'] || (window['lib'] = {}));
  </script>
  <link rel="stylesheet" href="{{yStatic('weui/lib/weui.min.css')}}">
  <link rel="stylesheet" href="{{yStatic('weui/css/jquery-weui.min.css')}}">
  <link rel="stylesheet" href="{{gStatic('vendor/progress/nprogress.css')}}">
  <link rel="stylesheet" href="{{yStatic('css/main.css')}}">
  <link rel="stylesheet" href="//at.alicdn.com/t/font_477728_56x7ojdx9rx80k9.css">
  <script src="{{gStatic('vendor/jquery/jquery-2.2.3.min.js')}}"></script>
  {{--<script src="{{gStatic('vendor/jquery/jquery.1.11.2.min.js')}}"></script>--}}
</head>
<body ontouchstart>
<div data-pjax id="pjax-container" class="weui-tab  ">
  @stack('head-style')
  @stack('head-script')
  @yield('content')
  @stack('global.footer')
  @stack('foot-script')
</div>
{{--<script src="//cdn.bootcss.com/jquery-weui/1.0.1/js/jquery-weui.min.js"></script>--}}
<script src="{{yStatic('weui/js/jquery-weui.min.js')}}"></script>
<script src="{{gStatic('vendor/jquery/pjax.js')}}"></script>
<script src="{{gStatic('vendor/plugins/layer/layer.js')}}"></script>
{{--<script src="{{gStatic('vendor/fastclick/fastclick.min.js')}}"></script>--}}
<script src="{{gStatic('vendor/hammer.min.js')}}"></script>
<script src="{{gStatic('vendor/jquery/jquery.hammer.js')}}"></script>
<script src="{{gStatic('vendor/progress/nprogress.js')}}"></script>
<script src="{{yStatic('js/app.js')}}"></script>
<script>
    $(function () {
//        FastClick.attach(document.body);
        $('.alert').hammer().on('tap', function () {
            console.log($(this).data('info'));
            alert($(this).data('info'));
        });
        $(document).pjax('[data-pjax] a, a[data-pjax]', '#pjax-container', {
            timeout: 8000,
            fragment: '#pjax-container'
        });
        $(document).on('pjax:start', NProgress.start).on('pjax:end', NProgress.done);
    })
</script>
</body>
</html>
