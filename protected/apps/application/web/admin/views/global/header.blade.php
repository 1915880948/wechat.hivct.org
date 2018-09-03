<div class="page-header navbar navbar-fixed-top">
  <!-- BEGIN HEADER INNER -->
  <div class="page-header-inner ">
    <!-- BEGIN LOGO -->
    <div class="page-logo">
      <h4 class="font-blue-steel font-lg bold uppercase" style="padding-left:20px;padding-top: 5px;" >Hivct.ORG</h4>
      {{--<div class="menu-toggler sidebar-toggler"></div>--}}
    </div>
    <!-- END LOGO -->
    <div class="hor-menu   hidden-sm hidden-xs">
      <ul class="nav navbar-nav">
        <!-- DOC: Remove data-hover="megamenu-dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
      </ul>
    </div>

    {{--<form class="search-form" action="extra_search.html" method="GET">--}}
      {{--<div class="input-group">--}}
        {{--<input type="text" class="form-control" placeholder="Search..." name="query"> <span class="input-group-btn">--}}
                                {{--<a href="javascript:;" class="btn submit">--}}
                                    {{--<i class="icon-magnifier"></i>--}}
                                {{--</a>--}}
                            {{--</span>--}}
      {{--</div>--}}
    {{--</form>--}}
    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <!-- BEGIN TOP NAVIGATION MENU -->
    <div class="top-menu">
      <ul class="nav navbar-nav pull-right">
        <li class="dropdown dropdown-user ">
          <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
            <span class="username username-hide-on-mobile"> {{ isset($userinfo['account'])&&$userinfo['account'] ? $userinfo['account']: "admin"}} </span>
            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
            <img alt="" class="img-circle" src="{{yStatic('assets/layouts/layout4/img/avatar9.jpg')}}"/> </a>
          <ul class="dropdown-menu dropdown-menu-default">
            <li>
              <a href="{{yUrl(['/user/admin/password'])}}"> <i class="icon-user"></i> 修改密码 </a>
            </li>
            <li>
              <a href="{{yUrl(['/user/project/index'])}}"> <i class="icon-calendar"></i> 我的项目 </a>
            </li>
            <li>
              <a href="{{yUrl(['/user/task/index'])}}"> <i class="icon-envelope-open"></i> 我的任务
                @isset($user['task'])
                  <span class="badge badge-danger"> {{$user['task'] }} </span>
                @endisset
              </a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="####" data-method="post"> <i class="icon-key"></i> 个人 </a>
            </li>
          </ul>
        </li>
        <!-- END USER LOGIN DROPDOWN -->
        <!-- BEGIN QUICK SIDEBAR TOGGLER -->
        <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
        <li class="dropdown dropdown-quick-sidebar-toggler">
          {{--<a href="javascript:;" class="dropdown-toggle"> <i class="icon-logout"></i> </a>--}}
          <a href="{{yUrl(['/site/logout'])}}" data-method="post"> <i class="icon-logout"></i> </a>
        </li>
        <!-- END QUICK SIDEBAR TOGGLER -->
      </ul>
    </div>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END HEADER INNER -->
</div>
<div class="clearfix"></div><!-- END HEADER & CONTENT DIVIDER -->
