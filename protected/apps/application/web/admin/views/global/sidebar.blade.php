<div class="page-sidebar navbar-collapse collapse">
  <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" >
    @foreach(adminMenuData() as $menu)
      @if(isset($menu['sub']) && $menu['sub'])
        {{--{{adminMenuActive($menu['sub'])?'active':""}}--}}
        <li class="nav-item  active ">
          <a href="javascript:;" class="nav-link nav-toggle"> <i class="fa {{$menu['icon']}}"></i> <span class="title"> {{$menu['name']}}</span>
            <span class="arrow"></span></a>
          <ul class="sub-menu">
            @foreach($menu['sub'] as $item)
              <li class="nav-item @if(ltrim($item['action'],"/" )== yRequest()->getPathInfo()) active @endif">
                <a href="{{yUrl([$item['action']])}}"><i class="fa fa-circle-o"></i>
                  {{$item['name']}}
                </a>
              </li>
            @endforeach
          </ul>
        </li>
      @else
        <li class="nav-item">
          <a href="{{yUrl([$menu['action']])}}"> <i class="fa fa-th"></i> <span>{{$menu['name']}}{{$userinfo['account']}}</span> </a>
        </li>
      @endif
    @endforeach
  </ul>
</div>
