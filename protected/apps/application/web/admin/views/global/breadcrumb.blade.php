<div class="page-bar">
  <ul class="page-breadcrumb">
    <li><a href="{{yUrl(['site/index'])}}">首页</a> <i class="fa fa-caret-right"></i></li>
    @if(isset($breads) && $breads)
      @foreach($breads as $bread)
        <li>
          @if(isset($bread['url']))
            <a href="{{yUrl($bread['url'])}}"> {{$bread['label']}}</a>
          @else
            {{$bread['label']}}
          @endif
          @if(!$loop->last)<i class="fa fa-caret-right"></i>@endif
        </li>
      @endforeach
    @endif
  </ul>
  {{--<div class="page-toolbar">--}}
  {{--<div class="btn-group pull-right">--}}
  {{--<button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions <i class="fa fa-angle-down"></i>--}}
  {{--</button>--}}
  {{--<ul class="dropdown-menu pull-right" role="menu">--}}
  {{--<li>--}}
  {{--<a href="#"> <i class="icon-bell"></i> Action</a>--}}
  {{--</li>--}}
  {{--<li>--}}
  {{--<a href="#"> <i class="icon-shield"></i> Another action</a>--}}
  {{--</li>--}}
  {{--<li>--}}
  {{--<a href="#"> <i class="icon-user"></i> Something else here</a>--}}
  {{--</li>--}}
  {{--<li class="divider"></li>--}}
  {{--<li>--}}
  {{--<a href="#"> <i class="icon-bag"></i> Separated link</a>--}}
  {{--</li>--}}
  {{--</ul>--}}
  {{--</div>--}}
  {{--</div>--}}
</div>
@if(isset($title))
  <h3 class="page-title"> {{$title}}
    <small>{{$subtitle or ''}}</small>
  </h3>
@endif
